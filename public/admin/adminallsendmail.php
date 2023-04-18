<?php
    include("/var/www/html/auth/config221.php");

    $name     = trim($_POST['name']);
    $system   = trim($_POST['system']);
    $detail   = trim($_POST['detail']);
    $datamessage = $_POST['textmail'];
    $nameadmin= $_POST['nameadmin'];

    $sql = " SELECT
                    * 
                FROM
                    data_user_management 
                WHERE
                    status_cluster != '2' 
                    AND status_area != '2' 
                    AND status_boss != '2' 
                    AND status_head != '2' 
                    AND status_cluster = '1' 
                    AND status_area = '1' 
                    AND status_boss = '1' 
                    AND status_head = '1' 
                    AND status_admin = '0' 
                    AND name_user_send = '$name' 
                    AND system = '$system' ";
    if ($system == "TELNET" && strpos($detail, "DSLAM FTTX: Level 2 (Config)") !== false 
        || $system == "TELNET" && strpos($detail, "ZTE OLT") !== false 
        || $system == "WEB COMMAND" && strpos($detail, "DSLAM FTTX: Level 2 (Config)") !== false) {
        $sql .= " AND detail LIKE '%$detail%' ";
    }
    $rs = mysqli_query($con221,$sql);
    $date  = date("Y-m-d H:i:s");
    while ($row = mysqli_fetch_array($rs)) {
        $id              = $row['id'];
        $email           = $row['email'];
        $email_user_send = $row['email_user_send'];
        
        if ($email != $email_user_send) {
            $summail .= ",$email";
        }

        $update = " UPDATE data_user_management SET status_admin = '1', date_admin = '$date', name_admin = '$nameadmin', date_approve = '$date' WHERE id = '$id' ";
        mysqli_query($con221,$update);
    }
    $emailsend = $email_user_send.$summail;

    $aremail = explode(",",$emailsend);

    for ($i=0; $i < count($aremail); $i++) { 
        if ($i == 0) {
            $sql = " SELECT name_user_send FROM data_user_management WHERE email_user_send = '$aremail[$i]' LIMIT 1 ";
            $rs  = mysqli_query($con221,$sql);
            $data = mysqli_fetch_array($rs);
            $name_user_send = $data['name_user_send'];
            $email = $aremail[$i];
            sendmail($email, $datamessage, $name_user_send);
        } else {
            $sql = " SELECT name FROM data_user_management WHERE email = '$aremail[$i]' LIMIT 1 ";
            $rs  = mysqli_query($con221,$sql);
            $data = mysqli_fetch_array($rs);
            $name = $data['name'];
            $email = $aremail[$i];
            sendmail($email, $datamessage, $name);
        }
    }

    //======================================= Mail =============================================

    function sendmail($email, $datamessage, $name_user_send) {
        $from = "webnoa@jasmine.com";
        $to = $email;
        #$to = 'tunratorn.p@jasmine.com';
        $subject = "ขออนุมัติเปิดสิทธิ์การใช้งานของระบบ Web NOA USER MANAGEMENT ";
        $sub = '=?UTF-8?B?'.base64_encode($subject).'?=';
        $message  = "<html>
                        <head>
                            <style>
                                html,body{
                                    margin: 0;
                                    padding: 10px;
                                }
                                h4{
                                    font-size: 22px;
                                    margin: auto;
                                }
                                p {
                                    font-size: 18px;
                                    margin-left: 70px;
                                }
                            </style>
                        </head>
                    <body>
                    <h4>เรียน คุณ$name_user_send</h4>";
        $message .= $datamessage;           
        $message .= "<FONT color=#002CF3  size=2>
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

?>