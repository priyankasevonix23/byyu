
$(window).scroll(function() {    
  var scroll = $(window).scrollTop();


if (scroll >= 1) {
    $(".need_hidebox").addClass("no_box");
} 
else {
    $(".need_hidebox").removeClass("no_box");
}
if (scroll >= 1) {
    $(".need_showbox").addClass("yes_box");
} 
else {
    $(".need_showbox").removeClass("yes_box");
}


});
