// get plan 
jQuery(document).on('change', 'select#checkPlan-planid', function (e) {
    e.preventDefault();
    var planID = jQuery(this).val();
    //window.alert(planID);
    getProductList(planID);
});
 
// get product
jQuery(document).on('change', 'select#checkPlan-productid', function (e) {
    e.preventDefault();
    var productID = jQuery(this).val();
    getActivityList(productID);
 
});
 
// function get All Productid
function getProductList(planID) {
    //window.alert(planID);
    $.ajax({
        url: baseurl + "plan/getProduct",
        type: 'post',
        data: {planID: planID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#checkPlan-productid').find("option:eq(0)").html("Loading..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">--กรุณาเลือก--</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].product_id + '">' + json[i].product_name + '</option>';
            }
            jQuery("select#checkPlan-productid").html(options);
 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
 
// function get All Activityid
function getActivityList(productID) {
    $.ajax({
        url: baseurl + "plan/getActivity",
        type: 'post',
        data: {productID: productID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#checkPlan-activityid').find("option:eq(0)").html("Loading..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">--กรุณาเลือก--</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].activity_id + '">' + json[i].activity_name + '</option>';
            }
            jQuery("select#checkPlan-activityid").html(options);
 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}