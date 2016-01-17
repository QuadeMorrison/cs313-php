$(document).ready(function() {
	var mintGreen = "#3FAC9E";

	$(".navbar-brand").hover(
		function() {
			$("#brandFirst, #brandSecond").css("color", "#AAA");
		}, function() {
			$("#brandFirst, #brandSecond").css("color", "#DDD");
		}
	);

	carouselGlyphColor("left", mintGreen);
	carouselGlyphColor("right", mintGreen);
})

function carouselGlyphColor(direction, color) {
	$(".carousel-control." + direction).hover(
		function() {
			$(".glyphicon-chevron-" + direction).css("color", color);
		}, function() {
			$(".glyphicon").css("color", "#444");
		}
	);
}