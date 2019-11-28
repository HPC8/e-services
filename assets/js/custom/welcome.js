var timpID=0;
// postView
jQuery(document).on('click', 'a.view-post', function(){
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type:'POST',
        url:baseurl+'welcome/viewPost',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-post').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-post').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

// set postid for view 
jQuery(document).on('click', 'a.view-post', function(){
    var id = jQuery(this).data('getid');
    timpID=id;

});

//postView previous
jQuery(document).on('click', 'button#previous-post-id', function(){
    var previous = timpID;
    var id = previous-1;
    timpID=id;
    jQuery.ajax({
        type:'POST',
        url:baseurl+'welcome/viewPost',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-post').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-post').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});

//postView next
jQuery(document).on('click', 'button#next-post-id', function(){
    var next = timpID;
    var id = next+1;
    timpID=id;
    jQuery.ajax({
        type:'POST',
        url:baseurl+'welcome/viewPost',
        data:{id: id},
        dataType:'html',    
        beforeSend: function () {
            jQuery('#render-view-post').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },                      
        success: function (html) {
            jQuery('#render-view-post').html(html);
                                 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }        
    });
});
