<?php
include "./../assets/config.php";
session_start();

// ✅ Ensure uploads/messages exists
$uploadDir = __DIR__ . "/../uploads/messages/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$_SESSION['admin_id'] = 1;
$adminId = (int)($_SESSION['admin_id'] ?? 0);
$role = 'admin';

/* --- helpers --- */
function get_int_from_input($type, $key) {
    $filter_type = $type === 'GET' ? INPUT_GET : INPUT_POST;
    $val = filter_input($filter_type, $key, FILTER_VALIDATE_INT);
    return ($val === null || $val === false) ? null : (int)$val;
}

/* --- instructor selection --- */
$instructorId = get_int_from_input('GET', 'instructor_id') ?? get_int_from_input('POST', 'instructor_id') ?? 0;
$instructors = [];
if ($res = $conn->query("SELECT id, fullname FROM instructors ORDER BY fullname ASC")) {
    $instructors = $res->fetch_all(MYSQLI_ASSOC);
}
if ($instructorId === 0 && !empty($instructors)) {
    $instructorId = (int)$instructors[0]['id'];
}

/* --- handle new message --- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $adminId > 0) {
    $msg = trim($_POST['message'] ?? '');
    $postInstructorId = get_int_from_input('POST', 'instructor_id');
    if ($postInstructorId !== null) {
        $instructorId = (int)$postInstructorId;
    }

    // File upload handling
    $filePath = null;
    if (!empty($_FILES['attachment']['name'])) {
        $filename = time() . "_" . basename($_FILES['attachment']['name']);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetFile)) {
            $attachment = "uploads/messages/" . $filename;
        }
    }

    if (($msg !== '' || $attachment !== null) && $instructorId > 0) {
        $insert = $conn->prepare("
            INSERT INTO messages (sender_id, receiver_id, sender_role, message, attachment)
            VALUES (?, ?, ?, ?, ?)
        ");
        $insert->bind_param("iisss", $adminId, $instructorId, $role, $msg, $attachment);
        $insert->execute();
        $insert->close();

        header("Location: message_admin.php?instructor_id=" . urlencode((string)$instructorId));
        exit;
    }
}

/* --- fetch conversation --- */
$messages = [];
if ($instructorId > 0) {
    $stmt = $conn->prepare("
        SELECT id, sender_id, receiver_id, sender_role, message, attachment, created_at
        FROM messages
        WHERE (sender_id = ? AND sender_role = 'admin' AND receiver_id = ?)
           OR (sender_id = ? AND sender_role = 'instructor' AND receiver_id = ?)
        ORDER BY created_at ASC, id ASC
    ");
    $stmt->bind_param("iiii", $adminId, $instructorId, $instructorId, $adminId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $messages = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
}

// Find selected instructor name for header (optional)
$selectedName = '';
if ($instructorId > 0) {
    foreach ($instructors as $inst) {
        if ((int)$inst['id'] === (int)$instructorId) {
            $selectedName = $inst['fullname'];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Messages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-3xl bg-white shadow-2xl rounded-2xl flex flex-col h-[85vh] overflow-hidden">

    <!-- Header -->
    <div class="p-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex justify-between items-center">
      <div class="flex flex-col">
        <h2 class="text-lg md:text-xl font-semibold tracking-wide">💬 Admin ↔ Instructor</h2>
        <?php if ($selectedName): ?>
          <span class="text-xs opacity-90">Chatting with: <strong><?php echo htmlspecialchars($selectedName); ?></strong></span>
        <?php endif; ?>
      </div>
      <a href="./inbox/inbox.php"
         class="bg-white text-blue-700 px-3 py-1 rounded-full shadow hover:bg-blue-100 transition">
        ← Back
      </a>
    </div>

    <!-- Instructor Dropdown -->
    <form method="GET" class="p-3 bg-gray-100 border-b flex gap-2 items-center">
      <label for="instructor_id" class="text-sm font-semibold text-gray-700">Choose Instructor:</label>
      <select name="instructor_id" id="instructor_id" class="border rounded-lg px-3 py-2" onchange="this.form.submit()">
        <?php foreach ($instructors as $inst): ?>
          <option value="<?php echo (int)$inst['id']; ?>" <?php echo ((int)$inst['id'] === (int)$instructorId) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($inst['fullname']); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (empty($instructors)): ?>
        <span class="text-sm text-red-600 ml-2">No instructors found. Create an instructor first.</span>
      <?php endif; ?>
    </form>

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50 scroll-smooth">
      <?php if ($instructorId > 0 && !empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
          <div class="flex items-end gap-2 <?php echo ($msg['sender_role'] === 'admin') ? 'justify-end' : 'justify-start'; ?>">

            <!-- Avatar -->
            <?php if ($msg['sender_role'] !== 'admin'): ?>
              <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center text-white text-sm font-bold">I</div>
            <?php endif; ?>

            <!-- Message Bubble -->
            <div class="max-w-xs md:max-w-sm px-4 py-2 rounded-2xl shadow transition
                        <?php echo ($msg['sender_role'] === 'admin')
                            ? 'bg-blue-600 text-white rounded-br-none'
                            : 'bg-gray-200 text-gray-900 rounded-bl-none'; ?>">
             <p class="text-sm md:text-base">
  <?php echo htmlspecialchars($msg['message']); ?>

  <?php if (!empty($msg['attachment'])): ?>
    <br>
    <?php 
      // Extract only the file name from the stored path
      $fileName = basename($msg['attachment']); 
    ?>
    📎 <a href="<?php echo htmlspecialchars($msg['attachment']); ?>" 
          target="_blank" 
          class="text-black-600 underline">
        <?php echo htmlspecialchars($fileName); ?>
    </a>
  <?php endif; ?>
</p>


              <span class="block text-xs mt-1 opacity-70 text-right">
                <?php echo date("M d, H:i", strtotime($msg['created_at'])); ?>
              </span>
            </div>

            <!-- Avatar for Admin -->
            <?php if ($msg['sender_role'] === 'admin'): ?>
              <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">A</div>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>
      <?php elseif ($instructorId > 0): ?>
        <p class="text-center text-gray-500">No messages yet with this instructor.</p>
      <?php else: ?>
        <p class="text-center text-gray-500">No instructors available. Create one to start a chat.</p>
      <?php endif; ?>
    </div>

    <!-- Input -->
    <form method="POST" enctype="multipart/form-data" class="p-4 border-t flex gap-2 bg-white sticky bottom-0">
  <input type="hidden" name="instructor_id" value="<?php echo (int)$instructorId; ?>">
  <input type="text" name="message" placeholder="Type a message..."
         class="flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
  <input type="file" name="attachment" class="text-sm">
  <button type="submit"
          class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-2 rounded-full shadow hover:scale-105 transition">
    Send
  </button>
</form>


  </div>
</body>
</html>
