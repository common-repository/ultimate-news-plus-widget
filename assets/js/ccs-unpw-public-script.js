jQuery( document ).ready(function($) {

	// Initialize slick slider
    $( '.ccs-unpw-news-slider-wrapper' ).each(function( index ) {

        var slider_id   = $(this).attr('id');
        var slider_conf = $.parseJSON( $(this).closest('.ccs-unpw-main-wrp').find('.ccs-unpw-slider-confi').attr('data-conf') );
        
        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

            jQuery('#'+slider_id).slick({
                dots            : (slider_conf.dots) == "true" ? true : false,
                infinite        : (slider_conf.loop) == "true" ? true : false,
                arrows          : (slider_conf.arrows) == "true" ? true : false,
                autoplay        : (slider_conf.autoplay) == "true" ? true : false,
                slidesToShow    : slider_conf.slides_column,
                slidesToScroll  : parseInt(slider_conf.slides_scroll),
                mobileFirst     : (UnpW.is_mobile == 1) ? true : false,
                responsive      : [
                    {
                        breakpoint: 1023,
                        settings: {
                            slidesToShow: (slider_conf.slides_column > 3) ? 3 : slider_conf.slides_column,
                            slidesToScroll: 1,
                        }
                    },{
                        breakpoint: 767,
                        settings: {
                            slidesToShow: (slider_conf.slides_column > 2) ? 2 : slider_conf.slides_column,
                            slidesToScroll: 1
                        }
                    },{
                        breakpoint: 479,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },{
                        breakpoint: 319,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
        } // End if
    });
});