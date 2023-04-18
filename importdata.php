<?php
    //check login
    include "../auth/session.php";
    //---------------------------------------------------------------
    include("/var/www/html/auth/config221.php");

	session_start();
    $STR_ro = $_SESSION['ro_system_webnoa'];
    if (strpos($STR_ro, "RO") !== false) {
		$txtro = explode('(',$STR_ro);
		$roo = trim($txtro[1],")");
	}else {
		$roo = 'HQ';
	}

    require_once "excel/PHPExcel.php";//เรียกใช้ library สำหรับอ่านไฟล์ excel
    $targetPath = 'upload/'.$_FILES['fileToUpload']['name'];
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath);
    $excelReader = PHPExcel_IOFactory::createReaderForFile($targetPath);
    $excelObj = $excelReader->load($targetPath);//อ่านข้อมูลจากไฟล์ชื่อ test_excel.xlsx
    $worksheet = $excelObj->getSheet(0);//อ่านข้อมูลจาก sheet แรก
    $lastRow = $worksheet->getHighestRow(); 

    for ($row = 2; $row <= $lastRow; $row++)//วน loop อ่านข้อมูลเอามาแสดงทีละแถว
    {
        $no         = $worksheet->getCell('A'.$row)->getValue();
        $iduser     = $worksheet->getCell('B'.$row)->getValue();
        $name       = $worksheet->getCell('C'.$row)->getValue();
        $email      = $worksheet->getCell('D'.$row)->getValue();
        $position   = $worksheet->getCell('E'.$row)->getValue();
        $ro         = $worksheet->getCell('F'.$row)->getValue();
        $cluster    = $worksheet->getCell('G'.$row)->getValue();
        $system     = $worksheet->getCell('H'.$row)->getValue();
        $detail     = $worksheet->getCell('I'.$row)->getValue();
        $sumdata .= "|$iduser+$name+$email+$position+$ro+$cluster+$system+$detail";
    }
    #$sumdata = "|26-1216+สิทธิโชค พ่วงพูล+sittichok.p@jasmine.com+Engineer+HQ+JIT21+MOBILE+MOBILE APP|26-1271+รุ่งฤทธิ์ โยธาศรี+rungrid.yo@jasmine.com+Engineer+HQ+JIT21+MOBILE+MOBILE APP|26-1216+สิทธิโชค พ่วงพูล+sittichok.p@jasmine.com+Engineer+HQ+JIT21+UNM2000+|26-1271+รุ่งฤทธิ์ โยธาศรี+rungrid.yo@jasmine.com+Engineer+HQ+JIT21+VPN HOTSPOT+VPN DCN";
    echo $sumdata."*CUT*";
    $sumdata  = trim($sumdata,"|");

    $datamail = "'".$sumdata."'";

    echo'<h2 class="text-center p-2 m-3">Send E-Mail</h2>    
            <div class="p-3 d-flex justify-content-center">
                <select id="emailapprove" name="area" style="width: 250px;" class="selectcss">
                    <option disabled="disabled" selected="selected" value="">ผู้อนุมัติ</option> ';
    $sql = " SELECT name,email FROM name_approve WHERE position != 'ผู้อำนวยการภาค' AND email != 'dusit.sr@jasmine.com' AND ro = '$roo' ";
    $rss = mysqli_query($con221,$sql);
    while ($row = mysqli_fetch_array($rss)) {
        $name  = $row['name'];
        $email = $row['email'];
        echo"<option value='$email'>$name</option>";
    }
    echo'
                </select>
            </div>
            <div class="boxtablesendmail">
            <table class="table">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Position</th>
                    <th scope="col">RO</th>
                    <th scope="col">Cluster</th>
                    <th scope="col">System</th>
                    <th scope="col">Details</th>
                    <th scope="col">Delete</th>
                </tr>';

    $datacut = explode('|',$sumdata);
    $no = 1;
    for ($x = 0; $x < count($datacut); $x++) {
        $datadetail = explode('+',$datacut[$x]);
        $iduser     = $datadetail[0];
        $name       = $datadetail[1];
        $email      = $datadetail[2];
        $position   = $datadetail[3];
        $ro         = $datadetail[4];
        $cluster    = $datadetail[5];
        $system     = $datadetail[6];
        $detail     = $datadetail[7];

        $datadelete = "|$iduser+$name+$email+$position+$ro+$cluster+$system+$detail"; 
        $datadelete = '"'.$datadelete.'"';
        echo"<tr>
                <td>$no</td>
                <td>$iduser</td>
                <td>$name</td>
                <td>$email</td>
                <td>$position</td>
                <td>$ro</td>
                <td>$cluster</td>
                <td>$system</td>
                <td>$detail</td>
                <td><button onclick='deleteuser($datadelete)' class='btndeleteuser'><img src='img/delete.png' class='imgdel'>Delete</button></td>
            </tr>";
        $no++;
    }

    mysqli_close($con221);
?>

</table>
</div>
<div class="d-flex justify-content-center pt-4 m-4">
    <a id="btn_add_system" style="cursor: pointer;">Add System</a>
</div>
<div class="d-flex justify-content-center m-3">
    <button id="btn_sendmail" type="button" class="btn btn-info" onclick="sendmail(<?=$datamail?>)">Send Mail</button>
</div>
<div class="d-flex justify-content-center mb-5">
    <a id="cencel_mail" style="font-size: 14px; cursor: pointer;">CENCEL</a>
</div>