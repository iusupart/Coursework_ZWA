// SLIDER-SCRIPT 
var slider = function() {

	// DELAY OF SLIDE TO NEXT
	var delay = 5000;

	// OTHER
	var numImages = $('.img').length;
	var previousImage = numImages;
	var currentImage = 1;
	var nextImage = 2;
	var previewHover = false;

	// Find width of container div
	var sliderWidth = $("#slider").width() + 2;

	// Give images same width as slider
	var sizeImages = function() {
		$("img").width(sliderWidth);
	};
	sizeImages();

	// CREATE DOT 
	for (var i = 1; i <= numImages; i++) {
		$('#dots').find('ul').append($('<li class="dot ' + i + '"></li>'));
	}

	// POSITION
	var resetImages = function() {
		$('.img').css({"left": sliderWidth+"px"});
		$('.img').first().css({"left": "0px"});
		$('.1').addClass("active");
	};
	resetImages();

	// NEXT IMG
	var slideNextImageLeft = function() {
		$('.image-' + nextImage).css({"left": sliderWidth+"px"});
		$('.image-' + currentImage).animate({left: sliderWidth * -1}, 1000);
		$('.image-' + nextImage).animate({left: "0px"}, 1000);
		currentImage = nextImage;
		increaseImages();
	};

	// PREVIOUS IMG 
	var slidePreviousImageRight = function() {
		$('.image-' + previousImage).css({"left": (sliderWidth * -1)+"px"});
		$('.image-' + currentImage).animate({left: sliderWidth}, 1000);
		$('.image-' + previousImage).animate({left: "0px"}, 1000);
		currentImage = previousImage;
		increaseImages();
	};

	var increaseImages = function() {
		if(currentImage === numImages) {
			nextImage = 1;
			previousImage = currentImage - 1;
		} else {
			nextImage = currentImage + 1;
			if(currentImage === 1) {
				previousImage = numImages;
			} else {
				previousImage = currentImage - 1;
			}
		}
		// DOTS STATUS 
		$('#dots').find('li').removeClass("active");
		$('#dots').find('.' + currentImage).addClass("active");
		
		if(previewHover !== false) {
			showPreview();
		}
	};

	// INTERVAL
	moveImages = setInterval(function() {
		slideNextImageLeft();
	}, delay);

	// THEN CLICK NEXT
	$('.next').click(function() {
		clearInterval(moveImages);
		moveImages = setInterval(function() {
			slideNextImageLeft();
		}, delay);
		slideNextImageLeft();
	});

	// THEN CLICK PREV
	$('.previous').click(function() {
		clearInterval(moveImages);
		moveImages = setInterval(function() {
			slideNextImageLeft();
		}, delay);
		slidePreviousImageRight();
	});

	// DOTS IS CLICKED
	$('.dot').click(function() {
		buttonPressed = $('li').index(this) + 1;
		if(buttonPressed !== currentImage) {
			clearInterval(moveImages);
			moveImages = setInterval(function() {
				slideNextImageLeft();
			}, delay);
			if(currentImage < buttonPressed) {
				nextImage = buttonPressed;
				slideNextImageLeft();
			} else {
				previousImage = buttonPressed;
				slidePreviousImageRight();
			}
		}
	});

	$('.nav').on('mouseenter', function() {
		previewHover = $('.nav').index(this) + 1;
		showPreview();
	}).on('mouseleave', function() {
		previewHover = false;
		$(".preview").css({"background-image": "none"});
	});

	var showPreview = function() {
		var whichSide = previewHover;
		var miniWidth = 100;
		var whichImage;
		if(whichSide === 1) {
			whichImage = previousImage;
		} else {
			whichImage = nextImage;
		}
		var previewImage = $('.image-' + whichImage).find('img').attr("src");
		$(".preview:nth-child(" + whichSide + ")").css({"background-image": "url(" + previewImage + ")", "background-size": "cover"});
	};
};
// THEN FUNCTION IS CLOSED
$(document).ready(function() {

	slider();

});