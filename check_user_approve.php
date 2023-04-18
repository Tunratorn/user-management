<?php
    //check login
    include "../auth/session.php";
    //---------------------------------------------------------------
    session_start();
    //api jas
    $email  = $_SESSION['email_system_webnoa'];
    $name   = $_SESSION['name_system_webnoa'];

    include("/var/www/html/auth/config221.php");

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
        $link = "";
    }
    #echo $link;
    
    mysqli_close($con221);
?>

<script>
    var data = "<?=$link ?>";
    if (data != "") {
        location.href = data;
    } else {
        alert("คุณไม่สามารถเข้าใช้งานหน้านี้ได้");
        location.href = "http://10.10.19.136/user_management/";
    }
</script>