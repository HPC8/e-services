// product View
jQuery(document).on('click', 'a.view-product', function(){
    var product_id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/viewProduct',
        data:{product_id: product_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-product').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-product').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

//Posts Add
jQuery(document).on('click', 'button#add-stock', function() {
    //var editor='stock-content';
    var content =tinyMCE.activeEditor.getContent();
   // alert(content);
    var formData = new FormData();
    formData.append('stock_title_id', jQuery('form#add-stock-form').find('.input-stock-title-id').val());
    formData.append('stock_content', content);
    //formData.append('stock_content', jQuery('form#add-stock-form').find('.input-stock-content').val());
    formData.append('stock_uplfile', jQuery('form#add-stock-form').find('input.input-stock-uplfile')[0].files[0]);
    jQuery.ajax({
        url:baseurl+'stocks/savePost',
        type: 'stock',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#add-stock').button('loading');
        },
        complete: function () {
            jQuery('button#add-stock').button('reset');
            jQuery("form#add-stock-form").find('textarea, input, file').each(function () {
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
                }, 1500);
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});


// jQuery(document).on('click', 'button#add-stock', function(){
    
//     jQuery.ajax({
//         type:'POST',
//         url:baseurl+'stock/saveStock',
//         data:jQuery("form#add-stock-form").serialize(),
//         dataType:'json',    
//         beforeSend: function () {
//             jQuery('button#add-stock').button('loading');
//         },
//         complete: function () {
//             jQuery('button#add-stock').button('reset');
//             setTimeout(function () {
//                 jQuery('span#success-msg').html('');
//             }, 1000);
            
//         },                
//         success: function (json) {
//             //console.log(json);
//            $('.text-danger').remove();
//             if (json['error']) {             
//                 for (i in json['error']) {
//                     var element = $('.input-stock-' + i.replace('_', '-'));
//                     if ($(element).parent().hasClass('input-group')) {                       
//                         $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
//                     } else {
//                         $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
//                     }
//                 }
//             } else {
//                 jQuery('span#success-msg').html('<div class="alert alert-success">เพิ่มข้อมูลสำเร็จ</div>');
//                 setTimeout(function () {
//                     window.location.reload(true);
//                 }, 1000);

//                 jQuery('form#add-stock-form').find('textarea, input').each(function () {
//                     jQuery(this).val('');
//                 });
//                 jQuery('#add-stock').modal('hide');
                
//             }

//         },
//         error: function (xhr, ajaxOptions, thrownError) {
//             console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//         }        
//     });
// });

// product Edit
jQuery(document).on('click', 'a.update-product-details', function(){
    var product_id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/editProduct',
        data:{product_id: product_id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-update-product').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-update-product').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// product update
jQuery(document).on('click', 'button#update-product', function(){
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/updateProduct',
        data:jQuery("form#update-product-form").serialize(),
        dataType:'json',    
        beforeSend: function () {
            jQuery('button#update-product').button('loading');
        },
        complete: function () {
            jQuery('button#update-product').button('reset');
            setTimeout(function () {
                jQuery('span#success-msg').html('');
            }, 1000);
            
        },                
        success: function (json) {
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

                jQuery('form#update-product-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#update-product').modal('hide');
            }                       
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set activity id for delete 
jQuery(document).on('click', 'a.delete-product-details', function(){
    var id = jQuery(this).data('getid');
    jQuery('button#delete-product-id').data('deleteid', id);

});
// Edit Delete Details
jQuery(document).on('click', 'button#delete-product-id', function(){
    var id = jQuery(this).data('deleteid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'project/deleteProduct',
        data:{id: id},
        dataType:'html',         
        complete: function () {           
            jQuery('#delete-product').modal('hide');
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