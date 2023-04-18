<?php
    include("/var/www/html/auth/config221.php");

    $name     = trim($_POST['name']);
    $system   = strtoupper(trim($_POST['system']));
    $detail   = trim($_POST['detail']);
    $textmail = $_POST['textmail'];

    if ($name == "" || $system == "") {
        echo"Error information empty";
        exit;
    }

    $sql = " SELECT email_user_send FROM data_user_management WHERE	name_user_send = '$name' LIMIT 1 ";
    $rs  = mysqli_query($con221,$sql);
    $rowcount = mysqli_num_rows($rs);
    if ($rowcount == "0") {
        echo"Error no information";
        exit;
    }

    if ($system != "" && $textmail == "") {
        if ($system == "MOBILE") {
            $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                          <p>ระบบ : MOBILE</p>
                          <p>User : email ไม่มี @jasmine.com (เช่น aaa.t)</p>
                          <p>Pass : abc1234</p>
                          <p>เปลี่ยน password เมื่อ Login ครับ</p>";
        }
        elseif ($system == "UNM2000") {
            $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                          <p>ระบบ : UNM2000</p>
                          <p>User : email ไม่มี @jasmine.com (เช่น aaa.t)</p>
                          <p>Pass : abc12345</p>
                          <p>เปลี่ยน password เมื่อ Login ครับ</p>
                          <p>แนวทางการติดตั้ง UNM2000 : <a>http://10.10.19.136/unet/manual/file/OMN20210303135324001_%E0%B9%81%E0%B8%99%E0%B8%A7%E0%B8%97%E0%B8%B2%E0%B8%87%E0%B8%95%E0%B8%B4%E0%B8%94%E0%B8%95%E0%B8%B1%E0%B9%89%E0%B8%87%20UNM2000.pdf</a></p>";
        }
        elseif ($system == "NCE FAN") {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : NCE FAN</p>
                        <p>User : email ไม่มี @jasmine.com (เช่น aaa.t)</p>
                        <p>Pass : abc12345</p>
                        <p>เปลี่ยน password เมื่อ Login ครับ</p>";
        }
        elseif ($system == "NCE WIFI SENSE") {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : NCE WIFI SENSE</p>
                        <p>Username web portal: email ไม่มี @jasmine.com (เช่น aaa.t)</p>
                        <p>Username LinkHome Assistant App: email ไม่มี @jasmine.com_app (เช่น aaa.t_app)</p>
                        <p>Password: Abc_1234 (ระบบจะให้เปลี่ยน password หลัง login ครั้งแรกครับ)</p>";
        }
        elseif ($system == "U31") {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : U31</p>
                        <p>User : email ไม่มี @jasmine.com (เช่น aaa.t)</p>
                        <p>Pass : Abc_12345</p>
                        <p>เปลี่ยน password เมื่อ Login ครับ</p>
                        <p>คู่มือการใช้งานและแนวทางการติดตั้ง U31 : <a>http://10.10.19.136/unet/manual/file/NMN20220420132607001_%E0%B8%84%E0%B8%B9%E0%B9%88%E0%B8%A1%E0%B8%B7%E0%B8%AD%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%95%E0%B8%B4%E0%B8%94%E0%B8%95%E0%B8%B1%E0%B9%89%E0%B8%87%20%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99%20U31.rar</a></p>";
        }
        elseif ($system == "WEB COMMAND" && strpos($detail, "DSLAM FTTX: Level 2 (Config)") !== false) {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : WEB COMMAND</p>
                        <p>คู่มือการ Reset Password สำหรับ User Level 2 : <a>http://10.10.19.136/unet/manual/file/DFMN20210225152127001_reset%20pass%20user%20lv2.pdf</a></p>
                        <p>เข้าใช้งานระบบ web command ได้ที่ : <a>http://10.10.19.122/webcommand/</a></p>";
        }
        elseif ($system == "TELNET" && strpos($detail, "DSLAM FTTX: Level 2 (Config)") !== false || $system == "TELNET" && strpos($detail, "ZTE OLT") !== false) {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : TELNET</p>";
            if (strpos($detail, "ZTE OLT") !== false) {
              $textmail .= "<p>telnet node zte ใช้ username ไม่มี @3bb</p>
                            <p>Ex. user : aaa.t</p>";
            }
          $textmail .= "<p>คู่มือการ Reset Password สำหรับ User Level 2 : <a>http://10.10.19.136/unet/manual/file/DFMN20210225152127001_reset%20pass%20user%20lv2.pdf</a></p>";
        }
        else {
          $textmail = "<p>ดำเนินการเพิ่มสิทธิ์เข้าใช้งานระบบเรียบร้อยแล้วครับ</p>
                        <p>ระบบ : $system</p>";
        }
    }

    $name      = "'".$name."'";
    $system    = "'".$system."'";
    $detail    = "'".$detail."'";
?>

<div class="mt-2 mb-2">
    <div>
        <span>Format Sendmail</span>
    </div>
    <div id="textmail" style="text-align: left;" class="boxtextmail">
        <?=$textmail ?>
    </div>
</div>
<button id="btn_backsendmail" onclick="backallsendmail(<?=$name ?>,<?=$system ?>,<?=$detail ?>)" style="width: 100px;" type="button" class="btn btn-secondary btnapprove fontTH text-uppercase m-3">Back</button>
<button id="btn_nextsendmail" onclick="allsendmail(<?=$name ?>,<?=$system ?>)" style="width: 100px;" type="button" class="btn btn-success btnapprove fontTH text-uppercase m-3" >Send</button>
<div>
  <span id="closepopupsendmail" class="closesendmail" onclick="closepopup()">close</span>
</div>