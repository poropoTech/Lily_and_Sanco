$(function(){
    $('.category-card').each(function(){
        if(InView.is(this)){
            this.classList.add('animate__animated', 'animate__bounceInDown', 'visible');
        }
    });

    InView('.category-card')
        .on('enter', el => {
            el.classList.add('animate__animated', 'animate__bounceInDown', 'visible');
        });
});



