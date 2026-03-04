<?php
include('../../assets/config.php'); // your db connection file

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $program = $_POST['program'];
    $year_level = $_POST['year_level'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO instructor_info (fullname, program, year_level, email, contact_number) 
              VALUES ('$fullname', '$program', '$year_level', '$email', '$contact')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Instructor added successfully'); window.location='instructor.php';</script>";
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
  <title>Add Instructor</title>
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
      background: #0d6efd;
      color: white;
      font-weight: 500;
      border-radius: 10px;
    }
    .btn-custom:hover {
      background: #0b5ed7;
    }
    .btn-back {
      background: #6c757d;
      color: white;
      font-weight: 500;
      border-radius: 10px;
    }
    .btn-back:hover {
      background: #5a6268;
    }
  </style>
</head>
<body>

  <div class="container form-container">
    <div class="card p-4">
      <h3 class="text-center mb-4">Add Instructor</h3>
      <form method="POST" action="">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fullname" placeholder="Enter full name" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Assigned Program</label>
          <select class="form-select" name="program" required>
            <option selected disabled>Choose program...</option>
            <option value="BSIT">BSIT</option>
            <option value="BSCRIM">BSCRIM</option>
            <option value="BSCS">BSCS</option>
            <option value="BSSW">BSSW</option>
            <option value="BEED">BEED</option>
            <option value="BSED MATH">BSED MATH</option>
            <option value="BSED ENGLISH">BSED ENGLISH</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Year Level</label>
          <input type="text" class="form-control" name="year_level" placeholder="e.g. 1st Year" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" class="form-control" name="contact" placeholder="Enter contact number" required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="instructor.php" class="btn btn-back btn-lg">← Back</a>
          <button type="submit" name="submit" class="btn btn-custom btn-lg">Add Instructor</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
