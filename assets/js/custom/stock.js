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
                blacklist:'exe|php'

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
            $("#edit-stock-uplfile").change(function(){
                readURL(this);
            });
            

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});