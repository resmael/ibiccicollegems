<?php
include('../../assets/config.php');

if (isset($_POST['submit'])) {
    $noticeto   = mysqli_real_escape_string($conn, $_POST['noticeto']);
    $textarea   = mysqli_real_escape_string($conn, $_POST['textarea']);

    if (empty($noticeto) || empty($textarea)) {
        echo "<font color='red'>All fields are required.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // Insert into notices table
        $query = "INSERT INTO notices (noticeto, notice_text) VALUES ('$noticeto', '$textarea')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<p><font color='green'>Notice added successfully!</font></p>";
            echo "<a href='schedule.php'>View Notices</a>";
        } else {
            echo "<p><font color='red'>Database Error: " . mysqli_error($conn) . "</font></p>";
        }
    }
}
?>
