  <?php
session_start();
include "./../assets/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO instructors (username, password_hash, fullname, email, department) 
            VALUES ('$username', '$passwordHash', '$fullname', '$email', '$department')";

    if (mysqli_query($conn, $sql)) {
        $success = "✅ Instructor account created successfully!";
    } else {
        $error = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Instructor Account</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;
    }
    header {
      width: 100%;
      background: #2c3e50;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    header h2 { margin: 0; font-size: 20px; }
    header a {
      text-decoration: none;
      background: #3498db;
      color: #fff;
      padding: 8px 16px;
      border-radius: 6px;
      transition: background 0.3s ease;
    }
    header a:hover { background: #2980b9; }
    .container {
      background: #fff;
      margin-top: 40px;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }
    .container h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c3e50;
    }
    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #333;
    }
    form input, form select {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      transition: border-color 0.3s ease;
    }
    form input:focus, form select:focus { border-color: #3498db; outline: none; }
    button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      background: #27ae60;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover { background: #219150; }
    .message {
      margin-top: 15px;
      padding: 10px;
      border-radius: 6px;
      font-size: 14px;
      text-align: center;
    }
    .success { background: #e9f9ee; color: #2ecc71; border: 1px solid #2ecc71; }
    .error { background: #fdecea; color: #e74c3c; border: 1px solid #e74c3c; }
  </style>
</head>
<body>
  <header>
    <h2>Admin Dashboard</h2>
    <a href="./instructor-module/instructor.php">⬅ Back to Dashboard</a>
  </header>

  <div class="container">
    <h3>Create Instructor Account</h3>

    <?php if (isset($success)) echo "<div class='message success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

    <form method="POST" action="">
      <label>Full Name</label>
      <input type="text" name="fullname" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Username</label>
      <input type="text" name="username" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <label>Department</label>
      <select name="department" required>
        <option value="">-- Select Department --</option>
        <option value="CRIMD">CRIMD</option>
        <option value="SOCIAL WORK">Social Work</option>
        <option value="COMPUTER STUDIES">COMPUTER STUDIES</option>
        <option value="EDUCATION">EDUCATION</option>
        <option value="MEDICAL">MEDICAL</option>
         
        <!-- add more departments as needed -->
      </select>

      <button type="submit">Create Account</button>
    </form>
  </div>
</body>
</html>
