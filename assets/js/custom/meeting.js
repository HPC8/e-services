
// view meeting
jQuery(document).on('click', 'a.view-meeting', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'meeting/viewMeeting',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-meeting').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-meeting').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit meeting
jQuery(document).on('click', 'a.edit-meeting-book-details', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'meeting/editMeeting',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-meeting-book').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
        },
        success: function (html) {
            if (!html) {
                setTimeout(function () {
                    window.location.reload(true);
                }, 1500);
            } else {
                jQuery('#render-edit-meeting-book').html(html);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update meeting
jQuery(document).on('click', 'button#edit-meeting-book', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'meeting/updateMeeting',
        data: jQuery("form#edit-meeting-book-form").serialize(),
        dataType: 'json',
        beforeSend: function () {
            jQuery('#render-edit-meeting-book').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
            //jQuery('button#update-product').button('loading');
        },
        complete: function () {
            jQuery('button#edit-meeting-book').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);

            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-meeting-' + i.replace('_', '-'));
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

                jQuery('form#edit-meeting-book-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-meeting-book').modal('hide');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            setTimeout(function () {
                window.location.reload(true);
            }, 100);

        }
    });
});

// set id meeting for delete 
jQuery(document).on('click', 'a.delete-meeting-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#delete-meeting-id').data('deleteid', id);

});
// delete meeting
jQuery(document).on('click', 'button#delete-meeting-id', function () {
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'meeting/delMeeting',
        data: {
            id: id
        },
        dataType: 'html',
        complete: function () {
            jQuery('#delete-stock').modal('hide');
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