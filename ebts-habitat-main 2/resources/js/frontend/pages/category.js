$(function () {
    let WallFeed = $('#category-activity-wall-feed');

    $(WallFeed).infiniteScroll({
        path: $(WallFeed).attr('data-activities-feed-url') + '?page={{#}}',
        history: false,
        checkLastPage: '.feed-more-items',
        status: '#infinite-scroll-status-category',
        debug:false,
        append: false,
    });

    $(WallFeed).on( 'load.infiniteScroll', function( event, response ) {
        // get responses from response
        let $activities = $( response ).find('.activity-feed-item');
        // append responses after images loaded
        $(WallFeed).infiniteScroll( 'appendItems', $activities );
        $activities.each( function() {
            ActivityCard($(this).find('.activity-card'));
        });
    });

    $(WallFeed).on( 'last.infiniteScroll', function( event, response ) {
        $('#infinite-scroll-status-category').find('.infinite-scroll-last').addClass( 'infinite-scroll-status-last-page' );
        $('#infinite-scroll-status-category').addClass( 'infinite-scroll-status-last-page' );
    });
});





