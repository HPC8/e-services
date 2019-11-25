// View product
jQuery(document).on('click', 'a.view-products', function () {
    var product_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'products/viewProduct',
        data: {
            product_code: product_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-products').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-products').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// Edit product
jQuery(document).on('click', 'a.update-products-details', function () {
    var product_code = jQuery(this).data('getcode');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'products/editProduct',
        data: {
            product_code: product_code
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-update-products').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
        },
        success: function (html) {
            if (!html) {
                setTimeout(function () {
                    window.location.reload(true);
                },1500);
            } else {
                jQuery('#render-update-products').html(html);
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

// Update product
jQuery(document).on('click', 'button#update-products', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'products/updateProduct',
        data:jQuery("form#update-products-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('#render-update-products').html('<div class="text-center"><img src="https://apps.anamai.moph.go.th/e-services/assets/uploads/images/loading-crop.gif" style="max-width:360px;width:100%"></div>');
            //jQuery('button#update-product').button('loading');
        },
        complete: function () {
            jQuery('button#update-products').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
            //console.log(json);

           $('.text-danger').remove();
            if (json['error']) {             
                for (i in json['error']) {
	                var element = $('.input-product-' + i.replace('_', '-'));
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

                jQuery('form#update-products-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-products').modal('hide');
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

// set products id for delete 
jQuery(document).on('click', 'a.delete-products-details', function(){
    var id = jQuery(this).data('getid');
    jQuery('button#delete-products-id').data('deleteid', id);

});
// Edit Delete Details
jQuery(document).on('click', 'button#delete-products-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'products/deleteProducts',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#delete-products').modal('hide');
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