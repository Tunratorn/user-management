<div class="text-center m-2">
    <h4>ADD DATA</h4>
    <div class="row m-3">
        <label for="" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="addname" placeholder="Name">
        </div>
    </div>
    <div class="row m-3">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="addemail" placeholder="Email">
        </div>
    </div>
    <div class="row m-3">
        <label for="" class="col-sm-2 col-form-label">Position</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="addposition" placeholder="Position">
        </div>
    </div>
    <div class="row m-3">
        <label for="" class="col-sm-2 col-form-label">RO</label>
        <div class="col-sm-10">
            <select id="addro" class="form-control">
                <option disabled="disabled" selected="selected" value="">Select RO</option>
                <option value="-">-</option>
                <option value="RO1">RO1</option>
                <option value="RO2">RO2</option>
                <option value="RO3">RO3</option>
                <option value="RO4">RO4</option>
                <option value="RO5">RO5</option>
                <option value="RO6">RO6</option>
                <option value="RO7">RO7</option>
                <option value="RO8">RO8</option>
                <option value="RO9">RO9</option>
                <option value="RO10">RO10</option>
            </select>
        </div>
    </div>
    <div class="row m-3">
        <label for="" class="col-sm-2 col-form-label">Cluster</label>
        <div class="col-sm-10">
            <select id="addcluster" class="form-control">
                <option disabled="disabled" selected="selected" value="">Select Cluster</option>
                <option value="-">-</option>
                <option value="RC1-CCO">RC1-CCO</option>
                <option value="RC1-RYG">RC1-RYG</option>
                <option value="RC1-CBI">RC1-CBI</option>
                <option value="RC2-NMA">RC2-NMA</option>
                <option value="RC2-UBN">RC2-UBN</option>
                <option value="RC3-KKN">RC3-KKN</option>
                <option value="RC3-UDN">RC3-UDN</option>
                <option value="RC4-NSN">RC4-NSN</option>
                <option value="RC4-PLK">RC4-PLK</option>
                <option value="RC5-LPG">RC5-LPG</option>
                <option value="RC5-CMI">RC5-CMI</option>
                <option value="RC5-CRI">RC5-CRI</option>
                <option value="RC6-HHN">RC6-HHN</option>
                <option value="RC6-NPT">RC6-NPT</option>
                <option value="RC6-SKN">RC6-SKN</option>
                <option value="RC7-NRT">RC7-NRT</option>
                <option value="RC7-PKT">RC7-PKT</option>
                <option value="RC7-SNI">RC7-SNI</option>
                <option value="RC8-PTN">RC8-PTN</option>
                <option value="RC8-HYI">RC8-HYI</option>
                <option value="RC9-AYA">RC9-AYA</option>
                <option value="RC9-SRI">RC9-SRI</option>
                <option value="RC10-NBI (A6)">RC10-NBI (A6)</option>
                <option value="RC10-PTI (A5)">RC10-PTI (A5)</option>
                <option value="RC10-BKC (A4)">RC10-BKC (A4)</option>
                <option value="RC10-SPN (A1)">RC10-SPN (A1)</option>
                <option value="RC10-BKE (A2)">RC10-BKE (A2)</option>
                <option value="RC10-TRI (A3)">RC10-TRI (A3)</option>
            </select>
        </div>
    </div>
    <div class="text-center mt-5 mb-4">
        <button type="submit" class="btn btn-primary" style="width: 100px;" onclick="adddata()">Add</button>
    </div>
</div>