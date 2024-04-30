jQuery(function($){
    $('.show_more').click(function(){

        var button = $(this),
            data = {
                'action': 'loadmore',
                'query': io_loadmore_params.posts,
                'page' : io_loadmore_params.current_page
            };

        $.ajax({
            url : io_loadmore_params.ajaxurl,
            data : data,
            type : 'POST',
            beforeSend : function () {
                button.text('Loading...');
            },
            success : function( data ){
                if( data ) {
                    button.text( 'Toon meer' ).prev().after(data);
                    io_loadmore_params.current_page++;

                    if (io_loadmore_params.current_page === io_loadmore_params.max_page )
                        button.remove(); // if last page, remove the button
                } else {
                    button.remove();
                }
            }
        });
    });
});