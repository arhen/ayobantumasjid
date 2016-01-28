$(document).ready(function() {



//LIST OF FUNCTIONS
function print(text) {

console.log(text);

}//end of function log



function makeFullHeightSection(obj) {
print(obj.outerHeight());
print("browser height " + $(window).height());
//print('browser ' + $(window).height());
if ($(window).height() > obj.outerHeight()) {

obj.css("height",$(window).height());
obj.children(".container").css("transform","translateY(-50%)");
//print('after resizing ' + obj.outerHeight());

} else {

obj.css("height","auto");

}

}// end of function full height



//OFF CONDITION FOR MOBILE DEFAULT CHECK
var fullHeight = true;
// if (window.screen.width < 1024) {

// print('small browser width : ' + $(window).width());
// print('document : ' + $(document).width());
// print('screen : ' + window.screen.width);
// fullHeight = false;

// } else {

// print('large browser width : ' + $(window).width());
// print('document : ' + $(document).width());
// print('screen : ' + window.screen.width);
// fullHeight = true;

// }


//ONREADY CALL
$('.full-height-section').each(function() {
if (fullHeight) {

//print($(this).height());
makeFullHeightSection($(this));

}
});//end of onload full-section-height check



//ONCLICK CALL
$('.ut-nav-tabs li a').click(function() {
if (fullHeight) {

//print('before delay ' + $(this).parents('.full-height-section').outerHeight());
var that = $(this);
setTimeout(function() {

that.parents('.full-height-section').css("height","auto");
//print('after delay ' + that.parents('.full-height-section').outerHeight());
makeFullHeightSection(that.parents('.full-height-section'));

}, 500);

}
});//end of ut-nav-tabs click full-section-height check



//STICKY FLOATING NAV TO LOWERCASE AND CAPITALIZE
//print($("ul.sticky-bar li").length);
$("ul.sticky-bar li").each(function(){

$(this).html($(this).html().toLowerCase());
$(this).css("text-transform","capitalize");

});



//HISTORY YEAR COLOR
print($("#history .year a").length);
$("#history .year a").each(function() {

//NOT USED DUE TO HOVER ISSUE
//$(this).css("color","#04748c");

});

});//end of ready