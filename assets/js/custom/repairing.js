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

// edit repairing
jQuery(document).on('click', 'a.update-repairing-details', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'repairing/editRepairing',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-update-repairing').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
        },
        success: function (html) {
            if (!html) {
                setTimeout(function () {
                    window.location.reload(true);
                },1500);
            } else {
                jQuery('#render-update-repairing').html(html);
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
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});