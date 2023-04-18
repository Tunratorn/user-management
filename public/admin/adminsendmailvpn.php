<?php
    include("/var/www/html/auth/config221.php");

    $id       = $_POST['id'];
    $nameadmin= $_POST['nameadmin'];

    $date  = date("Y-m-d H:i:s");
    $update = " UPDATE data_user_management SET status_admin = '1', date_admin = '$date', name_admin = '$nameadmin', date_approve = '$date' WHERE id = '$id' ";
    mysqli_query($con221,$update);

    $sql  = " SELECT * FROM data_user_management  WHERE id = '$id' ";
    $rs   = mysqli_query($con221,$sql);
    $row  = mysqli_fetch_array($rs);
    $id_user         = $row['id_user'];
    $name            = $row['name'];
    $email           = $row['email'];
    $positon         = $row['positon'];
    $ro              = $row['ro'];
    $system          = $row['system'];
    $name_user_send  = $row['name_user_send'];
    $email_user_send = $row['email_user_send'];
    $cluster_approve = $row['cluster_approve'];
    $date_cluster    = $row['date_cluster'];
    $area_approve    = $row['area_approve'];
    $boss_noa        = $row['boss_noa'];
    $date_admin      = $row['date_admin'];

    //check email approve
    if ($cluster_approve == "") {
        if ($area_approve != "") {
            $emailapprove = $area_approve;
        }
        if ($boss_noa != "") {
            $emailapprove = $boss_noa;
        }
    } else {
        $emailapprove = $cluster_approve;
    }

    $sqlapprove  = " SELECT * FROM name_approve WHERE email = '$emailapprove' ";
    $rsapprove   = mysqli_query($con221,$sqlapprove);
    $dataapprove = mysqli_fetch_array($rsapprove);
    $name_approve     = $dataapprove['name'];
    $position_approve = $dataapprove['position'];
    $ro_approve       = $dataapprove['ro'];

    $sumemail = "$email_user_send,$email";

    for ($i = 1; $i < 3; $i++) { 
		if ($i == '1') {
			$email = "natthanon.p@jasmine.com";
            //user approve
            $datamessage = "<h4>เรียน IT</h4>
                        <p>ขออนุมัติเปิดสิทธิ์การใช้งาน VPN HOTSPOT WIFI มีรายชื่อดังต่อไปนี้</p>
                        <h4>ชื่อผู้อนุมัติ</h4>
                        <table>
							<tr>
                                <th>NO</th>
								<th>Name</th>
								<th>E-mail</th>
								<th>Position</th>
								<th>RO</th>
								<th>วันที่อนุมัติ</th>
							</tr>
							<tr>
                                <td>1</td>
								<td>".$name_approve."</td>
								<td>".$emailapprove."</td>
								<td> ".$position_approve."</td>
								<td>".$ro_approve."</td>
								<td>".$date_cluster."</td>
							</tr>
							<tr>
                                <td>2</td>
								<td>สุธีร์ ตันเปาว์</td>
								<td>tsutee@jasmine.com</td>
								<td>NOA Wifi</td>
								<td>HQ</td>
								<td>".$date_admin."</td>
							</tr>
						</table><br>";
			//name user
			$datamessage .= "<h4>ชื่อผู้ขอสิทธิ์การใช้งานระบบ</h4>
			            <table>
							<tr>
								<th>รหัสพนักงาน</th>
								<th>Name</th>
								<th>E-mail</th>
								<th>Position</th>
								<th>RO</th>
								<th>ระบบ</th>
								<th>รายละเอียด</th>
							</tr>
							<tr>
								<td>$id_user</td>
								<td>$name</td>
								<td>$email</td>
								<td>$positon</td>
								<td>$ro</td>
								<td>$system</td>
								<td>ขออนุมัติสิทธิ์เข้าใช้งาน VPN HOTSPOT WIFI ให้สามารถ access เข้าถึงอุปกรณ์ เพื่อ support เหตุเสียอุปกรณ์ Hotspot</td>
							</tr>
						</table><br>";
            sendmail($email, $datamessage);
		}else {
			$email = $sumemail;
			$datamessage = "<h4>เรียนคุณ $name_user_send</h4>
			            <p>ระบบ : VPN HOTSPOT WIFI</p>
					    <p>IT กำลังดำเนินการ โปรดรอ email วิธีใช้งานจาก IT</p>";
            sendmail($email, $datamessage);
		}
    }


    //======================================= Mail =============================================

    function sendmail($email, $datamessage) {
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
                            </style>
                        </head>
                    <body>";
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

    mysqli_close($con221);
?>