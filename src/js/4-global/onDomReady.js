$(document).on("ready", function () {
	//hamburger menu
	$('.hamburger-menu').on('click', function() {
        // $(this).toggleClass('open');
        // $('nav').toggleClass('open');
        $('body').toggleClass('menu-open');
    });
    
    $('p:empty').remove();

	// var header = $("header");
    // $(window).scroll(function() {
    //     var scroll = $(window).scrollTop();

    //     if (scroll >= 300) {
    //         header.addClass("darkHeader");
    //     } else {
    //         header.removeClass("darkHeader");
    //     }
    // });

    function initSlider(){
        // console.log('page-single');
        console.log('init-slider');
        // SLIDER
        slider = $('.slider').slick({
            autoplay: true,
            autoplaySpeed: 6000000,
            dots: false,
            arrows: false,
            rows: 0,
        });

        $('.next').click(function() {
            $('.slider').slick("slickNext");
        });
        $('.prev').click(function() {
            $('.slider').slick("slickPrev");
        });
    }

    function initPhotoSwipeGallery(){
        var $psgal = $('.psgal')
        // var container_7_1 = document.querySelector(".psgal");

        // initialize  after all images have loaded
        $psgal.imagesLoaded( function(){
            // initialize Masonry after all images have loaded
            var msnry = new Masonry( $psgal[0], {
                // options...
                itemSelector: ".msnry_item",
                //columnWidth: 150,
                isFitWidth: true
            });
            $psgal.addClass("photoswipe_showme");
        });
        
        var totalWidth = 0;
        var totalHeight = 0;
        
        $(".psgal figure img").each(function( index ) {
            totalWidth = $(this).clientWidth;
            totalHeight = $(this).clientHeight;
            //$(this).parent().attr("data-size",totalWidth +"x"+totalHeight)
        });
    }

    function initSlickLightbox() {

        $('.gallery__fotos').slickLightbox(
            {
                itemSelector        : 'a',
                navigateByKeyboard  : true, 
            }
        ).on({
            // 'show.slickLightbox': function(){ 
            //     console.log('A `show.slickLightbox` event triggered.'); 
            // },
            'shown.slickLightbox': function(){ 
                $('body').toggleClass('slick-open');
                // console.log('A `shown.slickLightbox` event triggered.'); 
            },
            // 'hide.slickLightbox': function(){ 
            //     console.log('A `hide.slickLightbox` event triggered.'); 
            // },
            'hidden.slickLightbox': function(){ 
                $('body').toggleClass('slick-open');
                // console.log('A `hidden.slickLightbox` event triggered.'); 
            }
        });
    }

    // INIT
    // if ($('body').hasClass('home')) initHome();
    // if ($('body').hasClass('page-single')) initSlider();
    // if ($('body').hasClass('page-single')) initPhotoSwipeGallery();
    if ($('.slider').length) initSlider();
    if ($('.psgal').length) initPhotoSwipeGallery();
    if ($('.gallery__fotos').length) initSlickLightbox();

    // INIT LAZYLOAD
    $('img.lazy').lazyload({
        threshold: '100%',
        effect: 'fadeIn',
        // load: resize,
        placeholder: ''
    });
      
    // $( ".popup" ).click(function(e) {

    //     e.target.tagName === 'IMG' && BigPicture({
    //         el: e.target
    //     });

    //     // console.log('mytest >',e.target);

    //     ~e.target.className.indexOf('htmlvid') && BigPicture({
    //         el: e.target,
    //         vidSrc: e.target.getAttribute('vidSrc')
    //     });

    //     ~e.target.className.indexOf('vimeo') && BigPicture({
    //         el: e.target,
    //         vimeoSrc: e.target.getAttribute('vimeoSrc')
    //     });

    //     ~e.target.className.indexOf('youtube') && BigPicture({
    //         el: e.target,
    //         ytSrc: e.target.getAttribute('ytSrc')
    //     });

    // });



// alert(totalWidth);
});


