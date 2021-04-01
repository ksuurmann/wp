jQuery(function($) {

    //randomise drop locations and times
    let left = Math.floor(Math.random() * 88) + 'vw';
    let delay = (Math.floor(Math.random() * 5) * 1000) + 2000;

    window.setTimeout(function() {
        $('.smEasterEgg').css('left', left).addClass('slide-in-top').show();
    }, delay);

    $('.smEasterEgg').click(function(e) {
        let message = $('.smEasterEggMessage').html();
        if(message === '') {
            message = 'Happy Easter!';
        }
        alert(message);
    });

});