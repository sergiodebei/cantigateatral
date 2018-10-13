var blMobile = false;

$(function() {

  // setup ---------------------------------------------------------------------
  // check for mobile
  if( isMobile["any"]() ){
      //used in css and stuff
      $( 'body' ).addClass('body--mobile');
      blMobile = true;
  }
  // check for safari
  var ua = navigator.userAgent.toLowerCase();
  if (ua.indexOf('safari') != -1) {
    if (ua.indexOf('chrome') > -1) {
      //alert("1") // Chrome
    } else {
      // Safari
      $( 'body' ).addClass('body--safari');
    }
  }

  //function in fader.js
  checkFadeMobile();

});

// Vendor functions ------------------------------------------------------------
var isMobile = {
    Android: function() {
        return /Android/i.test(navigator.userAgent);
    },
    BlackBerry: function() {
        return /BlackBerry/i.test(navigator.userAgent);
    },
    iOS: function() {
        return /iPhone|iPad|iPod/i.test(navigator.userAgent);
    },
    Windows: function() {
        return /IEMobile/i.test(navigator.userAgent);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
    }
};
