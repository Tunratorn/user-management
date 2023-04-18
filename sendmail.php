<?php
    //check login
    include "../auth/session.php";
    //---------------------------------------------------------------
    include("/var/www/html/auth/config221.php");
    session_start();
    //api jas
	$email_user_send  = $_SESSION['email_system_webnoa'];
	$name_user_send   = $_SESSION['name_system_webnoa'];

    $datauser     = $_POST['datauser'];
    $emailapprove = $_POST['emailapprove'];

    $link_approve 	 = "http://10.10.19.136/user_management/check_user_approve.php";

    $sqlapprove  = " SELECT name,email FROM name_approve WHERE email = '$emailapprove' ";
    $rsapprove   = mysqli_query($con221,$sqlapprove);
    $dataapprove = mysqli_fetch_array($rsapprove);
    $name_approve = $dataapprove['name'];
    $mailto      = "เรียน คุณ".$name_approve;
    
    $datacut = explode('|',$datauser);
    #print_r($datacut);
    $no = 1;
    $textdatauser = "";
    $textsystem   = "";
    for ($x = 0; $x < count($datacut); $x++) {
        $datadetail = explode('+',$datacut[$x]);
        #print_r($datadetail);
        $iduser     = $datadetail[0];
        $name       = $datadetail[1];
        $email      = $datadetail[2];
        $position   = $datadetail[3];
        $ro         = $datadetail[4];
        $cluster    = $datadetail[5];
        $system     = $datadetail[6];
        $detail     = $datadetail[7];
    
        $sumtextsystem[] = $system;
    
        $textdatauser .= "<tr>
                            <td>$no</td>
                            <td>$iduser</td>
                            <td>$name</td>
                            <td>$email</td>
                            <td>$position</td>
                            <td>$ro</td>
                            <td>$cluster</td>
                            <td>$system</td>
                            <td>$detail</td>
                        </tr>";
        insert($iduser,$name,$email,$position,$ro,$cluster,$system,$detail,$name_user_send,$email_user_send,$emailapprove);
        $no++;
    }
    
    $unique = array_unique($sumtextsystem);
    foreach ($unique as $datasystem) {
        $textsystem .= " ระบบ ".$datasystem;
    }
    
    $datamessage = "<h1>$mailto</h1>
                    <h2 class='h2'>ขออนุมัติเปิดสิทธิ์การใช้งาน Web NOA USER MANAGEMENT :$textsystem มีรายชื่อดังต่อไปนี้</h2>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>รหัสพนักงาน</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Position</th>
                            <th>RO</th>
                            <th>Cluster</th>
                            <th>ระบบ</th>
                            <th>Detail</th>
                        </tr>
                        $textdatauser
                    </table>";

    sendmail($emailapprove, $datamessage, $link_approve, $name_user_send, $email_user_send);

    //======================================= Mail =============================================

    function sendmail($email, $datamessage, $link_approve, $name_user_send, $email_user_send) {
        $from = "webnoa@jasmine.com";
        $to = $email;
        #$to = 'tunratorn.p@jasmine.com';
        $subject = "ขออนุมัติเปิดสิทธิ์การใช้งานของระบบ Web NOA USER MANAGEMENT";
        $sub = '=?UTF-8?B?'.base64_encode($subject).'?=';
        $message  = "<html>
                        <head>
                        <style>
                            html,body{
                                margin: 0;
                                padding: 10px;
                            }
                            h1{
                                font-size: 24px;
                                margin: auto;
                            }
                            .h2{
                                margin-left: 70px;
                            }
                            table {
                                width:100%;
                            }
                            table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                            }
                            th, td {
                                font-size: 18px;
                            }
                            td {
                                padding: 0 10px;
                            }
                            tr:nth-child(even) {
                                background-color: #eee;
                            }
                            tr:nth-child(odd) {
                            background-color: #fff;
                            }
                            th {
                                background-color: black;
                                color: white;
                            }
                            p {
                                font-size: 20px;
                            }
                        </style>
                        </head>
                    <body>";
        $message .= $datamessage;           
        $message .= "<p>เข้าไปกดอนุมัติได้ที่ >>> <a class='mark-group' href='".$link_approve."'>Approve</a></p><br>
                        <FONT color=#002CF3  size=2>
                            <SPAN style='COLOR: #000 ; FONT-SIZE: 22px'>".$name_user_send."</SPAN><br>
                            <SPAN style='COLOR: #000 ; FONT-SIZE: 14px'>E-mail: ".$email_user_send."</SPAN><br>
                        </FONT><br>
                        <hr>
                        <h3>** Mail จากระบบ Web NOA USER MANAGEMENT มีข้อสงสัยกรุณาติดต่อที่ noa_tttbb@jasmine.com **</h3>
                        <FONT color=#002CF3  size=2><SPAN style='COLOR: #002CF3 ; FONT-SIZE: 14px'>Network Operation Access (<st1:personname u4:st='on'>NOA</st1:personname>)
                        <br>
                            </SPAN></FONT><FONT color=#008CE1 ><SPAN style='COLOR: #008CE1 ; FONT-SIZE: 14px'>Triple T Broadband PCL.
                            <BR>
                            <SPAN class='copyright'>&copy; Contact: 02-1007513, 02-1007885, 02-1007511, 02-1007508, 02-1007503</SPAN></SPAN>
                        </FONT>
                    </body>
                    </html>";
    
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From:".$from." \r\n";
        $headers .= "Bcc: noa_tttbb@jasmine.com"." \r\n";
        mail($to,$sub,$message, $headers);
    }
    
    //======================================= Insert data =============================================
    
    function insert($id_user,$name,$email,$position,$ro,$cluster,$system,$detail,$name_user_send,$email_user_send,$cluster_approve) {
        global $con221;
        $date_send  = date("Y-m-d H:i:s");
        $status_cluster = "0";
        $status_area    = "0";
        $status_boss    = "0";
        $status_head    = "0";
        $status_admin   = "0";

        $sql_check  = " SELECT * FROM name_approve WHERE email = '$cluster_approve' AND position = 'ผู้อำนวยการภาค' ";
        $rss        = mysqli_query($con221,$sql_check);
        $numcount   = mysqli_num_rows($rss);
        if ($numcount > 0) {
            $area_approve    = $cluster_approve;
            $cluster_approve = "";
            $status_cluster = "1";
        }

        if ($cluster_approve == "kasorn.s@jasmine.com") {
            $boss_noa        = $cluster_approve;
            $cluster_approve = "";
            $status_cluster = "1";
            $status_area    = "1";
        }

        if ($cluster_approve == "worawit.t@jasmine.com") {
            $head_group     = $cluster_approve;
            $cluster_approve = "";
            $status_cluster = "1";
            $status_area    = "1";
            $status_boss    = "1";
        }

        $sql = "INSERT INTO data_user_management ( 
                            id_user, 
                            name, 
                            email, 
                            position, 
                            ro, 
                            cluster, 
                            system, 
                            detail, 
                            name_user_send, 
                            email_user_send, 
                            date_send, 
                            cluster_approve, 
                            status_cluster, 
                            area_approve, 
                            status_area, 
                            boss_noa, 
                            status_boss,
                            head_group,
                            status_head,
                            status_admin
                        )
                        VALUES
                        (
                            '$id_user',
                            '$name',
                            '$email',
                            '$position',
                            '$ro',
                            '$cluster',
                            '$system',
                            '$detail',
                            '$name_user_send',
                            '$email_user_send',
                            '$date_send',
                            '$cluster_approve',
                            '$status_cluster',
                            '$area_approve',
                            '$status_area',
                            '$boss_noa',
                            '$status_boss',
                            '$head_group',
                            '$status_head',
                            '$status_admin'
                        )";
        mysqli_query($con221,$sql);
        #echo $sql;
    }

    mysqli_close($con221);
?>