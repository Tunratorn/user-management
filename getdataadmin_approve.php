
    <div class="divcenter">
        <div class="bgtbl">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm">NO</th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Email</th>
                    <th class="th-sm">RO</th>
                    <th class="th-sm">Cluster</th>
                    <th class="th-sm">Position</th>
                    <th class="th-sm text-center">Login</th>
                  </tr>
                </thead>
                <tbody>
    <?php
        include("/var/www/html/auth/config221.php");

        $position = $_POST['position'];

        $sql = " SELECT * FROM name_approve WHERE position != 'Admin'  ";
        if ($position != "all") {
            $sql .= " AND position = '$position' ";
        }
        $sql .= " ORDER BY position DESC ";
        #echo $sql;
        $rs  = mysqli_query($con221,$sql);
        $num = mysqli_num_rows($rs);
        $no = 1;
        while ($data = mysqli_fetch_array($rs)) {
            $id         = $data['id'];
            $name       = $data['name'];
            $email      = $data['email'];
            $position   = $data['position'];
            $ro         = $data['ro'];
            $cluster    = $data['cluster'];
            $txtmail    = '"'.$email.'"';
            echo"<tr>
                    <td>$no</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$ro</td>
                    <td>$cluster</td>
                    <td>$position</td>
                    <td class='tdapprove'>
                        <button onclick='checkuser($txtmail)' class='btnloginapp'>LOGIN</button>
                    </td>
                </tr>";
            $no++;
        }
    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        echo"*CUT*".$num;
    ?>