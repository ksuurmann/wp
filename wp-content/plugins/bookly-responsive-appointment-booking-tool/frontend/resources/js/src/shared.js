import $ from 'jquery';

export var opt = {};

/**
 * Start Ladda on given button.
 */
export function laddaStart(elem) {
    var ladda = Ladda.create(elem);
    ladda.start();
    return ladda;
}

/**
 * Scroll to element if it is not visible.
 *
 * @param $elem
 */
export function scrollTo($elem) {
    var elemTop   = $elem.offset().top;
    var scrollTop = $(window).scrollTop();
    if (elemTop < $(window).scrollTop() || elemTop > scrollTop + window.innerHeight) {
        $('html,body').animate({ scrollTop: (elemTop - 24) }, 500);
    }
}

export function booklyAjax(options) {
    return $.ajax(
        jQuery.extend({
            url: BooklyL10n.ajaxurl,
            dataType: 'json',
            xhrFields: {withCredentials: true},
            crossDomain: 'withCredentials' in new XMLHttpRequest(),
            beforeSend(jqXHR, settings) {},
        }, options)
    )
}