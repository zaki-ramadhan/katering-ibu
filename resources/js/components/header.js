// nav for mobile screen

// open header
$("#menu-btn").on("click",function()  {
    $('html, body').animate({ scrollTop: 0 }, 300); // Dengan animasi selama 300ms

    if($(".mobile-nav").hasClass('hidden')){
        $("body").addClass("overflow-hidden");
        $(".mobile-nav").fadeIn("800").removeClass("-top-[100vh]").addClass("top-0");
    }
});

$("#hide-menu-btn").on('click', ()=> {
    $("body").removeClass("overflow-hidden");
    $(".mobile-nav").fadeOut("800").addClass("-top-[100vh]").removeClass("top-0");
})