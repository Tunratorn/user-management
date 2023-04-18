<?php
    //check login
    include "../auth/session.php";
    //---------------------------------------------------------------
    include("/var/www/html/auth/config_39.php");
    include("/var/www/html/auth/config221.php");

	session_start();
    $STR_ro = $_SESSION['ro_system_webnoa'];
    if (strpos($STR_ro, "RO") !== false) {
		$txtro = explode('(',$STR_ro);
		$roo = trim($txtro[1],")");
	}else {
		$roo = 'HQ';
	}

    $boxdata    = $_POST['boxdata'];
    //delete user
    $delete     = $_POST['delete'];
    if ($delete == "deleteuser") {
        if ($boxdata == "") {
            echo"Error data empty";
            exit;
        }
        $sumdata    = $boxdata;
    } else {
        //postdata
        $id         = trim( $_POST['iduser'] );
        $ro         = $_POST['ro'];
        $system     = $_POST['system'];
        $detail     = $_POST['detail'];

        //check data user
        $sqlcheck = " SELECT
                            * 
                        FROM
                            data_user_management 
                        WHERE
                            id_user = '$id' 
                            AND system = '$system' 
                            AND status_cluster != '2' 
                            AND status_area != '2'
                            AND status_boss != '2'
                            AND status_head != '2'
                            AND (
                                status_cluster = '0' 
                                OR status_area = '0'
                                OR status_boss = '0' 
                                OR status_head = '0' 
                                OR status_admin = '0'
                            ) ";
        $rscheck  = mysqli_query($con221,$sqlcheck);
        $numcheck = mysqli_num_rows($rscheck);
        if ($numcheck == '1') {
            echo"Error information wait approve";
            exit;
        }

        //get data apijas
        $employee_id = $id;
        $sql = "SELECT
                jas_api 
            FROM
                noamobile_logs_login 
            WHERE
                jas_api IS NOT NULL 
            ORDER BY
                date DESC
                LIMIT 1";
        $rs = mysqli_query($con39,$sql);
        $row = mysqli_fetch_assoc($rs);
        $employee = check_employee($employee_id,$row['jas_api']);
        $employee = json_decode($employee, true);

        $employeeId = $employee['employeeId'];
        if ($employeeId == "") {
            echo"Error no data user";
            exit;
        }

        $workplace   = $employee['workplace'];
        $api_area    = explode('(',$workplace);
        $api_area    = $api_area[0];
        $sql_cluster = " SELECT noq_rc , area FROM cluster_noq WHERE area LIKE '%จ.$api_area%' GROUP BY area  ";
        $re_cluster  = mysqli_query($con221,$sql_cluster);
        $data        = mysqli_fetch_array($re_cluster);
        $noq_rc      = $data['noq_rc'];
        if ($noq_rc != "") {
            $cluster = $noq_rc;
        }else {
            $cluster = $api_area;
        }

        $name       = $employee['thai_full_name'];
        $email      = $employee['email'];
        $position   = $employee['position'];

        $sumtext    = "$id+$name+$email+$position+$ro+$cluster+$system+$detail";
        //check data user duplicate
        if(strpos($boxdata, $sumtext) !== false){
            echo"Error duplicate information";
            exit;
        } 
        $sumdata    = $boxdata."|".$sumtext;
    }
    echo $sumdata."*CUT*";
    $sumdata    = trim($sumdata,"|");

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



    //====================== getdata jas auth ===========================//    
    function check_employee($employee_id,$token){
        $ch="";
        $headers = array(
                            'token: '.$token,
                            'Content-Type: application/json; charset=UTF-8'
                        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://app.jasmine.com/jpmapi/employee/contact/v1/employeeid/'.$employee_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    mysqli_close($con39);
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