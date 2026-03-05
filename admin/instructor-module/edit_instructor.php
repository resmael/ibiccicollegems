<?php
include('../../assets/config.php');

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM instructor_info WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $program = $_POST['program'];
    $year_level = $_POST['year_level'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $query = "UPDATE instructor_info 
              SET fullname='$fullname', program='$program', year_level='$year_level', email='$email', contact_number='$contact' 
              WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Instructor updated successfully'); window.location='instructor.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Instructor</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-container {
      max-width: 600px;
      margin: 50px auto;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-custom {
      background: #198754;
      color: white;
      font-weight: 500;
      border-radius: 10px;
    }
    .btn-custom:hover {
      background: #157347;
    }
  </style>
</head>
<body>

  <div class="container form-container">
    <div class="card p-4">
      <h3 class="text-center mb-4">Edit Instructor</h3>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Assigned Program</label>
          <select class="form-select" name="program" required>
            <option value="BSIT" <?php if($row['program']=="BSIT") echo "selected"; ?>>BSIT</option>
            <option value="BSCRIM" <?php if($row['program']=="BSCRIM") echo "selected"; ?>>BSCRIM</option>
            <option value="BSCS" <?php if($row['program']=="BSCS") echo "selected"; ?>>BSCS</option>
            <option value="BSSW" <?php if($row['program']=="BSSW") echo "selected"; ?>>BSSW</option>
            <option value="BEED" <?php if($row['program']=="BEED") echo "selected"; ?>>BEED</option>
            <option value="BSED MATH" <?php if($row['program']=="BSED MATH") echo "selected"; ?>>BSED MATH</option>
            <option value="BSED ENGLISH" <?php if($row['program']=="BSED ENGLISH") echo "selected"; ?>>BSED ENGLISH</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Year Level</label>
          <input type="text" class="form-control" name="year_level" value="<?php echo $row['year_level']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" class="form-control" name="contact" value="<?php echo $row['contact_number']; ?>" required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="instructor.php" class="btn btn-secondary">Cancel</a>
          <button type="submit" name="update" class="btn btn-custom">Update Instructor</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
