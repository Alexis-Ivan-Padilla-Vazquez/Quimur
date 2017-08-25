$(function(){
    $('body').addClass('hasJs');
    $('.external').attr('target','_blank');


        $('div#footer input.submit').hover(function(){
        $(this).addClass('submit-hover');
    },function(){
        $(this).removeClass('submit-hover')
    })

   /*Input footer*/
  /* WARNING BUG TO LINE 27 */
  
  var inputEmail = $('.form-subscribe .text');
  var placeholderEmail = inputEmail.val();

  
  inputEmail.bind({
      focus : function(){
          $(this).val('');
      },
      blur: function(){
          if( $(this).val() =='' ) {
              $(this).val(placeholderEmail);
          }
      }
  });
  
  
  if($("#job-view").length == 1) {
       $(document).keydown(function(e){ 
           if(e.keyCode=="37") { 
               $('.prev-next-top .prev a').click();
           } else if(e.keyCode=="39") { 
               $('.prev-next-top .next a').click();
           }
       }); 
   }
    
  /*mag*/
   $('#mag div.more').addClass('invisible');
   
   function collapseExpend(elem) {
       var linktextNew;
       var linktextElem = elem.find('span.link-text')
       var linktext = linktextElem.text();
       
       switch (linktext) {
           case 'Lire plus'  : linktextNew = 'Lire moins'
                               break;
           case 'Lire moins' : linktextNew = 'Lire plus'
                               break;
           case 'Less'       : linktextNew = 'More'
                               break;
           default           : linktextNew = 'Less'
                               break;
       }
       
       elem.prev('div.more').toggleClass('invisible');
       elem.toggleClass('active');
       linktextElem.text(linktextNew)
       
   }
   
    $('.link-view-more').click(function(){
        collapseExpend($(this));
        return false;
    });

   /*SHARE*/
  function showHide(elem){
      elem.toggleClass('active');
  }
  
  $('#share-this').bind({
      'click' : function(){
          return false;
      }
  });
  
  $('.share-tools').bind({
      'mouseenter' : function(){
          showHide($(this));
      },
      'mouseleave' : function(){
          showHide($(this));
      }
  });
  
  $.fn.goToTop = function(options){
        var defaults = {
            targetEnd : null,
            bottom : 0,
            left : 0,
            ajust : 0,
            speed : 1000
        };
        var opts = $.extend(defaults, options);
        return this.each(function(){
            $$ = $(this);
            
            if (opts.targetEnd){
                var stopAt = opts.targetEnd.offset().top
            }
            
            $$.hide().addClass('hide').css({
                'position' : 'fixed',
                'left' : opts.left,
                'bottom' : opts.bottom,
                'ajust' : 0
            });
            $$.addClass('fixed')
            $$.pos = $$.offset();
            
            var windowTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            var documentHeight = $(document).height();
            var targetHeight = opts.targetEnd.outerHeight(true);
            
            $(window).bind('scroll', function(){
                windowTop = $(window).scrollTop();
                if ( windowTop > 400 && $$.hasClass('hide') ) {
                    $$.fadeIn("fast").removeClass('hide');
                }
                
                if (windowTop < 400 && !$$.hasClass('hide') ){
                    $$.fadeOut("fast").addClass('hide');
                } 
                
                if ( windowTop + windowHeight > stopAt - opts.ajust ){
                    $$.css({
                        'position' : 'absolute',
                        'bottom' : 0
                    });
                    $$.removeClass('fixed')
                } else {
                    if ( !$$.hasClass('fixed')){
                        $$.addClass('fixed');
                        $$.css({
                            'position' : 'fixed',
                            'bottom' : opts.bottom
                        })
                    }
                }
            });

            $$.click( function(e){
                e.preventDefault();
                var target = $$.attr('href'),
                    targetTop = $(target).scrollTop();
                    
                $('body, html').animate({
                    'scrollTop' : targetTop
                },opts.speed)
            });
        });
    };
    
    $('#go-to-top').goToTop({
        targetEnd : $('#footer'),
        bottom : 31,
        ajust : 15
    });
    
    /*agency*/
   
    //LargeCarouselResize
    if ($('#c-agency').length){
       function onResizeCarousel() {
          $$ = $('.carousel-agency .carousel-view');
          var documentWidth = $('html').width();
          if ($$.width()>=documentWidth)
              $$.width(documentWidth);
          else 
              $$.width(1074);
       }
       onResizeCarousel();
       $(window).resize(onResizeCarousel);
    }
    
    //Scroll
    $('.carousel-agency a').bind('click',function(event){
        event.preventDefault();
        var offsetTop = $('#agency-top').offset().top;
        $('html,body').animate({
            scrollTop: offsetTop - 40
        }, 'slow');
    });   
        
});
