(function ($) {


    $.fn.imagesLoaded = function(callback){
        var elems = this.filter('img'),
            len   = elems.length,
            blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

        elems.bind('load.imgloaded',function(){
            if (--len <= 0 && this.src !== blank){
                elems.unbind('load.imgloaded');
                callback.call(elems,this);
            }
        }).each(function(){
                // cached images don't fire load sometimes, so we reset src.
                if (this.complete || this.complete === undefined){
                    var src = this.src;
                    // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
                    // data uri bypasses webkit log warning (thx doug jones)
                    this.src = blank;
                    this.src = src;
                }
            });

        return this;
    };

  Drupal.behaviors.unswModule = {
    attach: function(context, settings) {
      
      //Append Slick Nav
      $('#nice-menu-1').slicknav({
        allowParentLinks: true
      });
      
      
      //Front page UNSW menu

      // apply opacity
      $('#banner .desktop .menu-name-menu-unsw-front-page-menu').css({'opacity': 0.85});
      
      // append toggle button
      $('<div id="front-menu-toggle"></div>').insertAfter('#banner .desktop .menu-name-menu-unsw-front-page-menu > ul.menu > li:nth-child(4)');
      if($('#banner .desktop .menu-name-menu-unsw-front-page-menu').css('height') != '185px'){
         $('#front-menu-toggle').removeClass('minus-button').addClass('plus-button');
      }
      
      $('#banner .desktop .menu-name-menu-unsw-front-page-menu').hover(function(){
        if($('#banner .desktop .menu-name-menu-unsw-front-page-menu').css('height') == '40px'){
          $('#front-menu-toggle').removeClass('plus-button').stop().addClass('minus-button');
          $('#banner .desktop .menu-name-menu-unsw-front-page-menu').animate({'height': '185px'}, 'slow');
        }
      }, function(){
        if($('#banner .desktop .menu-name-menu-unsw-front-page-menu').css('height') != '40px'){
          $('#banner .desktop .menu-name-menu-unsw-front-page-menu').animate({'height': '40px'}, 'slow');
          $('#front-menu-toggle').removeClass('minus-button').addClass('plus-button');
        }
      });

      $('#banner .desktop .menu-name-menu-unsw-front-page-menu #front-menu-toggle').click(function(){
        if($('#banner .desktop .menu-name-menu-unsw-front-page-menu').css('height') != '185px'){
          $('#banner .desktop .menu-name-menu-unsw-front-page-menu').animate({'height': '185px'}, 'slow');
          $('#front-menu-toggle').removeClass('plus-button').addClass('minus-button');
        }
      });
      $('#banner .desktop .menu-name-menu-unsw-front-page-menu #front-menu-toggle').click(function(){
      //$('.front .carousel-holder #front-menu').mouseout(function(){
        if($('#banner .desktop .menu-name-menu-unsw-front-page-menu').css('height') != '40px'){
          $('#banner .desktop .menu-name-menu-unsw-front-page-menu').animate({'height': '40px'}, 'slow');
          $('#front-menu-toggle').removeClass('minus-button').addClass('plus-button');
        }
      });
      
      
      $('a.print').click(function(e){
        e.preventDefault();
        window.print();
      });
      
      // Calendar
      $('#block-unswcalendar-unsw-event-calendar .mini-day-on a').click(function(e){
        e.preventDefault();
        $('#block-unswcalendar-unsw-event-calendar .mini-day-on').removeClass('day-selected');
        $(this).parent().addClass('day-selected');
        var url = $(this).attr('href');
        url = url.split("?")[0];
        var date = url.substring(url.lastIndexOf('/') + 1);
        $("#block-unswcalendar-unsw-event-calendar .upcoming").load('/unswcalendar-update?day=' + date);
      });
      
      // adjust exposed filter height when calendar expand
      var calendar_height = $('#block-unswcalendar-unsw-event-calendar').height();
      $('#block-views-events-block-1 .views-exposed-widgets').height(calendar_height - 40);


        $(window).on( "orientationchange", function() {
            location.reload();
        });



        // Make drop menu blocks equal height.
        //$('ul.nice-menu > li').hover(function() {
            //var numBlock = $(this).children('ul').children('li').length;
            //for (var i=0; i<numBlock; i=i+3){
                //var maxHeight = 0;
                //$(this).children('ul').children('li').slice(i,i+3).each(function() {
                    //alert($(this).height());
                    //if ($(this).height() > maxHeight) {
                        //maxHeight = $(this).height();
                    //}
                //});
                //$(this).children('ul').children('li').slice(i,i+3).each(function() {
                    //$(this).height(maxHeight);
                //});
            //}
        //});



        function setSizes()
        {
            var numBlock = $('.view-home-content .views-row').length;
            for (var i=0; i<numBlock; i=i+3){
                var maxHeight = 0;
                $('.view-home-content .views-row').each(function() {
                    if ($(this).height() > maxHeight) {
                        maxHeight = $(this).height();
                    }
                });
                $('.view-home-content .views-row').each(function() {
                    $(this).height(maxHeight);
                });
            }



              var numBlock = $('.view-home-content .views-row').length;
              for (var i=0; i<numBlock; i=i+3){
                var maxHeight = 0;
                $('.view-home-content .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('.view-home-content .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }
              
              var numBlock = $('.media-front').length;
              for (var i=0; i<numBlock; i=i+3){
                var maxHeight = 0;
                $('.media-front').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('.media-front').each(function() {
                    $(this).height(maxHeight);
                });
              }

              // content block height (bottom)
              var numBlock = $('.view-bottom-content-block .views-row').length;
              for (var i=0; i<numBlock; i=i+3){
                var maxHeight = 0;
                $('.view-bottom-content-block .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('.view-bottom-content-block .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }


              var numBlock = $('.view-navbox .views-row').length;
              for (var i=0; i<numBlock; i=i+2){
                var maxHeight = 0;
                $('.view-navbox .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('.view-navbox .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }

              var numBlock = $('#block-views-events-block .views-row').length;
              for (var i=0; i<numBlock; i=i+1){
                var maxHeight = 0;
                $('#block-views-events-block .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('#block-views-events-block .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }


              var numBlock = $('.view-featured-news-events .views-row').length;
              for (var i=0; i<numBlock; i=i+1){
                var maxHeight = 0;
                $('.view-featured-news-events .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('.view-featured-news-events .views-row').each(function() {
                    $(this).height(maxHeight);
                });
                if ($('.view-featured-news-events .view-header').height() < maxHeight) {
                  $('.view-featured-news-events .view-header').height(maxHeight);
                }
              }

              var numBlock = $('#block-views-events-block-2 .views-row').length;
              for (var i=0; i<numBlock; i=i+1){
                var maxHeight = 0;
                $('#block-views-events-block-2 .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('#block-views-events-block-2 .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }


           // latest news row height
              var numBlock = $('#block-views-latest-news-events-block > .content > .view > .view-content > .views-row').length;
              for (var i=0; i<numBlock; i=i+1){
                var maxHeight = 0;


                $('#block-views-latest-news-events-block > .content > .view > .view-content > .views-row').each(function() {
                  if ($(this).height() > maxHeight) {
                      maxHeight = $(this).height();
                  }
                });
                $('#block-views-latest-news-events-block > .content > .view > .view-content > .views-row').each(function() {
                    $(this).height(maxHeight);
                });
              }
        }


      // Banner prev and next image
      $('.views-slideshow-cycle-main-frame-row').each(function(){
        if ($(this).is(':first-child')) {
          var prev = $(this).parent().find('.views-slideshow-cycle-main-frame-row:last-child .views-field-field-banner-image img').clone();
        } else {
          var prev = $(this).prev().find('.views-field-field-banner-image img').clone();
        }
        if ($(this).is(':last-child')) {
          var next = $(this).parent().find('.views-slideshow-cycle-main-frame-row:first-child .views-field-field-banner-image img').clone();
        } else {
          var next = $(this).next().find('.views-field-field-banner-image img').clone();
        }
        prev.click(function() { $('#views_slideshow_controls_text_previous_banner_carousel-block a').click(); });
        next.click(function() { $('#views_slideshow_controls_text_next_banner_carousel-block a').click(); });
        $(this).append(prev.addClass('prev').attr('title', 'Prev').css('opacity', '0.2'));
        $(this).append(next.addClass('next').attr('title', 'Next').css('opacity', '0.2'));
      });
      $('.views-slideshow-controls-text-pause').addClass('play');
      $('.views-slideshow-controls-text-pause').click(function() {
        if ($(this).find('a').text() == 'Resume') {
          $(this).addClass('play');
        } else {
          $(this).removeClass('play');
        }
      });

      // Ribbon
      $('#block-views-home-content-block .views-field-field-link, #block-views-latest-news-events-block .more-link, .banner-link-wrapper, .media-front .more-link').each(function() {
        $(this).addClass('ribbon');
        $('<div class="ribbon-right"></div>').appendTo($(this));
      });

      // Content block Randomness - (IN PROFILE)
      $('.field-name-field-content-block .field-items').each(function() {
        $(this).children('.field-item').hide();
        var length = $(this).children('.field-item').length;
        var ran = Math.floor(Math.random()*length) + 1;
        $(this).children(".field-item:nth-child(" + ran + ")").show();
      });

        $('#content img').imagesLoaded(setSizes);

    }
  };
})(jQuery);
