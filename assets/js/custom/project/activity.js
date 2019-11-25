// activity View
jQuery(document).on('click', 'a.view-activity', function(){
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/viewActivity',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-activity').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-activity').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// activity Add
jQuery(document).on('click', 'button#add-activity', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/saveActivity',
        data:jQuery("form#add-activity-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-activity').button('loading');
        },
        complete: function () {
            jQuery('button#add-activity').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-activity-' + i.replace('_', '-'));
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

                jQuery('form#add-activity-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-activity').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// activity Edit
jQuery(document).on('click', 'a.update-activity-details', function(){
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/editActivity',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-activity').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-update-activity').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// product update
jQuery(document).on('click', 'button#update-activity', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/updateActivity',
        data:jQuery("form#update-activity-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-activity').button('loading');
        },
        complete: function () {
            jQuery('button#update-activity').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
	                var element = $('.input-activity-' + i.replace('_', '-'));
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

                jQuery('form#update-activity-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-activity').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set activity id for delete 
jQuery(document).on('click', 'a.delete-activity-details', function(){
    var id = jQuery(this).data('getid');
    jQuery('button#delete-activity-id').data('deleteid', id);

});
// Edit Delete Details
jQuery(document).on('click', 'button#delete-activity-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/deleteActivity',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#delete-activity').modal('hide');
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