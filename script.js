$(document).foundation();

$("a[href^='#']").on('click', function(e) {
   e.preventDefault();
   var hash = this.hash;
   $('html, body').animate({
       scrollTop: $(this.hash).offset().top - $('nav').height() + 1
     }, 500, function(){
     });

});

$(document).ready(function () {
  var navheight = $('nav').height();
  $('#hhome').addClass('active');
  $('#satellite').waypoint(function(direction) {
    if (direction == 'down') {
      $('#hhome').removeClass('active');
      $('#hsatellite').addClass('active');
      document.title = 'Satellites · BLUEsat';
    } else {
      $('#hsatellite').removeClass('active');
      $('#hhome').addClass('active');
      document.title = 'BLUEsat'; 
      }
    }, {offset: navheight});
    $('#robot').waypoint(function(direction) {
      if (direction == 'down') {
        $('#hsatellite').removeClass('active');
        $('#hrobot').addClass('active');
        document.title = 'Robotics · BLUEsat';
      } else {
        $('#hrobot').removeClass('active');
        $('#hsatellite').addClass('active');
        document.title = 'Satellites · BLUEsat'; 
      }
  }, {offset: navheight});
    $('#team').waypoint(function(direction) {
      if (direction == 'down') {
        $('#hrobot').removeClass('active');
        $('#hteam').addClass('active');
        document.title = 'Team · BLUEsat';
      } else {
        $('#hteam').removeClass('active');
        $('#hrobot').addClass('active');
        document.title = 'Robotics · BLUEsat'; 
      }
  }, {offset: navheight});
    $('#sponsors').waypoint(function(direction) {
      if (direction == 'down') {
        $('#hteam').removeClass('active');
        $('#hsponsors').addClass('active');
        document.title = 'Sponsors · BLUEsat';
      } else {
        $('#hsponsors').removeClass('active');
        $('#hteam').addClass('active');
        document.title = 'Team · BLUEsat'; 
      }
  }, {offset: navheight});
    $('#join').waypoint(function(direction) {
      if (direction == 'down') {
        $('#hsponsors').removeClass('active');
        $('#hjoin').addClass('active');
        document.title = 'Join Us · BLUEsat';
      } else {
        $('#hjoin').removeClass('active');
        $('#hsponsors').addClass('active');
        document.title = 'Sponsors · BLUEsat'; 
      }
  }, {offset: navheight});
});

$(window).scroll(function() {
  if($(window).scrollTop() + $(window).height() >= $(document).height()) {
    $('#hcontact').addClass('active');
    $('#hjoin').removeClass('active');
    document.title = 'Contact Us · BLUEsat';
  } else if ($(window).scrollTop() + $(window).height() >= $(document).height() - 15) {
    $('#hjoin').addClass('active');
    document.title = 'Join Us · BLUEsat';
  } else {
    $('#hcontact').removeClass('active');
  }
});

$("section.top-bar-section").css("opacity", 0);
$("section.top-bar-section").css("margin-top", -50)

$(window).scroll(function(){

  var curTop = $(document).scrollTop()
  var curOpacity = $("section.top-bar-section").css("opacity");
  
  if (curTop > 0 && curOpacity == 0) {

    $("section.top-bar-section").animate({
      "opacity": "1",
   "margin-top": "0",
    }, 1000, function() {
      // Animation complete.
    });


  }


});

