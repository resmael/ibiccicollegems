<?php
session_start();
include "./../assets/config.php"; // adjust if needed

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $type = $_POST["type"];
    $uploadDir = __DIR__ . "/../wp-content/uploads/inquiry/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . $fileName;
    $dbPath = "./../wp-content/uploads/inquiry/" . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO inquiry_images (type, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $type, $dbPath);
        $stmt->execute();
        $msg = "✅ Image uploaded successfully!";
    } else {
        $msg = "❌ Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post Inquiry</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; text-align: center; padding: 50px; }
    form { background: white; padding: 20px; border-radius: 10px; display: inline-block; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    input, select { padding: 10px; margin: 10px; width: 80%; }
    button { padding: 12px 24px; background: #0077cc; color: white; border: none; border-radius: 8px; cursor: pointer; }
    button:hover { background: #005fa3; }
    .msg { margin: 20px; font-weight: bold; }
  </style>
</head>
<body>
  <h1>Upload Inquiry Image</h1>
  <?php if (!empty($msg)) echo "<div class='msg'>$msg</div>"; ?>
  <form action="" method="post" enctype="multipart/form-data">
    <label>Select Type:</label><br>
    <select name="type" required>
      <option value="requirements">📄 Requirements</option>
      <option value="info">ℹ️ Other Information</option>
    </select><br>
    <input type="file" name="image" accept="image/*" required><br>
    <button type="submit">Upload</button>
  </form>
  <br><br>
  <a href="dashboard.php">🏠 Back to Home</a>
</body>
</html>
