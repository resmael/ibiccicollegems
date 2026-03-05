<?php
include '../../assets/config.php'; // kung nasaan ang DB connection mo

function generateRandomID($length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomID = '';
    for ($i = 0; $i < $length; $i++) {
        $randomID .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomID;
}


$id = intval($_GET['id'] ?? 0);
$get = mysqli_query($conn, "SELECT * FROM studentregister WHERE id = '$id'");
if ($row = mysqli_fetch_assoc($get)) {
    $randomID = generateRandomID(); // Generate random ID
    $course = mysqli_real_escape_string($conn, $row['gradecourse']);
    $insert = mysqli_query($conn, "
  INSERT INTO student (studentid, studenttype, firstname, middlename, lastname, address, gradecourse, majortrack, civilstatus, sex, religion, dateofbirth, placeofbirth, contactnumber, email, citizenship, lastschoolattend, previousschooladdress, generalaverage, fathersname, fathersoccupation, fathersaddress, fatherscontactnumber, mothersname, mothersoccupation, mothersaddress, motherscontactnumber)
  VALUES (
    '$randomID',
    '".mysqli_real_escape_string($conn,$row['studenttype'])."',
    '".mysqli_real_escape_string($conn,$row['firstname'])."',
    '".mysqli_real_escape_string($conn,$row['middlename'])."',
    '".mysqli_real_escape_string($conn,$row['lastname'])."',
    '".mysqli_real_escape_string($conn,$row['address'])."',
    '$course',
    '".mysqli_real_escape_string($conn,$row['majortrack'])."',
    '".mysqli_real_escape_string($conn,$row['civilstatus'])."',
    '".mysqli_real_escape_string($conn,$row['sex'])."',
    '".mysqli_real_escape_string($conn,$row['religion'])."',
    '".mysqli_real_escape_string($conn,$row['dateofbirth'])."',
    '".mysqli_real_escape_string($conn,$row['placeofbirth'])."',
    '".mysqli_real_escape_string($conn,$row['contactnumber'])."',
    '".mysqli_real_escape_string($conn,$row['email'])."',
    '".mysqli_real_escape_string($conn,$row['citizenship'])."',
    '".mysqli_real_escape_string($conn,$row['lastschoolattend'])."',
    '".mysqli_real_escape_string($conn,$row['previousschooladdress'])."',
    '".mysqli_real_escape_string($conn,$row['generalaverage'])."',
    '".mysqli_real_escape_string($conn,$row['fathersname'])."',
    '".mysqli_real_escape_string($conn,$row['fathersoccupation'])."',
    '".mysqli_real_escape_string($conn,$row['fathersaddress'])."',
    '".mysqli_real_escape_string($conn,$row['fatherscontactnumber'])."',
    '".mysqli_real_escape_string($conn,$row['mothersname'])."',
    '".mysqli_real_escape_string($conn,$row['mothersoccupation'])."',
    '".mysqli_real_escape_string($conn,$row['mothersaddress'])."',
    '".mysqli_real_escape_string($conn,$row['motherscontactnumber'])."'
  )
");
    if ($insert) {
        mysqli_query($conn, "DELETE FROM studentregister WHERE id = '$id'");
        switch ($course) {
            case 'BSIT': header("Location: ../student-module/bsit/1styear/1styear.php"); break;
            case 'BSCS': header("Location: ../student-module/bscs/1styear/1styear.php"); break;
            case 'BSCRIM': header("Location: ../student-module/bscrim/1styear/1styear.php"); break;
            case 'BSSW': header("Location: ../student-module/bssw/1styear/1styear.php"); break;
            case 'BSM': header("Location: ../student-module/bsm/1styear/1styear.php"); break;
            case 'BSN': header("Location: ../student-module/bsn/1styear/1styear.php"); break;
            case 'BEED': header("Location: ../student-module/beed/1styear/1styear.php"); break;
            case 'BSED ENGLISH': header("Location: ../student-module/bsed-english/1styear/1styear.php"); break;
            case 'BSED MATH': header("Location: ../student-module/bsed-math/1styear/1styear.php"); break;
            default: header("Location: registered.php"); break;
        }
        exit();
    } else {
        echo "Error inserting: " . mysqli_error($conn);
    }
} else {
    echo "Student not found.";
}
?>

