<?php
session_start();
include "../assets/config.php";

// Only logged-in admin can update profile
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $new_username = trim($_POST['username']);
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // Fetch current user data
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Handle username update
        if (!empty($new_username) && $new_username !== $row['username']) {
            // Check if username already exists
            $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$new_username' AND id!='$id'");
            if (mysqli_num_rows($check_user) > 0) {
                $error = "Username already taken!";
            } else {
                $update_user = "UPDATE users SET username='$new_username' WHERE id='$id'";
                mysqli_query($conn, $update_user);
                $_SESSION['username'] = $new_username;
                $success = "Username updated successfully!";
            }
        }

        // Handle password update
        if (!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass)) {
            if ($new_pass !== $confirm_pass) {
                $error = "New passwords do not match!";
            } elseif (!password_verify($current_pass, $row['password_hash'])) {
                $error = "Current password is incorrect!";
            } else {
                $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $update_pass = "UPDATE users SET password_hash='$new_hash' WHERE id='$id'";
                if (mysqli_query($conn, $update_pass)) {
                    $success = "Password updated successfully!";
                } else {
                    $error = "Error updating password.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }
        .card {
            max-width: 500px;
            margin: 60px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="card">
    <h3 class="text-center">Update Profile</h3>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <?php if (!empty($success)) { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>

    <form method="POST">
        <!-- Change Username -->
        <div class="mb-3">
            <label class="form-label">New Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>">
        </div>

        <hr>

        <!-- Change Password -->
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password">
        </div>

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_password">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="confirm_password">
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Update</button>
        <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">Back</a>
    </form>
</div>
</body>
</html>
