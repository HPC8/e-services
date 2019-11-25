// View Plan
jQuery(document).on('click', 'a.view-plan', function(){
    var plan_id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/viewPlan',
        data:{plan_id: plan_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-plan').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-plan').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
// Edit Plan
jQuery(document).on('click', 'a.update-plan-details', function(){
    var plan_id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/editPlan',
        data:{plan_id: plan_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-plan').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-update-plan').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set Plan id for delete 
jQuery(document).on('click', 'a.delete-plan-details', function(){
    var id = jQuery(this).data('getid');
    //window.alert(plan_id);
    jQuery('button#delete-plan-id').data('deleteid', id);

});
// Edit Delete Details
jQuery(document).on('click', 'button#delete-plan-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/deletePlan',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#delete-plan').modal('hide');
        }, 
        success: function () {
            jQuery('span#success-msg').html('<div class="alert alert-success">ลบข้อมูลสำเร็จ</div>');
            setTimeout(function () {
                window.location.reload(true);
            }, 1000);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// Plan Add
jQuery(document).on('click', 'button#add-plan', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/savePlan',
        data:jQuery("form#add-plan-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-plan').button('loading');
        },
        complete: function () {
            jQuery('button#add-plan').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-plan-' + i.replace('_', '-'));
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">เพิ่มข้อมูลสำเร็จ</div>');
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000);

                jQuery('form#add-plan-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-plan').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// Plan update
jQuery(document).on('click', 'button#update-plan', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/updatePlan',
        data:jQuery("form#update-plan-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-plan').button('loading');
        },
        complete: function () {
            jQuery('button#update-plan').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
	                var element = $('.input-plan-' + i.replace('_', '-'));
	                if ($(element).parent().hasClass('input-group')) {                       
		                $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
	                } else {
		                $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
	                }
                }
            } else {
                jQuery('span#success-msg').html('<div class="alert alert-success">อัพเดทข้อมูลสำเร็จ.</div>');
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000);

                jQuery('form#update-plan-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-plan').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});