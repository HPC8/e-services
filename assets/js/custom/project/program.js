// View program
jQuery(document).on('click', 'a.view-program', function(){
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/viewProgram',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-program').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-program').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
// Edit program
jQuery(document).on('click', 'a.update-program-details', function(){
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/editProgram',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-program').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-update-program').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set program id for delete 
jQuery(document).on('click', 'a.delete-program-details', function(){
    var id = jQuery(this).data('getid');
    //window.alert(plan_id);
    jQuery('button#delete-program-id').data('deleteid', id);

});
// Edit program Details
jQuery(document).on('click', 'button#delete-program-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/deleteProgram',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#delete-program').modal('hide');
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

// program Add
jQuery(document).on('click', 'button#add-program', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/saveProgram',
        data:jQuery("form#add-program-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-program').button('loading');
        },
        complete: function () {
            jQuery('button#add-program').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-program-' + i.replace('_', '-'));
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

                jQuery('form#add-program-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-program').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// program update
jQuery(document).on('click', 'button#update-program', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/updateProgram',
        data:jQuery("form#update-program-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-program').button('loading');
        },
        complete: function () {
            jQuery('button#update-program').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
	                var element = $('.input-program-' + i.replace('_', '-'));
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

                jQuery('form#update-program-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-program').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});