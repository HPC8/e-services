// Add customer
jQuery(document).on('click', 'button#add-cusmeeting', function () {
    var formData = new FormData();
    formData.append('customer_name', jQuery('form#add-cusmeeting-form').find('.input-customer-name').val());
    formData.append('customer_cid', jQuery('form#add-cusmeeting-form').find('.input-customer-cid').val());
    formData.append('customer_phone', jQuery('form#add-cusmeeting-form').find('.input-customer-phone').val());
    formData.append('customer_mail', jQuery('form#add-cusmeeting-form').find('.input-customer-mail').val());
    formData.append('customer_company', jQuery('form#add-cusmeeting-form').find('.input-customer-company').val());
    formData.append('customer_room', jQuery('form#add-cusmeeting-form').find('.input-customer-room').val());
    formData.append('customer_bookstart', jQuery('form#add-cusmeeting-form').find('.input-customer-bookstart').val());
    formData.append('customer_timestart', jQuery('form#add-cusmeeting-form').find('.input-customer-timestart').val());
    formData.append('customer_bookend', jQuery('form#add-cusmeeting-form').find('.input-customer-bookend').val());
    formData.append('customer_timeend', jQuery('form#add-cusmeeting-form').find('.input-customer-timeend').val());
    formData.append('customer_detail', jQuery('form#add-cusmeeting-form').find('.input-customer-detail').val());


    jQuery.ajax({
        url: baseurl + 'customer/saveMeeting',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            //jQuery('button#add-cusmeeting').button('loading');
        },
        complete: function () {
            //jQuery('button#add-cusmeeting').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-customer-' + i.replace('_', '-'));
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
                }, 3000);

                jQuery('form#add-cusmeeting-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-cusmeeting').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

