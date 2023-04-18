<?php
    include("/var/www/html/auth/config221.php");

    $id = $_POST['id'];

    $sql = " DELETE FROM data_user_management WHERE id = '$id' ";
    mysqli_query($con221, $sql);

?>