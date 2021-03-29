;( function(){

	//Mint drop
	gsap.from( "#mint", {
		y: "-230%",
		scale: 2,
		rotate: -35,
		scrollTrigger: {
			trigger: ".section-2-vid",
			scrub: .5,
			start: "top 50%",
			end: "bottom 50%",
			toggleActions: "restart pause pause reset", // onEnter, onLeave, onEnterBack, onLeaveBack
		}
	});

	//Toggle tin/mint "masks"
	gsap.to(".tin-mask", {
		scrollTrigger: {
			trigger: ".section-2-vid",
			scrub: .5,
			start: "top 500%",
			end: "top 25%",
			toggleClass: { targets: ".tin-mask, #mint",  className: "hide"},
			toggleActions: "restart pause pause reset", // onEnter, onLeave, onEnterBack, onLeaveBack
		}
	});

	//Tin animation
	var frame_count  = 11,
	    offset_value = 300;

	gsap.to(".sequence-wrap", {
	  backgroundPositionX: (-offset_value * frame_count - (.7 * frame_count)) + "px",
	  ease: "steps(" + frame_count + ")",
	  scrollTrigger: {
	    trigger: ".page-section-product",
	    start: "top 85%",
	    end: "top 30%",
	    scrub: true
	  }
	});

})();
