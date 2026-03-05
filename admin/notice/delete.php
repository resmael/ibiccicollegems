<?php
include('../../assets/config.php'); // db connection

if (isset($_GET['s_no'])) {
    $s_no = intval($_GET['s_no']); // sanitize input

    $query = "DELETE FROM notice WHERE s_no = $s_no";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // redirect back with success message
        header("Location: schedule.php?msg=Notice deleted successfully");
        exit();
    } else {
        echo "<p style='color:red;'>❌ Error deleting notice: " . mysqli_error($conn) . "</p>";
        echo "<a href='notice.php'>⬅ Back</a>";
    }
} else {
    echo "<p style='color:red;'>⚠ No s_no provided.</p>";
    echo "<a href='notice.php'>⬅ Back</a>";
}
?>
