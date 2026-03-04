<?php
include "./../assets/config.php";

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    mysqli_query($conn, "DELETE FROM feedback WHERE id=$id");
}

header("Location: admin_inbox.php");
exit;
?>
