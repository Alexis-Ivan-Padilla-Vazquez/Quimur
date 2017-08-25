(function($){
    //TODO unit test
    // https://github.com/pivotal/jasmine/wiki/Suites-and-specs
    /*
     * Class Carousel
     * @param {Object} el
     * @param {Object} options
     */
    $.OoCarousel = function(el, options){
                
        var CLSCAROUSELVIEW     = 'carousel-view',
            CLSCAROUSELPAGER    = 'carousel-pager',
            TRANSITIONFADE      = 'fade',
            TRANSITIONFADEOUTIN = 'fadeOutIn',
            CLSTYPECAROUSEL     = 'carousel-view-',
            CLSCAROUSELTHUMB    = 'carousel-thumb',
            CLSITEM             = 'item-',
            CLSACTIVEITEM       = 'active'
            TRANSITIONS         = ['fade', 'slide', 'fadeOutIn'];
                
        var self = this;
        
        
        self.$el = $(el);
        self.el = el;
        
        self.$el.data("OoCarousel", self);
        
        self.init = function init(){
            /*opts*/
            self.options = $.extend({},$.OoCarousel.defaultOptions, options);
            
            // carousel vars
            self.carouselView = self.$el.find('div.' + CLSCAROUSELVIEW);
            self.carouselContainer = self.carouselView.children();
            self.items = self.carouselView.find('li');
            self.totalItems = self.items.length;
            self.timer = null;
            
            
            if ( 0 === self.carouselView.length || self.totalItems <= 1 || !self.existTransition() ){
                return ;
            }
            
            self.currentItem = self.options.activeItem - 1;
            
            self.buildView();

            //Pagers
            if ( self.options.pager )
                self.createPagers();
                
            if ( self.options.diaporama.active) 
                self.prepareDiaporama()
                
            //keyboard controls
            if ( self.options.keyboardControls.active )
                self.attachKeyboardControls()
                
            self.setActiveItem(self.currentItem);
            
            // callback
            self.options.ended();
        };
        
        /*VIEW*/
        /*
         * Add the specific class CSS on the carousel-view element
         */
        self.buildView = function buildView(){
            self.carouselView.addClass( CLSTYPECAROUSEL + self.options.effect.type );
            
            self['prepareView' + self.options.effect.type]();
            for (var i = 0, len = self.items.length; i<len; i++){
              $(self.items[i]).addClass(CLSITEM + i);
            }
        };
        
        self.prepareViewslide = function prepareViewSlide(){
          var leftPosition;
            self.itemWidth = self.items.outerWidth(true);
            self.elCount = Math.ceil(self.items.length);
            self.slideCount = Math.ceil(self.elCount / self.options.group);
            self.slideWidth = self.itemWidth * self.options.group;
            
            self.totalWidth = (self.options.loop) ? (self.slideCount+2)*self.slideWidth : self.slideCount*self.slideWidth; //todo ternaire if option loop + clone first and last

            var modulo = self.elCount%self.options.group;
            
            if(self.options.group>1 && self.elCount >= self.options.group ) {    
                if(modulo) {
                    var elOldMargin = parseInt(self.carouselView.find('li:first').css('margin-right'));
                    var elNewMargin = (self.options.group - modulo) * self.itemWidth + elOldMargin;
                    self.carouselView.find('li:last').css('margin-right', elNewMargin);
                }
            }
            
            if (self.options.loop){
                //clone first and last item
                var cloneFirst = self.carouselView.find('li:lt('+ self.options.group+')').clone().addClass('cloned'),
                    cloneLast = self.items.slice( (modulo) ? - modulo : - self.options.group ).clone().addClass('cloned');
                
                self.carouselContainer.append(cloneFirst);
                self.carouselContainer.prepend(cloneLast);
                
            }
            
            leftPosition = self.slideLeftPosition(self.currentItem);
            
            self.carouselView.css('overflow', 'hidden');
            self.carouselContainer.width(self.totalWidth);
            self.carouselContainer.css('left', - leftPosition);
        };
        
        self.prepareViewfade = function prepareViewFade(){
            
        };
        
        self.prepareViewfadeOutIn = function prepareViewfadeOutIn(){
            
        };
      /*END VIEW*/
        
        /*
         * Test if the wrapper pager already exists
         */
        self.isWrapperPager = function isWrapperPager(){
            var res = ( self.$el.find('div.' + CLSCAROUSELPAGER).length > 0 ) ? true : false;
            
            return res;
        };
        
        /*
         * Create the wrapper pager DOM element
         */
        self.createPagerWrapper = function createPagerWrapper(){
            self.pager = $('<div />', { 'class' : CLSCAROUSELPAGER });
            self.pager.appendTo(self.$el);
        };
        
        /*
         * Create the wrapper pager if it doesn't exist + create all the pager : prevNext / thumb etc
         * all the config objects pass the events methodes and if it's existe the dom element
         */
        self.createPagers = function createPagers(){
            if ( !self.isWrapperPager() ){
                self.createPagerWrapper();
            }
         
            if ( self.options.pager.pagerItems ){
                var configItems = {
                    itemHandler : function itemHandler(index){
                      if (self.options.effect.type ==='slide' && self.options.loop){
                       index = (Math.floor( index/self.options.group))
                      }
                      self.goTo(index);
                    }
                };
                
                if ( typeof self.options.pager.pagerItems === 'object' ){
                    configItems.domElem = self.options.pager.pagerItems;
                } else {
                    configItems.totalItems = self.totalItems;
                }
                
                self.pagerItems = new $.OoPagerItems(self.pager, configItems);
            } 
            
            if ( self.options.pager.prevNext ) {
                configPrevNext = {
                    nextHandler : function nextHandler(){
                        self.goToNext();
                    },
                    prevHandler : function(){
                        self.goToPrev();
                    }
                };
                
                if ( typeof self.options.pager.prevNext === 'object' ){
                    configPrevNext.domElem = self.options.pager.prevNext;
                }
                    
                self.pagerPrevNext = new $.OoPagerPrevNext(self.pager, configPrevNext);
            }
            
            
            
        };
        
        
        /*
         * add active class on current item
         */
        self.setActiveItem = function setActiveItem(index){

            var newActiveItem  = self.carouselView.find('li.'+CLSITEM+index);
                self.carouselView.find('li.' + CLSACTIVEITEM).removeClass(CLSACTIVEITEM);
                
                newActiveItem.addClass(CLSACTIVEITEM);
                
                switch ( self.options.effect.type ){
                    case TRANSITIONFADE, TRANSITIONFADEOUTIN : newActiveItem.css('z-index', 3);
                                                               newActiveItem.siblings().css('z-index', 1);
                                                               break; 
                }
                
                self.updatePagers();
                
        };
        
        /*
         * Test if all dom elements are inactive
         */
        self.isBusy = function isBusy(){
            return ( 0 === self.carouselView.find(':animated').length );
        };
        
        /*
         * Go the next slide 
         */
        self.goToNext = function goToNext(){
          if ( self.options.effect.type === 'slide' && self.options.loop){
            //condition will be done in callback function cause with clone the limit isn't self.totoalITems - 1
            self.goTo(self.currentItem + 1);
          } else {
            if (self.currentItem < self.totalItems-1){
                self.goTo(self.currentItem + 1);
            } else {
                if ( self.options.loop){
                    self.goTo(0);
                } else {
                    if ( self.timer ) {
                        self.stopDiaporama()
                    }
                }
            }
          }
        };
        
        /*
         * Go to the prev slide
         */
        self.goToPrev = function goToPrev(){
          if ( self.options.effect.type === 'slide' && self.options.loop){
            //condition will be done in callback function cause with clone the limit isn't 0
            self.goTo(self.currentItem - 1);
          } else {
            if (self.currentItem > 0){
                self.goTo(self.currentItem - 1);
            } else {
                if (self.options.loop){
                    self.goTo(self.totalItems - 1);
                } else {
                    if ( self.timer ) {
                        self.stopDiaporama()
                    }
                }
            }
          }
            
        };
        
        /*
         * Go to a specific slide
         * test if all dom elements are inactive and if the slide to reach exists 
         */
        self.goTo = function goTo(index){
            if ( self.isBusy() /*&& self.existSlide(index)*/) {
                self[self.options.effect.type + 'Transition'](index);
                //if (self.options.effect.type !== 'slide')
                  self.goneTo(index);
                  
                
            }
        };
        
        /*
         * Callback function after the transition
         */
        self.goneTo = function goneTo (index){
            self.currentItem = index;
            self.setActiveItem(index);

            /*if (self.options.loop && self.options.effect.type === TRANSITIONS[1] && index === self.totalItems ){
                self.carouselContainer.css('left', 0)
                self.currentItem = 0;
                self.setActiveItem(0);
            }*/
            
           // self.options.after();
        }
        
        /*
         * Test if the slide exists
         */
        self.existSlide = function existSlide (index){
            var res = ( index >= 0 && index <= self.totalItems-1  ) ? true : false ;
            
            return res
        };
        
        self.existTransition = function existTransition() {
            var res = false;
            for ( var i=0, len = TRANSITIONS.length; i < len; ++i ){
                if ( self.options.effect.type === TRANSITIONS[i] ){
                    res = true;
                }
            }
            
            return res;
        };
        
        /*
         * Fade transition - fade out only the old item
         */
        self.fadeTransition = function(index){
            var that = self,
                newItem = self.carouselView.find('li').eq(index),
                oldItem = self.carouselView.find('li').eq(self.currentItem);

            oldItem.css('z-index',3);
            newItem.css('z-index',2);
            oldItem.fadeTo(self.options.speed, 0, function(){
               $(this).css({
                  'z-index' : 1,
                  'opacity' : 1
               });
               
               newItem.css('z-index', 3);
               
               self.options.after();
            });
        };
        
        /*
         * FadeOutIn transition - fade out the old item then fade in the new item
         */
        self.fadeOutInTransition = function fadeOutInTransition(index){
            var newItem = self.carouselView.find('li').eq(index),
                oldItem = self.carouselView.find('li').eq(self.currentItem);
            
            oldItem.siblings().hide();
            newItem.css('z-index',2);
            oldItem.fadeTo(self.options.speed, 0, function(){
               newItem.css('z-index', 3).fadeTo(self.options.speed, 1 , function(){
                   oldItem.css({
                      'z-index' : 1,
                      'opacity' : 1
                   }).hide();
               });
               
               self.options.after();
            });
        };
        
        
        /*
         * Slide transition
         */
        self.slideLeftPosition = function slideLeftPosition(index){
         var res = (self.options.loop) ? index*self.slideWidth + self.slideWidth : index*self.slideWidth;

         return res;
        };
        
        self.slideTransition = function slideTransition(index){
            var that = self;
            self.carouselContainer.animate({
                'left' : - that.slideLeftPosition(index)
            }, self.options.speed, function(){
              that.callbackTransitionSlide(index);
            });
        };
        
        self.callbackTransitionSlide = function callbackTransitionSlide(index){
          var that = self;
          var newIndex = index, leftPosition;
          if (self.options.loop){
            
            if (newIndex >= self.slideCount){
              //reset first Item
              newIndex = 0;
              self.carouselContainer.css({
                'left' : - that.slideLeftPosition(newIndex)
              });
            } else {
              if (newIndex < 0){
                //reset last item
                newIndex = self.slideCount-1;
                self.carouselContainer.css({
                  'left' : - that.slideLeftPosition(newIndex)
                });
              }
            }
          }
          self.goneTo(newIndex);
          
          self.options.after();
        };
        /*
         * Update the pagers elements
         */
        self.updatePagers = function updatePagers (){
          var itemsLimits = [];
            if ( self.pagerItems )
              {
                if ( self.options.effect.type === 'slide' && self.options.loop){
                  itemsLimits.push(self.currentItem*self.options.group);
                  itemsLimits.push(self.currentItem*self.options.group + self.options.group);
                } else {
                  itemsLimits.push(self.currentItem);
                  itemsLimits.push(self.currentItem+1);
                }
                
                self.pagerItems.activeItem(itemsLimits)
              }
                
                
            if ( self.pagerPrevNext && false === self.options.loop ){
                self.pagerPrevNext.showHideItem('all', 1);
                if ( 0 == self.currentItem || ( self.totalItems - 1 ) == self.currentItem ) {
                    self.pagerPrevNext.showHideItem( (0 == self.currentItem ) ? 'prev' : 'next', 0 );
                }
            }
            
            self.options.afterUpdatePagers()
        };
        
        /*
         * attach event on the carousel if pause option and lauch the diaporama
         */
        self.prepareDiaporama = function(){
            if ( self.options.diaporama.pause) {
                self.$el.bind({
                    mouseenter : function(){
                        self.stopDiaporama()
                    },
                    mouseleave : function(){
                        self.restartDiaporama()
                    }
                })
            }
            self.startDiaporama()
        };
        
        /*
         * call goTONext function at duration option interval time
         */
        self.startDiaporama = function diaporama(){
            self.timer = setInterval(function(){
                self.goToNext()
            }, self.options.diaporama.duration);
        };
        
        self.restartDiaporama = function restartDiaporama(){
            self.startDiaporama()
        };
        
        self.stopDiaporama = function stopDiaporama(){
            clearInterval(self.timer)
        };

        self.attachKeyboardControls = function attachKeyboardControls(){
            $(document).bind({
                'keyup' : function(e){
                    switch (e.keyCode){
                        case self.options.keyboardControls.prev :
                                self.goToPrev()
                            break;
                        case self.options.keyboardControls.next :
                                self.goToNext() 
                            break;
                    }
                }
            })
        };

        self.init();

    };
    
    $.OoCarousel.defaultOptions = {
        effect: {type:'slide'},
        pager: {
            'prevNext'   : true, //true false or domElem
            //'pagerItems' : false, //true false or domElem,
            'pagerItems' : false //true false or domElem
        },
        afterUpdatePagers : function(){},
        group: 1,
        speed: 400,
        diaporama : false,
        loop : true,
        thumb : false,
        fullWidth : false,
        activeItem : 1,
        after : function after(){},
        ended : function ended(){},
        diaporama : { active: false, duration: 10000, pause: true },
        keyboardControls : {
            active : false,
            prev : 37 ,
            next : 39
        }
    };
    
    $.fn.OoCarousel = function(options){
        return this.each(function(){
            (new $.OoCarousel(this, options));
        });
    };
  
    $.fn.getOoCarousel = function(){
        this.data("OoCarousel");
    };
    
    
    /*end OoCarousel*/
    
    
   
   /*-----------------------------------------------------------------------*/
   
   
    /*
     * Pager PrevNext
     * @param {Object} el
     * @param {Object} options
     */
    $.OoPagerPrevNext = function(el, options){
        
        var self = this;


        //CONST
        var CLSPREVNEXT = 'carousel-prev-next',
            CLSPREV = 'carousel-prev',
            CLSNEXT = 'carousel-next',
            CLSICON = 'icon';
        

        self.$el = $(el);
        self.el = el;
        

        self.$el.data("OoPagerPrevNext", self);
        
        self.init = function init(){
            self.options = $.extend({},$.OoPagerPrevNext.defaultOptions, options);
           
            if (!self.options.domElem){
                self.buildPager();
            } else {
                self.list = self.options.domElem;
            }
            
            self.attachEvents();
            
        };
        
        self.attachEvent = function attachEvent(elem, customEventType, handler){
            var configObject = {};
                configObject[customEventType] = function(e){
                    handler();
                    
                    e.preventDefault();
                };
                
                elem.bind(configObject);
        };
        
        self.attachEvents = function attachEvents(){
            self.attachEvent(self.list.find('.'+ CLSPREV + ' a'), 'click', self.options.prevHandler);
            self.attachEvent(self.list.find('.'+ CLSNEXT + ' a'), 'click', self.options.nextHandler);
        };
        
        self.buildPager = function buildPager(){
            self.list = $('<ul />', {'class':CLSPREVNEXT});
            self.buildPrevItem();
            self.buildNextItem();
            self.list.appendTo(self.$el);
        };
        
        self.buildPrevItem = function buildPrevItem(){
            var  lnkPrev = $('<a />').append($('<span />',{'class': CLSICON}).text('Previous')).attr('href','#'),
                 prev = $('<li />', {'class' : CLSPREV}).append(lnkPrev);

            prev.appendTo(self.list);
        };
        
        self.buildNextItem = function buildNextItem(){
            var  lnkNext = $('<a />').append($('<span />',{'class': CLSICON}).text('Next')).attr('href','#'),
                 next = $('<li />', {'class' : CLSNEXT }).append(lnkNext);

            next.appendTo(self.list);
        };


        self.showHideItem = function hideItem(elem, display){
            //display : 0 hide 1 show
            var item;
            switch (elem) {
                case 'next' : item = self.list.find('li.' + CLSNEXT);
                              break;
                case 'prev' : item = self.list.find('li.' + CLSPREV);
                              break;
                case 'all' : item = self.list.find('li.' + CLSPREV + ', li.' + CLSNEXT);
                              break;
            }
            
            item[(0 === display) ? 'hide' : 'show' ]();
        };

        self.init();
    };
    
    $.OoPagerPrevNext.defaultOptions = {
        prevHandler : null,
        nextHandler : null
    };
    
    $.fn.OoPagerPrevNext = function(options){
        return this.each(function(){
            (new $.OoPagerPrevNext(this, options));
        });
    };
    
    $.fn.getOoPagerPrevNext = function(){
        this.data("OoPagerPrevNext");
    };
    
    /*end OoPagerPrevNext*/
   
   
   /*-----------------------------------------------------------------------*/
   
   /*
    * OoPagerItem
    * @param {Object} el
    * @param {Object} options
    */
   $.OoPagerItems = function(el, options){
        var self = this;

        self.$el = $(el);
        self.el = el;
        
        var CLSACTIVEITEM = 'active',
            CLSPAGERITEM  = 'carousel-items',
            CLSHOVER      = 'item-hover',
            CLSITEM       = 'item';
        
        
        self.$el.data("OoPagerItem", self);
        
        self.init = function(){
            self.options = $.extend({},$.OoPagerItems.defaultOptions, options);
            self.list  = self.options.domElem || $('<ul />', { 'class' : CLSPAGERITEM});

            
            if ( self.options.domElem ) {
                elems = self.options.domElem;
                elems.appendTo(self.$el);
            } else {
                self.buildItems();
            }
            
            //prepare children
            self.list.children().addClass(CLSITEM);
            self.bindElems();
        };
        
        self.bindElems = function bindElems(){
            self.list.delegate('.'+CLSITEM, 'click', function(e){
                e.preventDefault();
                if ( !$(this).hasClass(CLSACTIVEITEM)){
                  self.options.itemHandler($(this).index());
                }
                
            });
            
            self.list.delegate('.'+CLSITEM, 'mouseenter', function(){
                $(this).toggleClass(CLSHOVER);
            });
            
            self.list.delegate('.'+CLSITEM, 'mouseleave', function(){
                $(this).toggleClass(CLSHOVER);
            });
        };
        
        self.activeItem = function(limits){
            self.list.find('li.' + CLSACTIVEITEM).removeClass(CLSACTIVEITEM);
            //limits
            var items = self.list.find('li');
            items.slice(limits[0], limits[1]).addClass(CLSACTIVEITEM)
            //self.list.find('li').eq(index).addClass(CLSACTIVEITEM);
        };
        
        self.buildItems = function buildItems(){
            for ( var i=0, len = self.options.totalItems; i < len; ++i){
                var item = $('<li />'),
                    itemIcon = $('<span />', {
                        'class' : 'icon',
                        text : i + 1
                    });
                    item.append(itemIcon);
                self.list.append(item);
            }
            self.list.appendTo(self.$el);
        };

        self.init();
    };
    
    $.OoPagerItems.defaultOptions = {
    };
    
    $.fn.OoPagerItems = function(options){
        return this.each(function(){
            (new $.OoPagerItems(this, options));
        });
    };
    
})(jQuery);

