jQuery(function($) {

    //randomise drop locations and times
    let left = Math.floor(Math.random() * 88) + 'vw';
    if(typeof square_media_egg_side_of_page !== 'undefined') {
        console.log('square_media_egg_side_of_page = ' + square_media_egg_side_of_page);
        if(square_media_egg_side_of_page === 'left') {
            left = Math.floor(Math.random() * 38) + 'vw';
        } else if(square_media_egg_side_of_page === 'right') {
            left = Math.floor(Math.random() * 38) + 50 + 'vw';
        }
    }

    let delay = (Math.floor(Math.random() * 5) * 1000) + 2000;

    let showEgg = true;

    if(typeof square_media_egg_stop_after_popup !== 'undefined') {
        console.log('square_media_egg_stop_after_popup = ' + square_media_egg_stop_after_popup);
        console.log('Cookies.get(\'easter_egg_clicked\') = ' + Cookies.get('easter_egg_clicked'));
        if(square_media_egg_stop_after_popup === '1' && Cookies.get('easter_egg_clicked') === '1') {
            showEgg = false;
        }
    }

    if(showEgg) {
        window.setTimeout(function() {
            $('.smEasterEgg').css('left', left).addClass('slide-in-top').show();
        }, delay);

        $('.smEasterEgg').click(function(e) {
            let message = $('.smEasterEggMessage').html();
            if(message === '') {
                message = 'Happy Easter!';
            }
            alert(message);
            Cookies.set('easter_egg_clicked', '1');
        });
    }

});