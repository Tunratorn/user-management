<h3 class="m-2 text-center">UNM2000</h3>
<p class="text-center">NMS monitor Node Fiberhome (RO 1,3,4,5,7)</p>
<div class="set-input d-flex justify-content-center">
    <div style="width: 80%;" class="">
        <div class="d-flex justify-content-center">
            <div class="p-3 w-50">
                <input id="iduser" class="w-100 input-text" type="text" placeholder="ID User">
                <input id="system" type="hidden" value="UNM2000">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-3 w-50">
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
        </div>
        <div>
            <div class="editorhome">
                <div id="editor"></div>
            </div>
        </div>
        <div class="text-center p-3">
            <button id="btn_submit" type="button" class="btn btn-primary" style="width: 120px;" onclick="submit('UNM2000')">OK</button>
        </div>
        <div class="text-center">
            <a id="close_popup_system" class="m-2" onclick="closepopupsystem()">Close</a>
        </div>
    </div>
</div>         