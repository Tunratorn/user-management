<?php
    include("/var/www/html/auth/config221.php");

    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $position = $_POST['position'];
    $ro       = $_POST['ro'];
    $cluster  = $_POST['cluster'];

    $sql = " UPDATE name_approve 
            SET name = '$name',
                email = '$email',
                position = '$position',
                ro = '$ro',
                cluster = '$cluster' 
            WHERE
                id = '$id' ";
    mysqli_query($con221, $sql);

?>