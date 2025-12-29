$(function () {
    // nav for mobile screen
    const $mobileNav = $("#mobile-nav");
    const $menuBtn = $("#menu-btn");

    // Toggle dropdown
    $menuBtn.on("click", function (e) {
        e.stopPropagation();
        if ($mobileNav.hasClass('hidden')) {
            $mobileNav.removeClass('hidden').hide().slideDown(300);
        } else {
            $mobileNav.slideToggle(300);
        }
    });

    // Close on link click
    $mobileNav.find('a').on('click', function () {
        $mobileNav.slideUp(300);
    });

    // Close on outside click
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#menu-btn, #mobile-nav').length) {
            $mobileNav.slideUp(300);
        }
    });
});