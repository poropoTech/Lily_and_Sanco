$(function () {
    let WallFeed = $('#response-wall-feed');

    $(WallFeed).infiniteScroll({
        path: $(WallFeed).attr('data-responses-feed-url') + '?page={{#}}',
        history: false,
        checkLastPage: '.feed-more-items',
        status: '#infinite-scroll-status-wall',
        debug:false,
        append: false,
    });

    $(WallFeed).on( 'load.infiniteScroll', function( event, response ) {
        // get responses from response
        let $responses = $( response ).find('.response-feed-item');
        $responses.each( function() {
            ResponseCard($(this).find('.response-card'));
        });
        $(WallFeed).infiniteScroll( 'appendItems', $responses );
    });

    $(WallFeed).on( 'last.infiniteScroll', function( event, response ) {
        $('#infinite-scroll-status-wall').find('.infinite-scroll-last').addClass( 'infinite-scroll-status-last-page' );
        $('#infinite-scroll-status-wall').addClass( 'infinite-scroll-status-last-page' );
    });
});




