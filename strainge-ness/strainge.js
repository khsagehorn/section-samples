// Establish html data attibute that can be accessed via CSS for homepage nav behaviors
$(function(){
    var hero = $('.mx-intro-sec');
    if (hero){
        var menu = $('.main-header');
        var subNav = $('.dropdown-menu');
	    // set a 'scroll' data attribute on the html tag
	document.documentElement.dataset.scroll = 0;
	document.addEventListener('scroll', function(event){
	    document.documentElement.dataset.scroll = window.scrollY;
	});

	document.body.addEventListener("mousemove", function(event) {
        //Check if we are in the top area of the page, or if we've moved but the sub-menu is still active.
        if(event.pageY < 90 || subNav.hasClass('show')) {
	    menu.addClass('show');
        } else {
	    menu.removeClass('show');
      }
   });
  }
});

// Play footer vine animation when in view
$(function(){
    /* !----------------- SCROLL MAGIC ------------------! */
    var controller = new ScrollMagic.Controller();
    $('.main-footer').each(function(){
        var thisTrigger = $(this).find('.sec-trigger');
        var video = $('#footer-vines');

        var scenefooter = new ScrollMagic.Scene({ triggerElement: this})
        .setClassToggle(this, "in-view")
        .reverse(false)
        .addTo(controller)
        .on("enter", function(){
            video[0].play();
        });
    });
});


// accordion handler
if ($('.mx-accordion-content').length){
    $('.accordion-title').on('click', function(){
        if(!($(this).parent().hasClass('active'))){
	    $('.accordion').removeClass('active');
	    $(this).parent().addClass('active');
	} else { $('.accordion').removeClass('active'); }
    });
}
