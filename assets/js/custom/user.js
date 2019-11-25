// Edit emp
jQuery(document).on('click', 'a.update-user-details', function () {
    var emp_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'users/edit',
        data: {
            emp_code: emp_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-update-user').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-update-user').html(html);
            $.mask.definitions['~'] = '[+-]';
            $('.input-edit-mobile').mask('99-9999-9999');
            $('#input-edit-uplfile').ace_file_input({
                no_file: 'No File ...',
                btn_choose: 'Choose',
                btn_change: 'Change',
                droppable: false,
                onchange: null,
                thumbnail: false, //| true | large
                whitelist: 'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
            });
            jQuery(document).on('change', 'select#edit-province', function (e) {
                e.preventDefault();
                var provinceID = jQuery(this).val();
                getAmphurList(provinceID);
            });

            // get amphur
            jQuery(document).on('change', 'select#edit-amphur', function (e) {
                e.preventDefault();
                var amphurID = jQuery(this).val();
                getDistrictList(amphurID);

            });

            // function get All amphur
            function getAmphurList(provinceID) {
                $.ajax({
                    url: baseurl + "employee/getamphur",
                    type: 'post',
                    data: {
                        provinceID: provinceID
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('select#edit-amphur').find("option:eq(0)").html("Loading..");
                    },
                    complete: function () {
                        // code
                    },
                    success: function (json) {
                        var options = '';
                        options += '<option value="">--กรุณาเลือก--</option>';
                        for (var i = 0; i < json.length; i++) {
                            options += '<option value="' + json[i].amphur_id + '">' + json[i].amphur_name + '</option>';
                        }
                        jQuery("select#edit-amphur").html(options);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }

            // function get All district
            function getDistrictList(amphurID) {
                $.ajax({
                    url: baseurl + "employee/getdistrict",
                    type: 'post',
                    data: {
                        amphurID: amphurID
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('select#edit-district').find("option:eq(0)").html("Loading..");
                    },
                    complete: function () {
                        // code
                    },
                    success: function (json) {
                        var options = '';
                        options += '<option value="">--กรุณาเลือก--</option>';
                        for (var i = 0; i < json.length; i++) {
                            options += '<option value="' + json[i].district_id + '">' + json[i].district_name + '</option>';
                        }
                        jQuery("select#edit-district").html(options);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
// Update emp
jQuery(document).on('click', 'button#update-user', function () {
    var formData = new FormData();
    formData.append('edit_hospcode', jQuery('form#update-user-form').find('.input-edit-hospcode').val());
    formData.append('edit_email', jQuery('form#update-user-form').find('.input-edit-email').val());
    formData.append('edit_mobile', jQuery('form#update-user-form').find('.input-edit-mobile').val());
    formData.append('edit_address', jQuery('form#update-user-form').find('.input-edit-address').val());
    formData.append('edit_province', jQuery('form#update-user-form').find('.input-edit-province').val());
    formData.append('edit_amphur', jQuery('form#update-user-form').find('.input-edit-amphur').val());
    formData.append('edit_district', jQuery('form#update-user-form').find('.input-edit-district').val());
    formData.append('emp_uplfile', jQuery('form#update-user-form').find('input.input-edit-uplfile')[0].files[0]);
    jQuery.ajax({
        url: baseurl + 'users/update',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#update-user').button('loading');
        },
        complete: function () {
            jQuery('button#update-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-edit-' + i.replace('_', '-'));
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

                jQuery('form#update-user-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-emp').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
// Edit Passwd
jQuery(document).on('click', 'a.passwd-user-details', function () {
    var emp_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'users/changePasswd',
        data: {
            emp_code: emp_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-passwd-user').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-passwd-user').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
// Passwd update
jQuery(document).on('click', 'button#passwd-user', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'users/updatePasswd',
        data: jQuery("form#passwd-user-form").serialize(),
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#passwd-user').button('loading');
        },
        complete: function () {
            jQuery('button#passwd-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-edit-' + i.replace('_', '-'));
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

                jQuery('form#passwd-user-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#passwd-user').modal('hide');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

jQuery(document).on('click', 'button#update-user', function () {
    var formData = new FormData();
    formData.append('edit_hospcode', jQuery('form#update-user-form').find('.input-edit-hospcode').val());
    formData.append('edit_email', jQuery('form#update-user-form').find('.input-edit-email').val());
    formData.append('edit_mobile', jQuery('form#update-user-form').find('.input-edit-mobile').val());
    formData.append('edit_address', jQuery('form#update-user-form').find('.input-edit-address').val());
    formData.append('edit_province', jQuery('form#update-user-form').find('.input-edit-province').val());
    jQuery.ajax({
        url: baseurl + 'users/updatePasswd',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#update-user').button('loading');
        },
        complete: function () {
            jQuery('button#update-user').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-edit-' + i.replace('_', '-'));
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

                jQuery('form#update-user-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-emp').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});