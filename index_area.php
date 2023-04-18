<?php
    //check login
    include "../auth/session.php";
    //---------------------------------------------------------------
    session_start();
    //api jas
    $email  = $_SESSION['email_system_webnoa'];
    $name   = $_SESSION['name_system_webnoa'];
    // for a single variable
    // unset($_SESSION['mailapprove_by_admin']); 
    // unset($_SESSION['nameapprove_by_admin']); 


    //user test
    $email = "pongsa.n@jasmine.com";
    $name  = "พงศา นวมครุฑ";

    $_SESSION['mailapprove_by_admin'] = $email;
    $_SESSION['nameapprove_by_admin'] = $name;
    
    include("/var/www/html/auth/config221.php");
    $sql  = " SELECT * FROM name_approve WHERE email = '$email' AND position = 'Admin' ";
    $rs   = mysqli_query($con221,$sql);
    $data = mysqli_fetch_array($rs);
    $position = $data['position'];
    $display = "";
    if ($position != "Admin") {
        $display = "display: none;";
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOA USER MANAGEMENT</title>
    <link rel="icon" type="image/png" href="img/logouser2.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alert.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.0/js/foundation.min.js"></script>
    <script src="js/alert.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</head>
<style>
    .ck-editor__editable_inline {
        min-height: 130px;
    }
    #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%; 
        min-height: 100%;
        z-index: -1;
    }
</style>
<body>
    <video autoplay muted loop id="myVideo">
        <source src="img/Chip2.mp4" type="video/mp4">
    </video>
    <!-- loading -->
    <div id="loading" class="loading">
        <div class="loadingcss">
            <div class="text-center">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                <p style="color: #fff;">Please wait...</p>
            </div>
        </div>
    </div>
    <!-- slider_list_menu -->
    <div id="slider_list_menu" class="slider-list-menu">
        <div class="slider-showdata container col-lg-3 col-md-4 vh-100 overflow-auto">
            <h3 class="text-center p-2 m-3 text-uppercase">System NOA</h3>
            <ul class="m-3 text-uppercase">
                <li class="p-2 cursor"><a class="amenuhover" id="web_noa" onclick="webnoa()">Web NOA</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="web_command" onclick="webcommand()">Web Command</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="btntelnet">telnet</a></li>
                <div id="listtelnet" class="listtelnet">
                    <li class="p-2 cursor"><a class="amenuhover" id="telnet" onclick="telnetolt()">TELNET HUAWEI DSLAM OLT</a></li>
                    <li class="p-2 cursor"><a class="amenuhover" id="telnet" onclick="telnetbras()">TELNET BRAS</a></li>
                    <li class="p-2 cursor"><a class="amenuhover" id="telnet" onclick="telnetdcn()">TELNET Radius DCN</a></li>
                    <li class="p-2 cursor"><a class="amenuhover" id="telnet" onclick="telnetzte()">TELNET ZTE OLT</a></li>
                </div>
                <li class="p-2 cursor"><a class="amenuhover" id="mobile_app" onclick="mobile_app()">Mobile App</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="nce_fan" onclick="nce_fan()">NCE Fan</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="nce_wifisense" onclick="nce_wifisense()">NCE Wifi Sense</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="unm2000" onclick="unm2000()">UNM2000</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="vpn" onclick="vpn()">VPN HOTSPOT WIFI</a></li>
                <li class="p-2 cursor"><a class="amenuhover" id="u31" onclick="u31()">U31</a></li>
            </ul>
            <div class="d-flex justify-content-center m-3">
                <div class="position-absolute bottom-0 p-3">
                    <a id="closelist_menu">Close</a>
                </div>
            </div>
            <!-- <div id="showlist_manu"></div> -->
        </div>
    </div>
    <div id="bgimporttt" class="bgimportfile">
        <div id="popupimportfile" class="boximportfile text-center ">
            <h3 class="m-4">Import File</h3>
            <div class="m-4">
                <div class="textworning">
                    <p class="ptextworning">คำเตือน</p>
                    <p>เพื่อป้องกันปัญหาต่อระบบกรุณาทำตามไฟล์ตัวอย่าง Excel</p>
                </div>
                <label>ไฟล์ตัวอย่าง :</label> 
                <a style="text-decoration: none;" href="http://10.10.19.136/user_management/excel/Example_Excel.xlsx">Download Excel File</a>
                <div class="box--import m-3">
                    <label>Import Excel File</label> 
                    <input type="file" id="fileToUpload" accept=".xlsx,.xls" style="width: 300px;">
                </div>
                <button id="btnImport" type="button" class="btn btn-primary m-4" style="width: 120px;" onclick="importdata()">Import</button>    
                <div class="text-center mb-5">
                    <a id="close_popupimport" class="m-2">Close</a>
                </div>
            </div>
        </div>
    </div>
    <!-- popup system -->
    <div id="popup_system" class="container-fluid vh-100 bgpopup-system" style="z-index: 999;">
        <div class="container box-popup">
            <div id="showpopup_system"></div>
        </div>
    </div>

    <div id="list_webnoa" class="slider-list-menu_listwebnoa">
        <div class="slider-showdata_listwebnoa container vh-100 overflow-auto" style="width: 550px;">
            <div id="showlist_manu_webnoa">
                <h3 class="text-center p-2 m-3">เลือกเว็บ</h3>
                <ul class="m-3" style="list-style: none;">
                    <li class="p-2 cursor">
                        <input id="detailNSPA" class="form-check-input" type="checkbox" value="ระบบตรวจสอบข้อมูล Node/Slot/Port/Account ลูกค้า">
                        <label class="form-check-label" for="flexCheckDefault">ระบบตรวจสอบข้อมูล Node/Slot/Port/Account ลูกค้า</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailuserlost" class="form-check-input" type="checkbox" value="ข้อมูลลูกค้าหลุดบ่อย">
                        <label class="form-check-label" for="flexCheckDefault">ข้อมูลลูกค้าหลุดบ่อย</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailuserdcn" class="form-check-input" type="checkbox" value="ข้อมูลลูกค้า DCN(Ji ro 3BB)">
                        <label class="form-check-label" for="flexCheckDefault">ข้อมูลลูกค้า DCN(Ji ro 3BB)</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailspeed" class="form-check-input" type="checkbox" value="ข้อมูลการปรับ Speed">
                        <label class="form-check-label" for="flexCheckDefault">ข้อมูลการปรับ Speed</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailDFinven" class="form-check-input" type="checkbox" value="DSLAM and FTTx Inventory">
                        <label class="form-check-label" for="flexCheckDefault">DSLAM and FTTx Inventory</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailSwit" class="form-check-input" type="checkbox" value="ระบบ Switch and Router Management">
                        <label class="form-check-label" for="flexCheckDefault">ระบบ Switch and Router Management</label>
                    </li>
                    <li class="p-2 cursor">
                        <input id="detailOther" class="form-check-input" type="checkbox" value="ระบบอื่นๆ">
                        <label class="form-check-label" for="flexCheckDefault">ระบบอื่นๆ</label>
                    </li>
                </ul>
                <div id="editorwebnoa" class="editorwebnoa">
                    <div>
                    <label style="color: red;">*กรณีต้องการสิทธิ์เข้าใช้หน้าอื่นๆเพิ่มเติม</label>
                        <div class="editorhome" style="width: 470px;">
                            <div id="editortextwebnoa"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center m-3">
                    <div class="text-center">
                        <div class=" p-3" style="bottom: 42px;">
                            <button id="btnok_webnoa" type="button" class="btn btn-primary" style="width: 120px;" onclick="submitwebnoa()">OK</button>
                        </div>
                        <div class=" bottom-0 p-2">
                            <button id="closelist_webnoa" class="btnclose_webnoa">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="page_snedmail" class="container-fluid vh-100 position-fixed page-sendmail" style="background-color: rgb(255, 255, 255); z-index: 109; overflow: auto;">
        <div class="container">
            <div id="showsend_mail"></div>
        </div>
    </div>

    <nav style="z-index: 99;" class="navbar navbar-expand-lg w-100 position-fixed">
        <div class="container-fluid">
          <div class="collapse navbar-collapse " id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <h5 style="margin-left: 10px;" class="text-white">NOA</h5>
              </li>
            </ul>
            <span style="margin-right: 20px;" class="navbar-text">
                <a onclick="checkuser()" style="text-decoration: none;cursor: pointer;" class="linkmenu text-white">Approve</a>
            </span>
            <span style="margin-right: 20px;" class="navbar-text">
                <a id="importfile" style="text-decoration: none;" class="linkmenu text-white" href="#">Import Excel File</a>
            </span>
            <span style="margin-right: 20px;" class="navbar-text">
                <a style="text-decoration: none;" class="linkmenu text-white" href="http://10.10.19.136/user_management/check_approve.php">Check Status</a>
            </span>
            <span style="margin-right: 20px;" class="navbar-text">
                <a style="text-decoration: none;" class="linkmenu text-white manul" target="_blank" href="http://10.10.19.136/unet/manual/file/OMN20230119093014001_%E0%B8%84%E0%B8%B9%E0%B9%88%E0%B8%A1%E0%B8%B7%E0%B8%AD%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99.pdf">คู่มือใช้งานระบบ</a>
            </span>
            <span style="margin-right: 20px; <?=$display ?>" class="navbar-text dropdown">
                <a id="dropadmin" style="text-decoration: none; cursor: pointer;" class="dropdown-toggle dropdown linkmenu text-white">ADMIN</a>
                <div class="dropdown-content">
                    <a class="linkmenu text-white" href="http://10.10.19.136/user_management/admin/admin.php">Admin</a>
                    <a class="linkmenu text-white" href="http://10.10.19.136/user_management/admin/adminvpn.php">AdminVPN</a>
                    <a class="linkmenu text-white" href="http://10.10.19.136/user_management/history_user.php">History User</a>
                    <a class="linkmenu text-white" href="http://10.10.19.136/user_management/name_approve.php">Name Approve</a>
                    <a class="linkmenu text-white" target="_blank" href="http://10.10.19.136/unet/manual/file/OMN20230123114915001_%E0%B8%84%E0%B8%B9%E0%B9%88%E0%B8%A1%E0%B8%B7%E0%B8%AD%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99%20ADMIN.pdf">คู่มือ Admin</a>
                </div>
            </span>
          </div>
        </div>
    </nav>

    <div class="setcenterhead" >
        <div class="position-fixed justify-content-center">
            <div class="container-fluid text-center">
                <h1 class="text-uppercase text-white">Welcome to</h1>
                <h2 class="mb-5 text-white">NOA USER MANAGEMENT</h2>
                <div class="container center">
                    <button id="btn_systemnoa" type="button" class="btn btn-outline-primary text-uppercase">System NOA</button>
                </div>
                <p class="p-5 m-5 text-white">© Contact: 02-1007511, 02-1007885, 02-1007513, 02-1007514</p>
            </div>
        </div>
    </div>

    <input type="hidden" name="boxdata" id="boxdata">

</body>

</html>
<script src="js/ckeditor.js"></script>
<script src="./js/jquery-3.6.0.min.js"></script>
<script>

    var list_manu = document.getElementById("slider_list_menu");
    var popup_system = document.getElementById("popup_system");
    var list_webnoa = document.getElementById("list_webnoa");
    var popupimportfile = document.getElementById("bgimporttt");
    window.onclick = function (event) {
        if (event.target == list_manu) {
            $("#slider_list_menu").removeClass("active-listmanu");
            $("#listtelnet").removeClass("listtelnettoggle");
        }
        if (event.target == popup_system) {
            $("#popup_system").removeClass("active-popup_system");
        }
        if (event.target == list_webnoa) {
            $("#list_webnoa").removeClass("active-listmanu_webnoa");
            submitwebnoa();
        }
        if (event.target == popupimportfile) {
            $("#popupimportfile").removeClass("importfilecss");
            document.getElementById('fileToUpload').value = "";
        }
    }

    function submit(checksystem) {
        var iduser = document.getElementById("iduser").value;
        var ro = document.getElementById("ro").value;
        var boxdata = document.getElementById("boxdata").value;
        var system = document.getElementById("system").value;

        if (iduser == "" || ro == "") {
            alerterror("กรุณาใส่ข้อมูลให้ครบถ้วน");
            return false;
        }
    
        if (checksystem == "MOBILE" || checksystem == "TELNET") {
            var detail = document.getElementById("detail").value;
            if (detail == "") {
                alerterror("กรุณาใส่ข้อมูลให้ครบถ้วน");
                return false;
            }
        } 
        else if (checksystem == "WEB COMMAND") { 
            var detaildslam = document.getElementById("detaildslam").value;
            var detailbras  = document.getElementById("detailbras").value;
            var detail = "";
            if (detaildslam == "") {
                alerterror("กรุณาใส่ข้อมูลให้ครบถ้วน");
                return false;
            }
            if (detailbras != "") {
                detail = "<p>"+detaildslam+"</p><p>"+detailbras+"</p>";
            } else {
                detail = detaildslam;
            }
        }
        else if (checksystem == "VPN HOTSPOT WIFI") { 
            if (document.getElementById("detail").checked == true) {
                var detail = document.getElementById("detail").value;
            } else {
                var detail = "";
            }
        }
        else if (checksystem == "WEB NOA") { 
            if (document.getElementById("defaultWebnoa").checked == true) {
                var defaultWebnoa = document.getElementById("defaultWebnoa").value;
                detail = "<p>"+defaultWebnoa+"</p>";
            } else {
                alerterror("กรุณาใส่ข้อมูลให้ครบถ้วน");
                return false;
            }            
            var dataillistwebnoa = document.getElementById("dataillistwebnoa").value;
           if (dataillistwebnoa != "") {
                detail += dataillistwebnoa;
           }
        }
        else {
            const editorData = editor.getData();
            detail = editorData;
        }
      
        $("#loading").addClass("loadingactive");
        $.ajax({
            url: "datasendmail.php",
            method: "POST",
			data: {
                iduser: iduser,
                ro: ro,
                system: system,
                detail: detail,
                boxdata: boxdata
            },
            success: function (data) {
                if (data == "Error no data user") {
                    $("#loading").removeClass("loadingactive");
                    alerterror("กรุณาเช็คข้อมูลรหัสพนักงาน");
                    return false;
                }
                if (data == "Error duplicate information") {
                    $("#loading").removeClass("loadingactive");
                    alerterror("ข้อมูลถูกเพิ่มไปแล้ว");
                    return false;
                }
                if (data == "Error information wait approve") {
                    $("#loading").removeClass("loadingactive");
                    alerterror("ข้อมูลผู้ใช้อยู่ในระหว่างดำเนินการสามารถตรวจสอบได้ที่หัวข้อ 'Check Status'");
                    return false;
                }
                $("#slider_list_menu").removeClass("active-listmanu");
                $("#listtelnet").removeClass("listtelnettoggle");
                $("#page_snedmail").addClass("active-page_snedmail");
                $("#popup_system").removeClass("active-popup_system");
                if (checksystem == "WEB NOA") {
                    resetwebnoa();
                }
                
                var datareturn = data.split("*CUT*");
                document.getElementById("boxdata").value = datareturn[0];
                $('#showsend_mail').html(datareturn[1]);
                $("#cencel_mail").click(function () {
                    document.getElementById("boxdata").value = null;
                    $("#page_snedmail").removeClass("active-page_snedmail");
                });
                $("#btn_add_system").click(function () {
                    $("#slider_list_menu").addClass("active-listmanu");
                });
                $("#loading").removeClass("loadingactive");
            }
        });
    }

    function sendmail(datamail) {
        var emailapprove = document.getElementById("emailapprove").value;
        if (emailapprove == "") {
            alerterror("กรุณาเลือกผู้อนุมัติ");
            return false;
        }
        // alert(datamail);
        // alert(emailapprove);
        $("#loading").addClass("loadingactive");
        $.ajax({
            url: "sendmail.php",
            method: "POST",
			data: {
                datauser: datamail,
                emailapprove: emailapprove
            },
            success: function (data) {
                document.getElementById("boxdata").value = null;
                alertsuccess();
                $("#page_snedmail").removeClass("active-page_snedmail");
                $("#loading").removeClass("loadingactive");
            }
        });
    }

    function deleteuser(datauser) {
        var boxdata = document.getElementById("boxdata").value;
        var datadelete = boxdata.replace(datauser, "");
        $("#loading").addClass("loadingactive");
        $.ajax({
            url: "datasendmail.php",
            method: "POST",
			data: {
                boxdata: datadelete,
                delete: "deleteuser"
            },
            success: function (data) {
                if (data == "Error data empty") {
                    document.getElementById("boxdata").value = null;
                    $("#page_snedmail").removeClass("active-page_snedmail");
                    $("#loading").removeClass("loadingactive");
                    return false;
                }
                var datareturn = data.split("*CUT*");
                document.getElementById("boxdata").value = datareturn[0];
                $('#showsend_mail').html(datareturn[1]);
                $("#cencel_mail").click(function () {
                    document.getElementById("boxdata").value = null;
                    $("#page_snedmail").removeClass("active-page_snedmail");
                });
                $("#btn_add_system").click(function () {
                    $("#slider_list_menu").addClass("active-listmanu");
                });
                $("#loading").removeClass("loadingactive");
            }
        });
    }

    function importdata() {
        var inputflie = document.getElementById("fileToUpload");
        const xhr = new XMLHttpRequest();
        const formData = new FormData();
     
        console.log(inputflie.files);
        console.log(inputflie.files['length']);

        if (inputflie.files['length'] == 0) {
            alerterror("กรุณาเลือกไฟล์ Excel");
            return false;
        }
        $("#popupimportfile").removeClass("importfilecss");
        $("#loading").addClass("loadingactive");

        for (const file of inputflie.files) {
            formData.append('fileToUpload', file);
            console.log(file);
            console.log(file.name);
        }
    
        $.ajax({
            url: "importdata.php",
            method: "POST",
            data: formData,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function(data) {
                //console.log(data);
                var datareturn = data.split("*CUT*");
                document.getElementById("boxdata").value = datareturn[0];
                $('#showsend_mail').html(datareturn[1]);
                $("#cencel_mail").click(function () {
                    document.getElementById("boxdata").value = null;
                    $("#page_snedmail").removeClass("active-page_snedmail");
                });
                $("#btn_add_system").click(function () {
                    $("#slider_list_menu").addClass("active-listmanu");
                });
                $("#page_snedmail").addClass("active-page_snedmail");
                $("#loading").removeClass("loadingactive");
                document.getElementById("fileToUpload").value = "";
            }
        });
    }

    // ------------------ system -------------------
    ClassicEditor
    .create( document.querySelector( '#editortextwebnoa' ) )
    .then( Editor => {
        editor = Editor;
    } )
    .catch( error => {
        console.error( error );
    } );
    function webnoa() {
        $("#popup_system").addClass("active-popup_system");        
        $.ajax({
            url: "webnoa.php",
            success: function (data) {
                $('#showpopup_system').html(data);
                resetwebnoa();
                $("#btn_select_webnoa").click(function () {
                    $("#list_webnoa").addClass("active-listmanu_webnoa");                    
                    $("#closelist_webnoa").click(function () {
                        $("#list_webnoa").removeClass("active-listmanu_webnoa");
                        resetwebnoa()
                    });
                    $("#btnok_webnoa").click(function () {
                        $("#list_webnoa").removeClass("active-listmanu_webnoa");
                    });
                    $('#detailOther').click(function(){
                        if($(this).prop("checked") == true){
                            $("#editorwebnoa").addClass("activeeditorwebnoa");
                        }
                        else if($(this).prop("checked") == false){
                            $("#editorwebnoa").removeClass("activeeditorwebnoa");
                        }
                    });
                });
            }
        });
    }

    function submitwebnoa() {
        var detail = "";
        if (document.getElementById("detailNSPA").checked == true) {
            var detailNSPA = document.getElementById("detailNSPA").value;
            detail += "<p>"+detailNSPA+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailuserlost").checked == true) {
            var detailuserlost = document.getElementById("detailuserlost").value;
            detail += "<p>"+detailuserlost+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailuserdcn").checked == true) {
            var detailuserdcn = document.getElementById("detailuserdcn").value;
            detail += "<p>"+detailuserdcn+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailspeed").checked == true) {
            var detailspeed = document.getElementById("detailspeed").value;
            detail += "<p>"+detailspeed+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailDFinven").checked == true) {
            var detailDFinven = document.getElementById("detailDFinven").value;
            detail += "<p>"+detailDFinven+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailSwit").checked == true) {
            var detailSwit = document.getElementById("detailSwit").value;
            detail += "<p>"+detailSwit+"</p>";
        } else {
            detail += "";
        }
        if (document.getElementById("detailOther").checked == true) {
            const editorData = editor.getData();
            if (editorData != "") {
                detail += editorData;
            }
        } else {
            detail += "";
        }
        
        document.getElementById("dataillistwebnoa").value = detail;
        // alert(detail);
    }

    function webcommand() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "webcommand.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function telnetolt() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "telnetolt.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function telnetbras() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "telnetbras.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function telnetdcn() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "telnetdcn.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function telnetzte() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "telnetzte.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function mobile_app() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "mobile.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function nce_fan() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "ncefan.php",
            success: function (data) {
                $('#showpopup_system').html(data);
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( Editor => {
                editor = Editor;
                } )
                .catch( error => {
                console.error( error );
                } );
            }
        });
    }

    function nce_wifisense() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "ncewifisense.php",
            success: function (data) {
                $('#showpopup_system').html(data);
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( Editor => {
                editor = Editor;
                } )
                .catch( error => {
                console.error( error );
                } );
            }
        });
    }

    function unm2000() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "unm2000.php",
            success: function (data) {
                $('#showpopup_system').html(data);
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( Editor => {
                editor = Editor;
                } )
                .catch( error => {
                console.error( error );
                } );
            }
        });
    }

    function vpn() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "vpn.php",
            success: function (data) {
                $('#showpopup_system').html(data);
            }
        });
    }

    function u31() {
        $("#popup_system").addClass("active-popup_system");
        $.ajax({
            url: "u31.php",
            success: function (data) {
                $('#showpopup_system').html(data);
                ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( Editor => {
                editor = Editor;
                } )
                .catch( error => {
                console.error( error );
                } );
            }
        });
    }

    // ------------------ system -------------------
    function closepopupsystem() {
        $("#popup_system").removeClass("active-popup_system");
    }

    function alertsuccess() {
        alertify.set({ delay: 1700 });
        alertify.success("Success notification");  
    }

    function alerterror(text) {
        alertify.set({ delay: 1700 });
        alertify.error("Error "+text);  
    }

    function checkuser() {
        var email = "<?=$email ?>";

        $.ajax({
            url: "check_position.php",
            method: "POST",
			data: {
                email: email
            },
            success: function (data) {
                if (data == "not allowed") {
                    alerterror("คุณไม่สามารถเข้าใช้งานหน้านี้ได้");
                    return false;
                }
                location.href = data;
            }
        });
    }

    function resetwebnoa() {
        $('input[type=checkbox]').prop('checked', false);
        editor.setData("");
        $("#editorwebnoa").removeClass("activeeditorwebnoa");
        document.getElementById("dataillistwebnoa").value = "";
    }

    $(document).ready(function () {
        $("#btn_systemnoa").click(function () {
            $("#slider_list_menu").addClass("active-listmanu");
        });

        $("#closelist_menu").click(function () {
            $("#slider_list_menu").removeClass("active-listmanu");
            $("#listtelnet").removeClass("listtelnettoggle");
        });

        $("#close_popup_system").click(function () {
            $("#popup_system").removeClass("active-popup_system");
        });

        $("#close_popupimport").click(function () {
            $("#popupimportfile").removeClass("importfilecss");
            document.getElementById('fileToUpload').value = "";
        });

        $("#btntelnet").click(function () {
            var element = document.getElementById("listtelnet");
            element.classList.toggle("listtelnettoggle");
        });

        $("#importfile").click(function () {
            var element = document.getElementById("popupimportfile");
            element.classList.toggle("importfilecss");
        });

        $("#detailOther").change(function(){
            if (document.getElementById("detailOther").checked == false) {
                editor.setData("");
            }
        });
    });
</script>
