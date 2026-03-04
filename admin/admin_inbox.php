<?php
session_start();
include "./../assets/config.php";

// Fetch all feedback
$result = mysqli_query($conn, "SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Inbox</title>
  <style>
    body { font-family: Arial, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; vertical-align: top; }
    th { background: #007BFF; color: white; }
    button { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
    .delete { background: red; color: white; }
    .back-btn {
      background: #6c757d;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
      margin-bottom: 15px;
    }
    .back-btn:hover { background: #5a6268; }
    /* Limit feedback message column */
    .message-cell {
      max-width: 250px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .view-btn {
      background: #28a745;
      color: white;
      border-radius: 5px;
      padding: 5px 10px;
      cursor: pointer;
    }
    /* Modal styling */
    .modal {
      display: none; 
      position: fixed; 
      z-index: 999; 
      left: 0; top: 0; 
      width: 100%; height: 100%; 
      background: rgba(0,0,0,0.5);
      justify-content: center; 
      align-items: center;
    }
    .modal-content {
      background: white; 
      padding: 20px; 
      border-radius: 10px;
      max-width: 500px;
      max-height: 400px;
      overflow-y: auto;
      text-align: left;
    }
    .close-btn {
      background: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      float: right;
    }
  </style>
</head>
<body>

  <h2>📥 Feedback Inbox</h2>

  <!-- Back button -->
  <a href="./inbox/inbox.php" class="back-btn">⬅ Back to Dashboard</a>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td class="message-cell">
          <?php echo htmlspecialchars($row['message']); ?>
        </td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
          <button class="view-btn" onclick="openModal('<?php echo htmlspecialchars(addslashes($row['message'])); ?>')">View</button>
          <form method="POST" action="delete_feedback.php" style="display:inline;" onsubmit="return confirm('Delete this feedback?');">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="delete">Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- Modal -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal()">X</button>
      <h3>Feedback Message</h3>
      <p id="modal-message"></p>
    </div>
  </div>

  <script>
    function openModal(message) {
      document.getElementById("modal-message").textContent = message;
      document.getElementById("modal").style.display = "flex";
    }
    function closeModal() {
      document.getElementById("modal").style.display = "none";
    }
  </script>

</body>
</html>
