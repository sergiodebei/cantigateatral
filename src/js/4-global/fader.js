//used for fading in items
//depends on setPage() for calling checkFadeMobile()

//jquery loaded -------------------------------------------------------------------------------------
$(document).ready(function(){
    fadeBlocks();
});



//fading in script
$(document).scroll(fadeBlocks);
$(window).on('resize', fadeBlocks);

var fadeSpeed = 1000;
var fadersAnimating = 0;
function fadeBlocks(){
    //called from resizing and scrolling
    //console.log('fadeBlocks');

    var bottom_of_window = $(window).scrollTop() + $(window).height();

    //Check the location of each desired element
    $('.fader').each( function(i){

        //fade in the blocks when scrolling
        var pos_of_object;
        if($(window).width() > 700){
            //center of object ipad/desktop
            //pos_of_object = $(this).offset().top + $(this).outerHeight() / 2;
            pos_of_object = $(this).offset().top + 50;
        }else{
            //top of object for mobile
            pos_of_object = $(this).offset().top;
        }

        //console.log('pos_of_object: ' + pos_of_object + ', bottom_of_window: ' + bottom_of_window + ', opacity: ' + $(this).css('opacity'));
        if( bottom_of_window > pos_of_object ){

            if( $(this).data('faded') == undefined ){
                //only do this once
                $(this).data('faded', 'true');

                //add a delayed animation for the animating blocks
                var delay = (fadeSpeed * 0.15) * fadersAnimating;
                $(this).css({
                    'opacity': 1,
                    '-webkit-transform': 'translate(0px, 0px)',
                    'transform': 'translate(0px, 0px)',
                    'transition-delay': delay + 'ms'
                });

                //after animation
                //this might fire twice
                $(this).on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",
                //$(this).on("transitionend",
                    function(e){
                        // remove listener
                        $(this).off(e);

                        //remove all related to fader
                        //makes it possible to do other transforms
                        $(this).removeClass('fader');
                        $(this).css({
                            'opacity': '',
                            'transform': '',
                            'transition-delay': ''
                        });
                    }
                );

                //remember total fading blocks, to get them to not animate at the same time
                fadersAnimating++;
                //do a max of 4 so you don't have to wait too long when scrolling down fast
                if(fadersAnimating > 10){
                    fadersAnimating = 10;
                }

                //after the animation, make fadersAnimating 1 smaller
                setTimeout(function(){
                    fadersAnimating--;
                    if( fadersAnimating < 0 ){ fadersAnimating = 0 };
                    //console.log('fadersAnimating: ' + fadersAnimating);
                }, fadeSpeed * 0.3);
            }
        }
    });
}



function checkFadeMobile(){
    //call from setPage()

    if( blMobile ){
        //is mobile, so don't fade blocks because of not animating during scrolling
        //fade now immediately
        $('.fader').each( function(i){
            $(this).css({
                'opacity': 1,
                '-webkit-transform': 'translate(0px, 0px)',
                'transform': 'translate(0px, 0px)'
            });

            //after animation
            $(this).on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",
            //$(this).on("transitionend",
                function(e){
                    // remove listener
                    $(this).off(e);

                    //remove all related to fader
                    $(this).removeClass('fader');
                    $(this).css({
                        'opacity': '',
                        'transform': '',
                        'transition-delay': ''
                    });

                    //makes it possible to do other transforms
                }
            );
        });
    }
}
