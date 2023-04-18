<h2 class="text-center p-2 m-3">Send E-Mail</h2>
<div class="p-3 d-flex justify-content-center">
    <select id="emailapprove" name="area" style="width: 250px;" class="selectcss">
        <option disabled="disabled" selected="selected" value="">ผู้อนุมัติ</option>
        <option value="kasorn.s@jasmine.com">เกษร ผารุธรรม</option>
        <option value="wilaiporn.k@jasmine.com">วิไลพร กานิล</option>
        <option value="worawit.t@jasmine.com">วรวิทย์ ตันติโภคิน</option>
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
        </tr>
        <tr>
            <td>1</td>
            <td>26-1657</td>
            <td>ตุลธร โพธิ์ศรี</td>
            <td>tunratorn.p@jasmine.com</td>
            <td>Engineer</td>
            <td>HQ</td>
            <td>JIT21</td>
            <td>MOBILE</td>
            <td>MOBILE APP</td>
            <td><button onclick="deleteuser()" class="btndeleteuser"><img src="img/delete.png" class="imgdel">Delete</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>26-1558</td>
            <td>อินทร ตะเพียนทอง</td>
            <td>intorn.t@jasmine.com</td>
            <td>Engineer</td>
            <td>HQ</td>
            <td>JIT21</td>
            <td>TELNET</td>
            <td>ZTE OLT</td>
            <td><button onclick="deleteuser()" class="btndeleteuser"><img src="img/delete.png" class="imgdel">Delete</button></td>
        </tr>
        <tr>
            <td>3</td>
            <td>26-1271</td>
            <td>รุ่งฤทธิ์ โยธาศรี</td>
            <td>rungrid.yo@jasmine.com</td>
            <td>Engineer</td>
            <td>HQ</td>
            <td>JIT21</td>
            <td>NCE FAN</td>
            <td></td>
            <td><button onclick="deleteuser()" class="btndeleteuser"><img src="img/delete.png" class="imgdel">Delete</button></td>
        </tr>
        <tr>
            <td>4</td>
            <td>26-1216</td>
            <td>สิทธิโชค พ่วงพูล</td>
            <td>sittichok.p@jasmine.com</td>
            <td>Engineer</td>
            <td>HQ</td>
            <td>JIT21</td>
            <td>U31</td>
            <td></td>
            <td><button onclick="deleteuser()" class="btndeleteuser"><img src="img/delete.png" class="imgdel">Delete</button></td>
        </tr>
    </table>
</div>
<div class="d-flex justify-content-center pt-4 m-4">
    <a id="btn_add_system" style="cursor: pointer;">Add System</a>
</div>
<div class="d-flex justify-content-center m-3">
    <button id="btn_sendmail" type="button" class="btn btn-info" onclick="sendmail()">Send Mail</button>
</div>
<div class="d-flex justify-content-center mb-5">
    <a id="cencel_mail" style="font-size: 14px; cursor: pointer;">CENCEL</a>
</div>