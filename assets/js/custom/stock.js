// add stock setting
jQuery(document).on('click', 'button#add-stock', function () {
    var formData = new FormData();
    formData.append('stock_name', jQuery('form#add-stock-form').find('.input-stock-name').val());
    formData.append('stock_qty', jQuery('form#add-stock-form').find('.input-stock-qty').val());
    formData.append('stock_unit', jQuery('form#add-stock-form').find('.input-stock-unit').val());
    formData.append('stock_group', jQuery('form#add-stock-form').find('.input-stock-group').val());
    formData.append('stock_category', jQuery('form#add-stock-form').find('.input-stock-category').val());
    formData.append('stock_uplfile', jQuery('form#add-stock-form').find('input.input-stock-uplfile')[0].files[0]);
    jQuery.ajax({
        url: baseurl + 'stock/saveStock',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#add-stock').button('loading');
        },
        complete: function () {
            jQuery('button#add-stock').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-stock-' + i.replace('_', '-'));
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

                jQuery('form#add-stock-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-stock').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit stock setting
jQuery(document).on('click', 'a.update-stock-details', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/editStock',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-update-stock').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-update-stock').html(html);

            $('#edit-stock-uplfile').ace_file_input({
                no_file: 'No File ...',
                btn_choose: 'Choose',
                btn_change: 'Change',
                droppable: false,
                onchange: null,
                thumbnail: false, //| true | large
                whitelist: 'png|jpg|jpeg',
                blacklist: 'exe|php'

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#edit-stock-uplfile-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#edit-stock-uplfile").change(function () {
                readURL(this);
            });


        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update stock setting
jQuery(document).on('click', 'button#update-stock', function () {
    var formData = new FormData();
    formData.append('stock_id', jQuery('form#update-stock-form').find('.input-stock-id').val());
    formData.append('stock_image', jQuery('form#update-stock-form').find('.input-stock-image').val());
    formData.append('stock_name', jQuery('form#update-stock-form').find('.input-stock-name').val());
    formData.append('stock_qty', jQuery('form#update-stock-form').find('.input-stock-qty').val());
    formData.append('stock_unit', jQuery('form#update-stock-form').find('.input-stock-unit').val());
    formData.append('stock_group', jQuery('form#update-stock-form').find('.input-stock-group').val());
    formData.append('stock_category', jQuery('form#update-stock-form').find('.input-stock-category').val());
    formData.append('stock_uplfile', jQuery('form#update-stock-form').find('input.input-stock-uplfile')[0].files[0]);
    jQuery.ajax({
        url: baseurl + 'stock/updateStock',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#update-stock').button('loading');
        },
        complete: function () {
            jQuery('button#update-stock').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-stock-' + i.replace('_', '-'));
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

                jQuery('form#update-stock-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-stock').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// view stock setting
jQuery(document).on('click', 'a.view-stock', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/viewStock',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-stock').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-stock').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// set id stock for delete 
jQuery(document).on('click', 'a.delete-stock-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#delete-stock-id').data('deleteid', id);

});
// delete stock
jQuery(document).on('click', 'button#delete-stock-id', function () {
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/delStock',
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

// view stock order
jQuery(document).on('click', 'a.view-stock-order', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/viewStockOrder',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-stock-order').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-stock-order').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit stock order
jQuery(document).on('click', 'a.edit-stock-order-details', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/editStockOrder',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-stock-order').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
        },
        success: function (html) {
            if (!html) {
                setTimeout(function () {
                    window.location.reload(true);
                }, 1500);
            } else {
                jQuery('#render-edit-stock-order').html(html);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update stock order
jQuery(document).on('click', 'button#edit-stock-order', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'stock/updateStockOrder',
        data: jQuery("form#edit-stock-order-form").serialize(),
        dataType: 'json',
        beforeSend: function () {
            jQuery('#render-edit-stock-order').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
            //jQuery('button#update-product').button('loading');
        },
        complete: function () {
            jQuery('button#edit-stock-order').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);

            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-stock-' + i.replace('_', '-'));
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

                jQuery('form#edit-stock-order-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-stock-order').modal('hide');
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