$(function(){
    (function(){

        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;
        var latlng = new google.maps.LatLng(48.85964, 2.35538);
        var map;
        
        
        function resizeMap() {
                var html = $(window);
                var windowWidth = html.width();
                var windowHeight = html.height();
                var wrapperMap = $('.wrapper-inner-gmap');
                var wrapperOuterMap = $('.wrapper-outer-gmap');
                var mapOffsetHeight = wrapperMap.offset().top;
                var wrapperMapHeight = windowHeight-mapOffsetHeight;
                var wrapperSearchRoute = $('.wrapper-search-route');
                var heightSearchRoute = wrapperSearchRoute.innerHeight();

                wrapperMap.css({'width': windowWidth +'px','height' : wrapperMapHeight +'px'});
                wrapperSearchRoute.css ({'width' :windowWidth +'px'});  
                wrapperOuterMap.css({'height': wrapperMapHeight+'px'});
                $('#gmap').height(windowHeight-mapOffsetHeight-heightSearchRoute);
                map.setCenter(latlng);
            }
        
        
        function buildMap () {
            
            directionsDisplay = new google.maps.DirectionsRenderer();
            
            var myOptions = {
              zoom: 16,
              center: latlng,
              navigationControl: true,
              navigationControlOptions: {
                style: google.maps.NavigationControlStyle.SMALL
              },
              mapTypeControl : false,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              streetViewControl: true
            };
            
            map = new google.maps.Map(document.getElementById("gmap"),myOptions);
            
            directionsDisplay.setMap(map);

            var image = new google.maps.MarkerImage('/layouts/frontoffice/images/icon-octaveoctave-map.png',
                                                    new google.maps.Size(38, 57),
                                                    new google.maps.Point(0,0),
                                                    new google.maps.Point(15, 60)
            );
           var shadow = new google.maps.MarkerImage('/layouts/frontoffice/images/shadow-octaveoctave-map.png',
                                                    new google.maps.Size(56, 23),
                                                    new google.maps.Point(0,0),
                                                    new google.maps.Point(-5, 20)
           );
            
             var marker = new google.maps.Marker({
               position: latlng, 
               map: map,
               title:"Octave&Octave",
               icon : image,
               shadow: shadow
           });
           
           
           //custom map
            var ooStylez = [
                {
                    featureType: "administrative",
                    elementType: "all",
                    stylers: [
                      { saturation: -100 }
                    ]
                  },{
                    featureType: "landscape",
                    elementType: "all",
                    stylers: [
                      { saturation: -100 }
                    ]
                  },{
                    featureType: "poi",
                    elementType: "all",
                    stylers: [
                      { saturation: -100 }
                    ]
                  },{
                    featureType: "road",
                    elementType: "all",
                    stylers: [
                      { saturation: -100 }
                    ]
                  },{
                    featureType: "transit",
                    elementType: "all",
                    stylers: [
                      { hue : '#101C8B'}
                    ]
                  },{
                    featureType: "water",
                    elementType: "all",
                    stylers: [
                      { saturation: -100 }
                    ]
                  }
              ];

           
            var styledMapOptions = {
                name: "Octave&Octave"
            }
            
            var ooMapType = new google.maps.StyledMapType(
            ooStylez, styledMapOptions);
            
            map.mapTypes.set('oo', ooMapType);
            map.setMapTypeId('oo');
           
           
           
  
            //$('.octave-card').addClass('invisible');
            
            google.maps.event.addListener(marker, 'click', function() {
                $('.octave-card').toggleClass('invisible');
            });
 
            
             $('<div />', {
                 'class' : 'shadow-map shadow-top'
             }).appendTo($('#gmap'));
             
             $('<div />', {
                 'class' : 'shadow-map shadow-bottom'
             }).appendTo($('#gmap'));
             
             $(window).resize(function(){
                resizeMap();
             });
             resizeMap();
   
        } /*buidmap*/
        

        
        

        function buildSearch () {
             var elem = $('<div />', {
                'class' : 'search-route-content' 
             });
             
             var labelSearch = $('<label>', {
                 'for' : 'start-place',
                 text : dataSearch.labelSearch
             })
             
             $('<span>', {
                 'class' : 'icon icon-compass'
             }).appendTo(labelSearch);

             var wrapperInputs = $('<div />', {
                 'class' : 'search-route-inputs'
             });
             
             var inputSearch = $('<input />',{
                 'id' : 'start-place',
                 'type' : 'text',
                 'size' : 60
             }).attr('value',dataSearch.inputValueDefault).bind ({
                 'focus' : function(){
                     if ( $(this).val() == dataSearch.inputValueDefault ) {
                         $(this).attr('value', '');
                     }
                 },
                 'blur' : function () {
                     if( $(this).val() == '') {
                         $(this).attr('value',dataSearch.inputValueDefault);
                     }
                 }
             }).appendTo(wrapperInputs);
             
             var buttonDriving = $('<button />', {
                 'id' : 'mode-driving',
                 'class' : 'selected icon icon-driving'
             }).appendTo(wrapperInputs);
             
             $('<span>', {
                 text : dataSearch.textDriving
             }).appendTo(buttonDriving);

             
             var buttonWalking = $('<button />', {
                 'id' : 'mode-walking',
                 'class': 'icon icon-walking'
             }).appendTo(wrapperInputs);
             ;
             
             $('<span>', {
                 text : dataSearch.textWalking
             }).appendTo(buttonWalking);
             
             var fields = [labelSearch, wrapperInputs];
             for (var i=0; i< fields.length; i++) {
                 fields[i].appendTo(elem);
             }
             elem.prependTo($('.search-route'));

            searchRoute();
        }
        
        
        function sendResult(caseResult,resultData, mode) {
              $('.wrapper-result').remove();
              
              switch (caseResult) {
                  case 0 : 
                    var msg = dataSearch.emptyField;
                  break;
                  
                  case 1 : 
                    var myRoute = resultData.routes[0].legs[0];
                    var distance = myRoute.distance.text;
                    var duration = myRoute.duration.text;
                    var startAddress = myRoute.start_address;
                    var mode = mode;
                    var textResultMode;
                    switch (mode) {
                        case 'WALKING' : textResultMode = dataSearch.textResultModeWalking;
                                         break;
                        default : textResultMode = dataSearch.textResultModeCar;
                    }
                    
                    var msg = dataSearch.textResultBegin +'<span class="start-adress">' + startAddress + '</span><br /><br /><span class="duration-distance">' + duration + ' ' + dataSearch.textResultEnd + ' ' + distance + ' '+ textResultMode + '</span>'; 
                  break;
                  
                  case 2 : 
                    var msg = dataSearch.notFound;
                  break;
              }
               
              var containerResults = $('<div />', {
                  'class' : 'wrapper-result'
              });
              
              $('<p>', {
                  'id' : 'result'
              }).html(msg).appendTo(containerResults);
              containerResults.appendTo($('.search-route'));
              
              resizeMap();
              
            }
        
        function sendForm(mode) {
                var startInput = document.getElementById('start-place');
                if(startInput) {
                    var start = startInput.value;
                }
                
                if(start && start != '' && start!=dataSearch.inputValueDefault)
                { 
                    var request = {
                        origin:start, 
                        destination:latlng,
                        travelMode: google.maps.DirectionsTravelMode[mode]
                    };
                    
                    directionsService.route(request, function(result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {  
                          directionsDisplay.setDirections(result);
                          
                          sendResult (1, result,google.maps.DirectionsTravelMode[mode]);
                        }
                        else {
                            sendResult(2);
                        }
                      });
                }
                else {
                   sendResult (0);
                }
            }
        
        //*Search Route*//
        function searchRoute () {
            geocoder = new google.maps.Geocoder();
            
           //switch mode
                var inputDrivingMode = $('#mode-driving');
                var inputWalkingMode = $('#mode-walking');
                inputDrivingMode.addClass('selected');
                inputDrivingMode.data ('data-mode','DRIVING');
                inputWalkingMode.data ('data-mode','WALKING');
            
             $('#mode-driving, #mode-walking').bind({
                'click' : function() {
                    sendForm($(this).data('data-mode'));
                    $('button.selected').removeClass('selected');
                    $(this).addClass('selected');
                    return false;
                }
            });
            
            /*search autocomplete*/
            $("#start-place").autocomplete({
                minLength: 2,
                source: function(request, response) {

                    geocoder.geocode( 
                    { 
                      address : request.term + ' , fr',
                      region: 'fr',
                      language : 'fr'
                    }
                    , function(results, status) {
   
                      if (status == google.maps.GeocoderStatus.OK) {

                        
                        response($.map(results, function(item) {

                            return {
                                label: item.formatted_address,
                                value: item.formatted_address
                            }
                        }))
                      } 
                    });
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                }
                ,
                open: function(event, ui) {
                    var widget = $(this).autocomplete('widget');
                    var widgetInitialTop = parseInt(widget.css('top'));
                    var widgetInitialLeft = parseInt(widget.css('left'));
                    widget.css({
                        'top' : widgetInitialTop + 5,
                        'left' : widgetInitialLeft - 11,
                        //'width' : 443,
                        'z-index' : 4
                    })
                }
            });

            $('#start-place').bind ({
                'keydown' : function(e) {
                    var keyCode = e.keyCode;
                    if ( keyCode == 13 && $(this).val().length > 0 ) {
                        sendForm($('button.selected').data('data-mode'));
                    }
                }
            });
        };

        //init  
        buildSearch();  
        buildMap();
        
  })()
});
