// function placeLazyVideo() {
//   var videoNr = $(this).attr('data-video');
//   var video = $(decodeURIComponent($('#lazy-video-' + videoNr).text()));
//   var videoSrc = video.attr('src');

//   video.addClass('video-player');
//   video.attr(
//     'src',
//     video.attr('src') + (videoSrc.indexOf('?') ? '&' : '?') + 'autoplay=1'
//   );

//   $(this).prepend(video);

//   $(this).addClass('lazy-loaded');
// }
