function addData() {
    alert('in save');
}

function resetData() {
    alert('in reset');
}

function editData() {
    alert('in edit');
    $.ajax({
        url: "getdataedit_equipment.php",
        success: function (data) {
            alert(data);
            var obj = JSON.parse(data);
            var price_usd    = obj.price_usd;
            var price_thb    = obj.price_thb;
            var seller    = obj.seller;

            $('#price_usd').val(price_usd);
            $('#price_thb').val(price_thb);
            $('#seller').val(seller);
        }
    });       
}

function delData() {
    alert('in del');
}

function fullData() {
    $("#popup").addClass("active");
    $.ajax({
        url: "showdata_equipment.html",
        success: function (data) {
            $('#data_popup').html(data);
        }
    });
}

function showdatacompare() {
    $("#popup").addClass("active");
    $.ajax({
        url: "showdata_compare.html",
        success: function (data) {
            $('#data_popup').html(data);
        }
    });
}

function senddatacompare() {
    $.ajax({
        url: "compare.html",
        success: function (data) {
            $('#showdata').html(data);
        }
    });
    $("#popup").removeClass("active");
}

var popup = document.getElementById("popup");
window.onclick = function (event) {
    if (event.target == popup) {
        $("#popup").removeClass("active");
    }
}

function imgFornt() {
    $("input[id='input_fornt']").click();
}

function imgBlack() {
    $("input[id='input_black']").click();
}

function showPreviewfornt(event){
    if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("img_fornt");
    preview.src = src;
    }
}

function showPreviewblack(event){
    if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("img_black");
    preview.src = src;
    }
}

$(document).ready(function () {
    $.ajax({
            url: "adddata.html",
            success: function (data) {
                $('#showdata').html(data);
            }
    });

    $("#btnclose").click(function(){
        $("#popup").removeClass("active");
    });

    $("#li_home").click(function(){
        $.ajax({
            url: "home.html",
            success: function (data) {
                $('#showdata').html(data);
            }
        });
    });

    $("#li_compare").click(function(){
        $.ajax({
            url: "compare.html",
            success: function (data) {
                $('#showdata').html(data);
            }
        });
    });

    $("#li_add").click(function(){
        $.ajax({
            url: "adddata.html",
            success: function (data) {
                $('#showdata').html(data);
            }
        });
    });
});

