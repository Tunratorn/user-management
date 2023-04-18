<?php
    include("/var/www/html/auth/config221.php");

    $id = $_POST['id'];

    $sql = " DELETE FROM name_approve WHERE id = '$id' ";
    mysqli_query($con221, $sql);

?>