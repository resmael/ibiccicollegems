<?php
include '../../assets/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM instructor_info WHERE id=$id");
    echo "<script>alert('Instructor deleted successfully'); window.location='instructor.php';</script>";
}
?>
