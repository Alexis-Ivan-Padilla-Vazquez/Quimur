(function($){
    $(function(){
       var modVid = {
           videoElems : null,
           player: null,
           playButton : null,
           muteButton : null,
           init : function init() {
               var that = this;
               
               document.ontouchmove = function(e){ e.preventDefault(); };
               
               this.videoElems = $('video');
               function resizeVideoRef(){
                   that.resizeVideo.call(that);
               }


               if ('ontouchstart' in window && window.DeviceOrientationEvent){
                   window.addEventListener('orientationchange', resizeVideoRef, false);
               } else {
                    window.addEventListener('resize', resizeVideoRef, false);
               }
               
               this.resizeVideo();
               
               //init Video
               this.initVideo();
               //attach Event Button
               this.attachEvents();
               this.createCarousel();
           },
           resizeVideo : function(){
               var windowWidth = (window.innerWidth),
                  windowHeight = (window.innerHeight),
                  windowProportion = windowWidth / windowHeight,
                  origWidth = 480,
                  origHeight = 270,
                  origProportion = origWidth / origHeight,
                  proportion = windowHeight / origHeight;
                  
              if (windowProportion >= origProportion) {
                  proportion = windowWidth / origWidth;
              }
              
              var deltaWidth = (proportion * origWidth) - windowWidth,
                  deltaHeight = (proportion * origHeight) - windowHeight;
              
              this.videoElems.css({
                  'width' : proportion * origWidth,
                  'height' : proportion * origHeight,
                  'margin-left' : - (deltaWidth) / 2
              });
              
              document.body.setAttribute('class','');
           },
           toggleFullScreen : function toggleFullScreen (){
               var wrapper = new oo.View.Dom('#portfolio');
                  
                  this[(wrapper.classList.hasClass('fullscreen')) ? 'unsetFullScreen': 'setFullScreen']();
           },
           setFullScreen : function(){
              var wrapper = new oo.View.Dom('#portfolio');
                  wrapper.classList.addClass('fullscreen');
           },
           unsetFullScreen : function(){
              var wrapper = new oo.View.Dom('#portfolio');
                  wrapper.classList.removeClass('fullscreen');
           },
           attachEvents : function attachEvents() {
              var that = this,
                  btnFullScreen = new oo.Button('#fullscreen');
               
               var items = oo.core.utils.collectionToArray(document.querySelectorAll('#carousel .item'));
                   items.forEach(function(item){
                       //transform en oobutton
                       var btnItem = new oo.Button(item);
                       
                       Events.addListener(oo.Button.EVT_TOUCH, function () {
                           that.toggleFullScreen();
                       },btnItem);
                   });
               
               Events.addListener(oo.Button.EVT_TOUCH, function () {
                    that.toggleFullScreen();
               }, btnFullScreen);
               
           },
           initVideo : function initVideo() {
               var that = this;
                      this.playButton = new oo.Button('#play1');
                      var muteButton = new oo.Button('#mute1');
                      var videoButton = new oo.Button('#video');
               var video = document.getElementById('video');
               this.player = new oo.Components.ooPlayer(video, this.playButton, muteButton);
               
               Events.addListener(oo.Button.EVT_TOUCH, function () {
                   that.displayPlayBtn();
               },this.playButton);
               
               Events.addListener(oo.Button.EVT_TOUCH, function () {
                   that.player.togglePlay();
                   that.displayPlayBtn(!that.player.isPlaying);
               },videoButton);
               
               document.querySelector('#play1').addEventListener('webkitTransitionEnd', function(){
                   if (that.playButton._dom.classList.hasClass('btn-hidden')) {
                       this.style.display = 'none';
                   }
               },false);
           },
           displayPlayBtn : function displayPlayBtn(display){
               if (display){
                   this.playButton._dom._dom.style.display = "block";
               }
               this.playButton._dom.classList[(display) ? 'removeClass' : 'addClass' ]('btn-hidden');
               this.playButton._dom.classList[(display) ? 'addClass' : 'removeClass' ]('btn-visible');
               
           },
           createCarousel : function createCarousel() {
               var carousel = new oo.Carousel('#carousel', false , carouselCallback),
                   isFirst = true, isLast = false, that = this;
               //bind prev next
               var prevBtn = new oo.Button('#prev-item');
                
               function carouselCallback(){
                  if (that.player.isPlaying) {
                     that.player.togglePlay();
                     that.displayPlayBtn(true);
                  }
                  that.unsetFullScreen();
               }
               
               Events.addListener(oo.Button.EVT_TOUCH, function () {
                   if (!isFirst){
                       isFirst = carousel.goToPrev();
                       isLast = false;
                       nextBtn._dom.classList.removeClass('hide');
                   }
                   //after update isFirst
                   prevBtn._dom.classList[(isFirst) ? 'addClass' : 'removeClass']('hide');
                   
                   carouselCallback();
               },prevBtn);
               
               var nextBtn = new oo.Button('#next-item');
               Events.addListener(oo.Button.EVT_TOUCH, function () {
                   if (!isLast){
                      isLast = carousel.goToNext();
                      isFirst = false;
                      prevBtn._dom.classList.removeClass('hide');
                   }
                   
                   //after update isLast
                   nextBtn._dom.classList[(isLast) ? 'addClass' : 'removeClass' ]('hide');
                   
                   carouselCallback();
               },nextBtn);
               
               function resetCarousel(){
                   carousel.reset();
               }

               if ('ontouchstart' in window && window.DeviceOrientationEvent){
                   window.addEventListener('orientationchange', resetCarousel, false);
               } else {
                    window.addEventListener('resize', resetCarousel, false);
               }
               
           }
       };
       
       window.addEventListener('load',function(){
           modVid.init.call(modVid);
       }, false);
    });
})(jQuery);