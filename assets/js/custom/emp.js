// View emp
jQuery(document).on('click', 'a.view-emp', function () {
    var emp_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'employee/viewEmp',
        data: {
            emp_code: emp_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-emp').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-emp').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Add emp
jQuery(document).on('click', 'button#add-emp', function () {
    var emp_note =tinyMCE.activeEditor.getContent();
    var formData = new FormData();
    formData.append('emp_hospcode', jQuery('form#add-emp-form').find('.input-emp-hospcode').val());
    formData.append('emp_sex', jQuery('form#add-emp-form').find('input[name=emp_sex]:checked').val());
    formData.append('emp_marital', jQuery('form#add-emp-form').find('input[name=emp_marital]:checked').val());
    formData.append('emp_titlename', jQuery('form#add-emp-form').find('.input-emp-titlename').val());
    formData.append('emp_firstname', jQuery('form#add-emp-form').find('.input-emp-firstname').val());
    formData.append('emp_lastname', jQuery('form#add-emp-form').find('.input-emp-lastname').val());
    formData.append('emp_nameeng', jQuery('form#add-emp-form').find('.input-emp-nameeng').val());
    formData.append('emp_blood', jQuery('form#add-emp-form').find('.input-emp-blood').val());
    formData.append('emp_positionno', jQuery('form#add-emp-form').find('.input-emp-positionno').val());
    formData.append('emp_birthday', jQuery('form#add-emp-form').find('.input-emp-birthday').val());
    formData.append('emp_cid', jQuery('form#add-emp-form').find('.input-emp-cid').val());
    formData.append('emp_email', jQuery('form#add-emp-form').find('.input-emp-email').val());
    formData.append('emp_mobile', jQuery('form#add-emp-form').find('.input-emp-mobile').val());
    formData.append('emp_address', jQuery('form#add-emp-form').find('.input-emp-address').val());
    formData.append('emp_province', jQuery('form#add-emp-form').find('.input-emp-province').val());
    formData.append('emp_amphur', jQuery('form#add-emp-form').find('.input-emp-amphur').val());
    formData.append('emp_district', jQuery('form#add-emp-form').find('.input-emp-district').val());
    formData.append('emp_accountno', jQuery('form#add-emp-form').find('.input-emp-accountno').val());
    formData.append('emp_salary', jQuery('form#add-emp-form').find('.input-emp-salary').val());
    formData.append('emp_startdate', jQuery('form#add-emp-form').find('.input-emp-startdate').val());
    formData.append('emp_stopdate', jQuery('form#add-emp-form').find('.input-emp-stopdate').val());
    formData.append('emp_education', jQuery('form#add-emp-form').find('.input-emp-education').val());
    formData.append('emp_degree', jQuery('form#add-emp-form').find('.input-emp-degree').val());
    formData.append('emp_branch', jQuery('form#add-emp-form').find('.input-emp-branch').val());
    formData.append('emp_gpa', jQuery('form#add-emp-form').find('.input-emp-gpa').val());
    formData.append('emp_category', jQuery('form#add-emp-form').find('.input-emp-category').val());
    formData.append('emp_position', jQuery('form#add-emp-form').find('.input-emp-position').val());
    formData.append('emp_level', jQuery('form#add-emp-form').find('.input-emp-level').val());
    formData.append('emp_department', jQuery('form#add-emp-form').find('.input-emp-department').val());
    formData.append('emp_section', jQuery('form#add-emp-form').find('.input-emp-section').val());
    formData.append('emp_uplfile', jQuery('form#add-emp-form').find('input.input-emp-uplfile')[0].files[0]);
    formData.append('emp_note', emp_note);
    jQuery.ajax({
        url: baseurl + 'employee/saveEmp',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#add-emp').button('loading');
        },
        complete: function () {
            jQuery('button#add-emp').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);

        },
        success: function (json) {
            //console.log(json);
            $('.text-danger').remove();
            if (json['error']) {
                for (i in json['error']) {
                    var element = $('.input-emp-' + i.replace('_', '-'));
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

                jQuery('form#add-emp-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-emp').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Edit emp
jQuery(document).on('click', 'a.update-emp-details', function () {
    var emp_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'employee/editEmp',
        data: {
            emp_code: emp_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-update-emp').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-update-emp').html(html);
            tinymce.init({
                mode: "textareas",
                theme: "advanced",
                selector: "#emp-edit-note",theme: "modern",height: 150,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                ],
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                image_advtab: true,

                external_filemanager_path: baseurl + "assets/plugin/filemanager/",
                filemanager_title: "Responsive Filemanager",
                external_plugins: {
                    "filemanager": "../filemanager/plugin.min.js"
                },
                relative_urls: false,
                remove_script_host: false,
                document_base_url: baseurl
            });
            $("#edit-birthday").datetimepicker({
                timepicker: false,
                format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
                onSelectDate: function (dp, $input) {
                    var yearT = new Date(dp).getFullYear() - 0;
                    var yearTH = yearT + 0;
                    var fulldate = $input.val();
                    var fulldateTH = fulldate.replace(yearT, yearTH);
                    $input.val(fulldateTH);
                },
            });
            $("#edit-startdate").datetimepicker({
                timepicker: false,
                format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
                onSelectDate: function (dp, $input) {
                    var yearT = new Date(dp).getFullYear() - 0;
                    var yearTH = yearT + 0;
                    var fulldate = $input.val();
                    var fulldateTH = fulldate.replace(yearT, yearTH);
                    $input.val(fulldateTH);
                },
            });
            $("#edit-stopdate").datetimepicker({
                timepicker: false,
                format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
                onSelectDate: function (dp, $input) {
                    var yearT = new Date(dp).getFullYear() - 0;
                    var yearTH = yearT + 0;
                    var fulldate = $input.val();
                    var fulldateTH = fulldate.replace(yearT, yearTH);
                    $input.val(fulldateTH);
                },
            });
            $.mask.definitions['~'] = '[+-]';
            $('.input-edit-mobile').mask('99-9999-9999');
            $('.input-edit-accountno').mask('999-9-99999-9');
            $('.input-edit-cid').mask('9-9999-99999-99-9');

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
jQuery(document).on('click', 'button#update-emp', function () {
    var edit_note =tinyMCE.activeEditor.getContent();
    var formData = new FormData();
    formData.append('edit_hospcode', jQuery('form#update-emp-form').find('.input-edit-hospcode').val());
    formData.append('edit_sex', jQuery('form#update-emp-form').find('input[name=edit_sex]:checked').val());
    formData.append('edit_marital', jQuery('form#update-emp-form').find('input[name=edit_marital]:checked').val());
    formData.append('edit_titlename', jQuery('form#update-emp-form').find('.input-edit-titlename').val());
    formData.append('edit_firstname', jQuery('form#update-emp-form').find('.input-edit-firstname').val());
    formData.append('edit_lastname', jQuery('form#update-emp-form').find('.input-edit-lastname').val());
    formData.append('edit_nameeng', jQuery('form#update-emp-form').find('.input-edit-nameeng').val());
    formData.append('edit_blood', jQuery('form#update-emp-form').find('.input-edit-blood').val());
    formData.append('edit_positionno', jQuery('form#update-emp-form').find('.input-edit-positionno').val());
    formData.append('edit_birthday', jQuery('form#update-emp-form').find('.input-edit-birthday').val());
    formData.append('edit_cid', jQuery('form#update-emp-form').find('.input-edit-cid').val());
    formData.append('edit_email', jQuery('form#update-emp-form').find('.input-edit-email').val());
    formData.append('edit_mobile', jQuery('form#update-emp-form').find('.input-edit-mobile').val());
    formData.append('edit_address', jQuery('form#update-emp-form').find('.input-edit-address').val());
    formData.append('edit_province', jQuery('form#update-emp-form').find('.input-edit-province').val());
    formData.append('edit_amphur', jQuery('form#update-emp-form').find('.input-edit-amphur').val());
    formData.append('edit_district', jQuery('form#update-emp-form').find('.input-edit-district').val());
    formData.append('edit_accountno', jQuery('form#update-emp-form').find('.input-edit-accountno').val());
    formData.append('edit_salary', jQuery('form#update-emp-form').find('.input-edit-salary').val());
    formData.append('edit_startdate', jQuery('form#update-emp-form').find('.input-edit-startdate').val());
    formData.append('edit_stopdate', jQuery('form#update-emp-form').find('.input-edit-stopdate').val());
    formData.append('edit_education', jQuery('form#update-emp-form').find('.input-edit-education').val());
    formData.append('edit_degree', jQuery('form#update-emp-form').find('.input-edit-degree').val());
    formData.append('edit_branch', jQuery('form#update-emp-form').find('.input-edit-branch').val());
    formData.append('edit_gpa', jQuery('form#update-emp-form').find('.input-edit-gpa').val());
    formData.append('edit_category', jQuery('form#update-emp-form').find('.input-edit-category').val());
    formData.append('edit_position', jQuery('form#update-emp-form').find('.input-edit-position').val());
    formData.append('edit_level', jQuery('form#update-emp-form').find('.input-edit-level').val());
    formData.append('edit_department', jQuery('form#update-emp-form').find('.input-edit-department').val());
    formData.append('edit_section', jQuery('form#update-emp-form').find('.input-edit-section').val());
    formData.append('emp_uplfile', jQuery('form#update-emp-form').find('input.input-edit-uplfile')[0].files[0]);
    formData.append('edit_note', edit_note);
    jQuery.ajax({
        url: baseurl + 'employee/updateEmp',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            jQuery('button#update-emp').button('loading');
        },
        complete: function () {
            jQuery('button#update-emp').button('reset');
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

                jQuery('form#update-emp-form').find('textarea, input').each(function () {
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

// Discard emp
jQuery(document).on('click', 'a.discard-emp-details', function () {
    var emp_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'employee/discardEmp',
        data: {
            emp_code: emp_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-discard-emp').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-discard-emp').html(html);
            $("#edit-date").datetimepicker({
                timepicker: false,
                format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
                onSelectDate: function (dp, $input) {
                    var yearT = new Date(dp).getFullYear() - 0;
                    var yearTH = yearT + 0;
                    var fulldate = $input.val();
                    var fulldateTH = fulldate.replace(yearT, yearTH);
                    $input.val(fulldateTH);
                },
            });
            $('#edit-files').ace_file_input({
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

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Discard Update emp
jQuery(document).on('click', 'button#discard-emp', function () {
    var files = $('#edit-files')[0].files;
    var error = '';
    var formData = new FormData();
    for (var count = 0; count < files.length; count++) {
        var name = files[count].name;
        var extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
            error += "Invalid " + count + " Image File"
        } else {
            formData.append("edit_files[]", files[count]);
        }
    }
    formData.append('edit_hospcode', jQuery('form#discard-emp-form').find('.input-edit-hospcode').val());
    formData.append('edit_retire', jQuery('form#discard-emp-form').find('.input-edit-retire').val());
    formData.append('edit_date', jQuery('form#discard-emp-form').find('.input-edit-date').val());
    formData.append('edit_detail', jQuery('form#discard-emp-form').find('.input-edit-detail').val());
    if (error == '') {
        jQuery.ajax({
            url: baseurl + 'employee/update_discard',
            type: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                jQuery('button#discard-emp').button('loading');
            },
            complete: function () {
                jQuery('button#discard-emp').button('reset');
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

                    jQuery('form#discard-emp-form').find('textarea, input').each(function () {
                        jQuery(this).val('');
                    });
                    jQuery('#discard-emp').modal('hide');

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    } else {
        alert(error);
    }
});