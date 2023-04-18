<h3 class="m-2 text-center">WEB COMMAND</h3>
<div class="set-input mt-3 p-3 d-flex justify-content-center">
    <div class="w-50">
        <div class="p-3">
            <input id="iduser" class="w-100 input-text" type="text" placeholder="ID User">
            <input id="system" type="hidden" value="WEB COMMAND">
        </div>
        <div class="p-3 w-100">
            <select id="ro" name="ro" class="w-100 selectcss">
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
        <div class="p-3 w-100">
            <select id="detaildslam" name="ds" class="w-100 selectcss">
                <option disabled="disabled" selected="selected" value="">DSLAM FTTX</option>
                <option value="DSLAM FTTX: Level 1 (View)">Level 1 (View)</option>
                <option value="DSLAM FTTX: Level 2 (Config)">Level 2 (Config)</option>
            </select>
        </div>   
        <div class="p-3 w-100">
            <select id="detailbras" name="ber" class="w-100 selectcss">
                <option disabled="disabled" selected="selected" value="">BRAS</option>
                <option value="BRAS: Level 1 (View)">Level 1 (View)</option>
            </select>
        </div>   
        <div class="text-center p-3">
            <button id="btn_submit" type="button" class="btn btn-primary" style="width: 120px;" onclick="submit('WEB COMMAND')">OK</button>
        </div>
        <div class="text-center">
            <a id="close_popup_system" class="m-2" onclick="closepopupsystem()">Close</a>
        </div>
    </div>
</div>         