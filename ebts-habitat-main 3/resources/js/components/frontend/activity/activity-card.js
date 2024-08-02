
window.ActivityCard = function(activityItem) {


    InView.offset(100);

    InView('.activity-card-image')
        .on('enter', el => {
            el.classList.add('animate__animated', 'animate__fadeInBottomRight', 'visible');
        });
    InView('.activity-card-main')
        .on('enter', el => {
            el.classList.add('animate__animated', 'animate__fadeInBottomLeft', 'visible');
        });

};

$(function () {
    $('.activity-card').each(function(){
        ActivityCard(this);
    });
});



