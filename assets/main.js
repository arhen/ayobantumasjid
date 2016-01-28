$(document).ready(function(){

	//Functions
	function clearActiveNav() {
		$('nav ul#nav-desktop li a').each(function() {
			$(this).removeClass('active');
		});

		$('nav ul#nav-mobile li a').each(function() {
			$(this).removeClass('active');
		});
	}

	// MaterializeCSS' Sidebar
	$(".button-collapse").sideNav();

	// MaterializeCSS' Fullwidth Slider
	$('.slider').slider({full_width: true});

	// MaterializeCSS' Form Select Dropdown
    $('select').material_select();


	// Smooth Scrolling
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});

	// Active Menu On Scroll
	var doc = $(document);
	// doc.scroll(function() {
	// 	if (doc.scrollTop() < $('#section2-about').offset().top - 250) {
	// 		//Landing Section - Clear active only
	// 		clearActiveNav();

	// 	} else if (doc.scrollTop() < $('#section3-services').offset().top - 250) {
	// 		//About Section - Clear active and set About section to active
	// 		clearActiveNav();
	// 		$('nav ul#nav-desktop li a[href=#about]').addClass('active');
	// 		$('nav ul#nav-mobile li a[href=#about]').addClass('active');

	// 	} else if (doc.scrollTop() < $('#section4-works').offset().top - 250) {
	// 		//Services Section - Clear active and set About section to active
	// 		clearActiveNav();
	// 		$('nav ul#nav-desktop li a[href=#services]').addClass('active');
	// 		$('nav ul#nav-mobile li a[href=#services]').addClass('active');

	// 	} else if (doc.scrollTop() < $('#section7-contact').offset().top - 250) {
	// 		//Works Section - Clear active and set About section to active
	// 		clearActiveNav();
	// 		$('nav ul#nav-desktop li a[href=#works]').addClass('active');
	// 		$('nav ul#nav-mobile li a[href=#works]').addClass('active');

	// 	} else {
	// 		//Contact Section - Clear active and set About section to active
	// 		clearActiveNav();
	// 		$('nav ul#nav-desktop li a[href=#contact]').addClass('active');
	// 		$('nav ul#nav-mobile li a[href=#contact]').addClass('active');

	// 	}
	// });

	// Progress Bar Generator
	var progressBarWidth = $(".progress-value").html();
	if (progressBarWidth > 100 ) {
		progressBarWidth = 100;
	} else  if (progressBarWidth < 0) {
		progressBarWidth = 0;
	}
	$(".progress-bar").css("width", progressBarWidth + "%");
});

