<?php
    include("/var/www/html/auth/config221.php");

    //email from index
    $email = $_POST['email'];

    $sql  = " SELECT * FROM name_approve WHERE email = '$email' ";
    $rs   = mysqli_query($con221,$sql);
    $data = mysqli_fetch_array($rs);
    $ro       = $data['ro'];
    $position = $data['position'];

    $link = "";
    if ($position == "ผู้จัดการเขต" || $ro == "HQ" && $email != "kasorn.s@jasmine.com" && $email != "worawit.t@jasmine.com") {
        $sql  = " SELECT * FROM name_approve WHERE email = '$email' AND position = 'ผู้อำนวยการภาค' ";
        $rs   = mysqli_query($con221,$sql);
        $numc = mysqli_num_rows($rs);
        if ($numc > 0) {
            $link = "http://10.10.19.136/user_management/approve/area/area_approve.php";
        } else {
            $link = "http://10.10.19.136/user_management/approve/cluster/cluster_approve.php";
        }       
    } 
    elseif ($position == "ผู้อำนวยการภาค") {
        $link = "http://10.10.19.136/user_management/approve/area/area_approve.php";
    }
    elseif ($position == "NOA" && $email == "kasorn.s@jasmine.com") {
        $link = "http://10.10.19.136/user_management/approve/bossnoa/bossnoa_approve.php";
    }
    elseif ($email == "worawit.t@jasmine.com") {
        $link = "http://10.10.19.136/user_management/approve/head_group/headgroup_approve.php";
    } 
    elseif ($position == "Admin") {
        $link = "http://10.10.19.136/user_management/admin_approve.php";
    } 
    else {
        $link = "not allowed";
    }
    echo $link;
    
    mysqli_close($con221);
?>