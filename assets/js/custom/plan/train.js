// Add train
jQuery(document).on('click', 'button#train-create', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'plan/saveTrain',
        data:jQuery("form#train-create-form").serialize(),
        dataType:'json',   

        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {           
                for (i in json['error']) {
                    var element = $('.input-train-' + i.replace('_', '-'));
                    if ($(element).parent().hasClass('input-group')) {                       
                        $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    } else {
                        $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
                    }
                }
            } else {
                //alert('ID'+json['lastID']);
                jQuery('#load-processing').modal();
                setTimeout(function () {
                    location.replace(baseurl+"plan/trainEdit/"+json['lastID'])
                }, 3000);

                jQuery('form#train-create-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#train-create').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set train id for delete 
jQuery(document).on('click', 'a.del-trainuser-details', function(){
    var id = jQuery(this).data('getid');
    //window.alert(id);
    jQuery('button#del-trainuser-id').data('deleteid', id);

});
//delete user
jQuery(document).on('click', 'button#del-trainuser-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'plan/deleteTrinUser',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#del-trainuser').modal('hide');
        }, 
        success: function () {
            jQuery('span#success-msg').html('<div class="alert alert-danger">ลบข้อมูลสำเร็จ</div>');
            setTimeout(function () {
                window.location.reload(true);
            }, 1000);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
//add user
jQuery(document).on('click', 'button#add-user', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'plan/addTrinUser',
        data:jQuery("form#add-user-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-user').button('loading');
        },
        complete: function () {
            jQuery('button#add-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-train-' + i.replace('_', '-'));
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

                jQuery('form#add-user-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-user').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
//update train
jQuery(document).on('click', 'button#update-train', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'plan/updateTrain',
        data:jQuery("form#update-train-form").serialize(),
        dataType:'json',    
                
        success: function (json) {
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
	                var element = $('.input-train-' + i.replace('_', '-'));
	                if ($(element).parent().hasClass('input-group')) {                       
		                $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
	                } else {
		                $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
	                }
                }
            } else {
                jQuery('#load-processing').modal();
                //jQuery('span#success-msg').html('<div class="alert alert-success">อัพเดทข้อมูลสำเร็จ.</div>');
                setTimeout(function () {
                    window.location.reload(true);
                }, 1000);

                jQuery('form#update-train-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-train').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});