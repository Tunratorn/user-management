<?php
    include("/var/www/html/auth/config221.php");

    $id        = $_POST['id'];
    $nameadmin = $_POST['name'];
    $state     = $_POST['state'];

    $date   = date("Y-m-d H:i:s");

    if ($id != "") {
        $update = " UPDATE data_user_management 
                    SET status_admin = '2',
                        date_admin = '$date',
                        name_admin = '$nameadmin' 
                    WHERE
                        id = '$id' ";
        mysqli_query($con221,$update);
    } 

    if ($state == "notapproveall") {
        $update = " UPDATE data_user_management 
                    SET status_admin = '2',
                        date_admin = '$date',
                        name_admin = '$nameadmin' 
                    WHERE  
                        system = 'VPN HOTSPOT WIFI' 
                        AND status_cluster = '1' 
                        AND status_area = '1' 
                        AND status_boss = '1' 
                        AND status_head = '1' 
                        AND status_admin = '0' ";
        mysqli_query($con221,$update);
    }

    mysqli_close($con221);
?>