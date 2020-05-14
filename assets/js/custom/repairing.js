//เช็ค ประเภทปัญหา
$(document).ready(function () {
    $('#repairing-type').change(function () {
        if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 4) {
            $('#repairing-serial').prop("disabled", false);
        } else {
            $('#repairing-serial').prop("disabled", true);
        }
    });

});

// add repairing
jQuery(document).on('click', 'button#add-repairing', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'repairing/saveRepairing',
        data:jQuery("form#add-repairing-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            //jQuery('button#add-repairing').button('loading');
        },
        complete: function () {
            //jQuery('button#add-repairing').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 500);
            
        },                
        success: function (json) {
            //console.log(json);
           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
                    var element = $('.input-repairing-' + i.replace('_', '-'));
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

                jQuery('form#add-repairing-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-repairing').modal('hide');
                
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// view repairing
jQuery(document).on('click', 'a.view-repairing', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'repairing/viewRepair',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-repairing').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-repairing').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});