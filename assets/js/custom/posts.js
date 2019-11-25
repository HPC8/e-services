//Posts Add
jQuery(document).on('click', 'button#add-post', function() {
    var formData = new FormData();
    formData.append('post_title_id', jQuery('form#add-post-form').find('.input-post-title-id').val());
    formData.append('post_content', jQuery('form#add-post-form').find('.input-post-content').val());
    formData.append('post_uplfile', jQuery('form#add-post-form').find('input.input-post-uplfile')[0].files[0]);
    jQuery.ajax({
        url:baseurl+'posts/savePost',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-post').button('loading');
        },
        complete: function () {
            jQuery('button#add-post').button('reset');
            jQuery("form#add-post-form").find('textarea, input, file').each(function () {
                jQuery(this).val('');
            });
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
        },                
        success: function (json) {           
           $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-post-' + i.replace('_', '-'));
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
                }, 1500);
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});