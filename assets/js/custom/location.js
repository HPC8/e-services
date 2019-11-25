// get province 
jQuery(document).on('change', 'select#emp-province', function (e) {
    e.preventDefault();
    var provinceID = jQuery(this).val();
    getAmphurList(provinceID);
});
 
// get amphur
jQuery(document).on('change', 'select#emp-amphur', function (e) {
    e.preventDefault();
    var amphurID = jQuery(this).val();
    getDistrictList(amphurID);
 
});
 
// function get All amphur
function getAmphurList(provinceID) {
    $.ajax({
        url: baseurl + "employee/getamphur",
        type: 'post',
        data: {provinceID: provinceID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#emp-amphur').find("option:eq(0)").html("Loading..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">--กรุณาเลือก--</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].amphur_id + '">' + json[i].amphur_name + '</option>';
            }
            jQuery("select#emp-amphur").html(options);
 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
 
// function get All district
function getDistrictList(amphurID) {
    $.ajax({
        url: baseurl + "employee/getdistrict",
        type: 'post',
        data: {amphurID: amphurID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#emp-district').find("option:eq(0)").html("Loading..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">--กรุณาเลือก--</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].district_id + '">' + json[i].district_name + '</option>';
            }
            jQuery("select#emp-district").html(options);
 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}