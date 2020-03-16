/* Update item quantity */
var baseurl = "https://apps.anamai.moph.go.th/e-services/";

function updateCartItem(obj, rowid) {
    $.get(baseurl + 'products/updateItemQty', {
        rowid: rowid,
        qty: obj.value
    }, function (resp) {
        if (resp == 'ok') {
            location.reload();
        } else {
            alert('ไม่สามารถอัดเดทข้อมูลได้กรุณาระบุจำนวนมากว่า 0');
        }
    });
}

function updateCartStockItem(obj, rowid) {
    $.get(baseurl + 'stock/updateItemQty', {
        rowid: rowid,
        qty: obj.value
    }, function (resp) {
        if (resp == 'ok') {
            location.reload();
        } else {
            alert('ไม่สามารถอัดเดทข้อมูลได้กรุณาระบุจำนวนมากว่า 0');
        }
    });
}


$('.clockpicker').clockpicker({
    placement: 'top',
    align: 'top',
    autoclose: true,
});


$($('#confirm_alerts_auto').click());

$($('#confirm_alerts').click());
$($('#confirm_query').click());

//datetimepicker products
jQuery(function () {
    jQuery('#date-pro-start').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#date-pro-end').val() ? jQuery('#date-pro-end').val() : false
            })
        },
        minDate: 0, // today
        timepicker: false
    });
    jQuery('#date-pro-end').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#date-pro-start').val() ? jQuery('#date-pro-start').val() : false
            })
        },
        timepicker: false
    });
});
//datetimepicker meeting
jQuery(function () {
    jQuery('#date-mtg-start').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#date-mtg-end').val() ? jQuery('#date-mtg-end').val() : false
            })
        },
        minDate: 0, // today
        timepicker: false
    });
    jQuery('#date-mtg-end').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#date-mtg-start').val() ? jQuery('#date-mtg-start').val() : false
            })
        },
        timepicker: false
    });
});

//datetimepicker train Range Picker
jQuery(function () {
    jQuery('#input-train-start').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#input-train-end').val() ? jQuery('#input-train-end').val() : false
            })
        },
        timepicker: false
    });
    jQuery('#input-train-end').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#input-train-start').val() ? jQuery('#input-train-start').val() : false
            })
        },
        timepicker: false
    });
});

//datetimepicker train travel Range Picker
jQuery(function () {
    jQuery('#input-train-travel-start').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#input-train-travel-end').val() ? jQuery('#input-train-travel-end').val() : false
            })
        },
        timepicker: false
    });
    jQuery('#input-train-travel-end').datetimepicker({
        format: 'Y-m-d',
        lang: 'th',
        scrollMonth: false,
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#input-train-travel-start').val() ? jQuery('#input-train-travel-start').val() : false
            })
        },
        timepicker: false
    });
});



jQuery(function ($) {
    $('#id-disable-check').on('click', function () {
        var inp = $('#form-input-readonly').get(0);
        if (inp.hasAttribute('disabled')) {
            inp.setAttribute('readonly', 'true');
            inp.removeAttribute('disabled');
            inp.value = "This text field is readonly!";
        } else {
            inp.setAttribute('disabled', 'disabled');
            inp.removeAttribute('readonly');
            inp.value = "This text field is disabled!";
        }
    });

    $('.chosen').chosen();
    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        //resize the chosen on window resize

        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function () {
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({
                        'width': '100%'
                        // 'width': $this.parent().width()
                    });
                })
            }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({
                    'width': '100%'
                    // 'width': $this.parent().width()
                });
            })
        });


        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });
    }


    $('[data-rel=tooltip]').tooltip({
        container: 'body'
    });
    $('[data-rel=popover]').popover({
        container: 'body'
    });

    autosize($('textarea[class*=autosize]'));

    $('textarea.limited').inputlimiter({
        remText: '%n character%s remaining...',
        limitText: 'max allowed : %n.'
    });

    $.mask.definitions['~'] = '[+-]';
    $('.input-mask-date').mask('99/99/9999');
    $('.input-mask-phone').mask('(999) 999-9999');
    $('.input-emp-mobile').mask('99-9999-9999');
    $('.input-emp-accountno').mask('999-9-99999-9');
    $('.input-emp-cid').mask('9-9999-99999-99-9');
    $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
    $(".input-mask-product").mask("a*-999-a999", {
        placeholder: " ",
        completed: function () {
            alert("You typed the following: " + this.val());
        }
    });

    $("#input-size-slider").css('width', '200px').slider({
        value: 1,
        range: "min",
        min: 1,
        max: 8,
        step: 1,
        slide: function (event, ui) {
            var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium',
                'input-large', 'input-xlarge', 'input-xxlarge'
            ];
            var val = parseInt(ui.value);
            $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.' + sizing[val]);
        }
    });

    $("#input-span-slider").slider({
        value: 1,
        range: "min",
        min: 1,
        max: 12,
        step: 1,
        slide: function (event, ui) {
            var val = parseInt(ui.value);
            $('#form-field-5').attr('class', 'col-xs-' + val).val('.col-xs-' + val);
        }
    });



    //"jQuery UI Slider"
    //range slider tooltip example
    $("#slider-range").css('height', '200px').slider({
        orientation: "vertical",
        range: true,
        min: 0,
        max: 100,
        values: [17, 67],
        slide: function (event, ui) {
            var val = ui.values[$(ui.handle).index() - 1] + "";

            if (!ui.handle.firstChild) {
                $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                    .prependTo(ui.handle);
            }
            $(ui.handle.firstChild).show().children().eq(1).text(val);
        }
    }).find('span.ui-slider-handle').on('blur', function () {
        $(this.firstChild).hide();
    });


    $("#slider-range-max").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 2
    });

    $("#slider-eq > span").css({
        width: '90%',
        'float': 'left',
        margin: '15px'
    }).each(function () {
        // read initial values from markup and remove that
        var value = parseInt($(this).text(), 10);
        $(this).empty().slider({
            value: value,
            range: "min",
            animate: true

        });
    });

    $("#slider-eq > span.ui-slider-purple").slider('disable'); //disable third item


    $('#input-post-uplfile').ace_file_input({
        no_file: 'No File ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false, //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
    });

    $('#input-emp-uplfile').ace_file_input({
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

    $('#stock-uplfile').ace_file_input({
        no_file: 'No File ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false, //| true | large
        whitelist: 'png|jpg|jpeg',
        blacklist:'exe|php'
        //onchange:''
        //
    });

    $('#id-input-file-1 , #id-input-file-2').ace_file_input({
        no_file: 'No File ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
    });
    $('#id-input-file-photo').ace_file_input({
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
    //pre-show a file name, for example a previously selected file
    //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


    $('#id-input-file-3').ace_file_input({
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        thumbnail: 'small' //large | fit
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
            	//Check an example below
            	//or examples/file-upload.html
            	return true;
            }*/
            /**,before_remove : function() {
            	return true;
            }*/
            ,
        preview_error: function (filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function () {
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });


    //$('#id-input-file-3')
    //.ace_file_input('show_file_list', [
    //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
    //{type: 'file', name: 'hello.txt'}
    //]);




    //dynamically change allowed formats by changing allowExt && allowMime function
    $('#id-file-format').removeAttr('checked').on('change', function () {
        var whitelist_ext, whitelist_mime;
        var btn_choose
        var no_icon
        if (this.checked) {
            btn_choose = "Drop images here or click to choose";
            no_icon = "ace-icon fa fa-picture-o";

            whitelist_ext = ["jpeg", "jpg", "png", "gif", "bmp"];
            whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
        } else {
            btn_choose = "Drop files here or click to choose";
            no_icon = "ace-icon fa fa-cloud-upload";

            whitelist_ext = null; //all extensions are acceptable
            whitelist_mime = null; //all mimes are acceptable
        }
        var file_input = $('#id-input-file-3');
        file_input
            .ace_file_input('update_settings', {
                'btn_choose': btn_choose,
                'no_icon': no_icon,
                'allowExt': whitelist_ext,
                'allowMime': whitelist_mime
            })
        file_input.ace_file_input('reset_input');

        file_input
            .off('file.error.ace')
            .on('file.error.ace', function (e, info) {
                //console.log(info.file_count);//number of selected files
                //console.log(info.invalid_count);//number of invalid files
                //console.log(info.error_list);//a list of errors in the following format

                //info.error_count['ext']
                //info.error_count['mime']
                //info.error_count['size']

                //info.error_list['ext']  = [list of file names with invalid extension]
                //info.error_list['mime'] = [list of file names with invalid mimetype]
                //info.error_list['size'] = [list of file names with invalid size]


                /**
                if( !info.dropped ) {
                	//perhapse reset file field if files have been selected, and there are invalid files among them
                	//when files are dropped, only valid files will be added to our file array
                	e.preventDefault();//it will rest input
                }
                */


                //if files have been selected (not dropped), you can choose to reset input
                //because browser keeps all selected files anyway and this cannot be changed
                //we can only reset file field to become empty again
                //on any case you still should check files with your server side script
                //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
            });


        /**
        file_input
        .off('file.preview.ace')
        .on('file.preview.ace', function(e, info) {
        	console.log(info.file.width);
        	console.log(info.file.height);
        	e.preventDefault();//to prevent preview
        });
        */

    });

    $('#spinner1').ace_spinner({
            value: 0,
            min: 0,
            max: 200,
            step: 10,
            btn_up_class: 'btn-info',
            btn_down_class: 'btn-info'
        })
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function () {
            //console.log($('#spinner1').val())
        });
    $('#spinner2').ace_spinner({
        value: 0,
        min: 0,
        max: 10000,
        step: 100,
        touch_spinner: true,
        icon_up: 'ace-icon fa fa-caret-up bigger-110',
        icon_down: 'ace-icon fa fa-caret-down bigger-110'
    });
    $('#spinner3').ace_spinner({
        value: 0,
        min: -100,
        max: 100,
        step: 10,
        on_sides: true,
        icon_up: 'ace-icon fa fa-plus bigger-110',
        icon_down: 'ace-icon fa fa-minus bigger-110',
        btn_up_class: 'btn-success',
        btn_down_class: 'btn-danger'
    });
    $('#spinner4').ace_spinner({
        value: 0,
        min: -100,
        max: 100,
        step: 10,
        on_sides: true,
        icon_up: 'ace-icon fa fa-plus',
        icon_down: 'ace-icon fa fa-minus',
        btn_up_class: 'btn-purple',
        btn_down_class: 'btn-purple'
    });

    //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
    $('input[name=date_range]').daterangepicker({
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        })
        .prev().on(ace.click_event, function () {
            $(this).next().focus();
        });


    $('#timepicker1').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function () {
        $('#timepicker1').timepicker('showWidget');
    }).next().on(ace.click_event, function () {
        $(this).prev().focus();
    });

    if (!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
        //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-arrows ',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    }).next().on(ace.click_event, function () {
        $(this).prev().focus();
    });


    $('#colorpicker1').colorpicker();
    //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe

    $('#simple-colorpicker-1').ace_colorpicker();
    //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
    //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
    //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
    //picker.pick('red', true);//insert the color if it doesn't exist


    $(".knob").knob();


    var tag_input = $('#form-field-tags');
    try {
        tag_input.tag({
            placeholder: tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            source: ace.vars['US_STATES'], //defined in ace.js >> ace.enable_search_ahead
            /**
            //or fetch data from database, fetch those that match "query"
            source: function(query, process) {
              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
              .done(function(result_items){
            	process(result_items);
              });
            }
            */
        })

        //programmatically add/remove a tag
        var $tag_obj = $('#form-field-tags').data('tag');
        $tag_obj.add('Programmatically Added');

        var index = $tag_obj.inValues('some tag');
        $tag_obj.remove(index);
    } catch (e) {
        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
        tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') +
            '" rows="3">' + tag_input.val() + '</textarea>').remove();
        //autosize($('#form-field-tags'));
    }


    /////////
    $('#modal-form input[type=file]').ace_file_input({
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        thumbnail: 'large'
    })

    //chosen plugin inside a modal will have a zero width because the select element is originally hidden
    //and its width cannot be determined.
    //so we set the width after modal is show
    $('#modal-form').on('shown.bs.modal', function () {
        if (!ace.vars['touch']) {
            $(this).find('.chosen-container').each(function () {
                $(this).find('a:first-child').css('width', '210px');
                $(this).find('.chosen-drop').css('width', '210px');
                $(this).find('.chosen-search input').css('width', '200px');
            });
        }
    })
    /**
    //or you can activate the chosen plugin after modal is shown
    //this way select element becomes visible with dimensions and chosen works as expected
    $('#modal-form').on('shown', function () {
    	$(this).find('.modal-chosen').chosen();
    })
    */



    $(document).one('ajaxloadstart.page', function (e) {
        autosize.destroy('textarea[class*=autosize]')

        $('.limiterBox,.autosizejs').remove();
        $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu')
            .remove();
    });

});


jQuery(function ($) {
    var calendar = $('#calendar').fullCalendar({
        lang: 'th',
        eventRender: function (eventObj, $el) {
            $el.popover({
                title: eventObj.title,
                content: eventObj.description,
                trigger: 'hover',
                placement: 'bottom',
                container: 'body'
            });
        },
        buttonHtml: {
            prev: '<i class="ace-icon fa fa-chevron-left"></i>',
            next: '<i class="ace-icon fa fa-chevron-right"></i>'
        },

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        views: {
            month: {
                displayEventTime: false
            },
            week: {
                displayEventTime: false
            },
            day: {
                displayEventTime: false
            }
        },
        events: {
            url: baseurl + "meeting/getCalender",
            error: function () {}
        }
    });
})

$(document).ready(function () {
    $('#tbl-layout-10')
        .DataTable({
            "scrollX": true,
            "iDisplayLength": 10
        });
    $('#tbl-layout-25')
        .DataTable({
            "scrollX": true,
            "iDisplayLength": 25
        });
    $('#tbl-layout-50')
        .DataTable({
            "scrollX": true,
            "iDisplayLength": 50
        });
    $('#tbl-layout-100')
        .DataTable({
            "scrollX": true,
            "iDisplayLength": 100
        });
});

$(document).ready(function () {
    // $('#tbl-listMeeting')
    // .DataTable({
    // 	"iDisplayLength": 25
    // });
    $('.show-details-btn').on('click', function (e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass(
            'fa-angle-double-up');
    });
});
$('#chosen-multiple-style .btn').on('click', function (e) {
    var target = $(this).find('input[type=radio]');
    var which = parseInt(target.val());
    if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
    else $('#form-field-select-4').removeClass('tag-input-style');
});

$(document).ready(function () {
    $('#province').change(function () {
        var province_id = $('#province').val();
        if (province_id != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>employee/fetch_amphur",
                method: "POST",
                data: {
                    province_id: province_id
                },
                success: function (data) {
                    $('#amphur').html(data);
                    $('#district').html('<option value="0">กรุณาเลือก</option>');
                }
            });
        } else {
            $('#amphur').html('<option value="0">กรุณาเลือก</option>');
            $('#district').html('<option value="0">กรุณาเลือก</option>');
        }
    });

    $('#amphur').change(function () {
        var amphur_id = $('#amphur').val();
        if (amphur_id != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>employee/fetch_district",
                method: "POST",
                data: {
                    amphur_id: amphur_id
                },
                success: function (data) {
                    $('#district').html(data);
                }
            });
        } else {
            $('#district').html('<option value="0">กรุณาเลือก</option>');
        }
    });

});


$.validate({
    modules: 'security, file',
    onModulesLoaded: function () {
        $('input[name="pass_confirmation"]').displayPasswordStrength();
    }
});


$(document).ready(function () {
    //this calculates values automatically 
    sum();
    $("#allowance, #hostel, #traveling, #oilPrice, #otherValues").on("keydown keyup", function () {
        sum();
    });
});

function sum() {
    element = document.getElementById('allowance');
    if (element != null) {
        var num1 = document.getElementById('allowance').value;
        var num2 = document.getElementById('hostel').value;
        var num3 = document.getElementById('traveling').value;
        var num4 = document.getElementById('oilPrice').value;
        var num5 = document.getElementById('otherValues').value;
        var result = parseFloat(num1) + parseFloat(num2) + parseFloat(num3) + parseFloat(num4) + parseFloat(num5);
        var bath = result.toLocaleString() + "  บาท";
        document.getElementById('sum').value = bath;
    }
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#stock-uplfile-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#stock-uplfile").change(function(){
    readURL(this);
});
