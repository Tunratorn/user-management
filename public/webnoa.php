
<h3 class="m-2 text-center">WEB NOA</h3>
<div class="set-input mt-3 p-3 d-flex justify-content-center">
    <div class="w-50">
        <div class="p-3">
            <input id="iduser" class="w-100 input-text" type="text" placeholder="ID User">
            <input id="system" type="hidden" value="WEB NOA">
            <input id="dataillistwebnoa" type="hidden" name="boxdata">
        </div>
        <div class="p-3 w-100">
            <select id="ro" name="area" class="w-100 selectcss">
                <option disabled="disabled" selected="selected" value="">RO</option>
                <option>RO1</option>
                <option>RO2</option>
                <option>RO3</option>
                <option>RO4</option>
                <option>RO5</option>
                <option>RO6</option>
                <option>RO7</option>
                <option>RO8</option>
                <option>RO9</option>
                <option>RO10</option>
                <option>HQ</option>
            </select>
        </div>
        <div class="form-check px-5 p-3">
            <input id="defaultWebnoa" class="form-check-input" type="checkbox" value="หน้าเว็บพื้นฐาน">
            <label class="form-check-label" for="flexCheckDefault">
                หน้าเว็บพื้นฐาน
            </label>
        </div>
        <div class="text-center p-2">
            <a id="btn_select_webnoa" class="btn-webnoa">หน้าเว็บจำกัดสิทธิ์</a>
        </div>
        <div class="text-center p-3">
            <button id="btn_submit" type="button" class="btn btn-primary" style="width: 120px;" onclick="submit('WEB NOA')">OK</button>
        </div>
        <div class="text-center">
            <a id="close_popup_system" class="m-2" onclick="closepopupsystem()">Close</a>
        </div>
    </div>
</div>