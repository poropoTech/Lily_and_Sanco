$(function () {
    let WallFeed = $('#activity-response-wall-feed');

    $(WallFeed).infiniteScroll({
        path: $(WallFeed).attr('data-responses-feed-url') + '?page={{#}}',
        history: false,
        checkLastPage: '.feed-more-items',
        status: '#infinite-scroll-status-activity',
        debug:false,
        append: false,
    });

    $(WallFeed).on( 'load.infiniteScroll', function( event, response ) {
        // get responses from response
        let $responses = $( response ).find('.response-feed-item');
        // append responses after images loaded
        $responses.each( function() {
            ResponseCard($(this).find('.response-card'));
        });
        $(WallFeed).infiniteScroll( 'appendItems', $responses );
    });
    $(WallFeed).on( 'last.infiniteScroll', function( event, response ) {
        $('#infinite-scroll-status-activity').find('.infinite-scroll-last').addClass( 'infinite-scroll-status-last-page' );
        $('#infinite-scroll-status-activity').addClass( 'infinite-scroll-status-last-page' );
    });
});




