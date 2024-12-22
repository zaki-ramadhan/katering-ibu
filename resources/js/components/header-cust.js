// ! logout dropdown
const usernameCust = $('.cust-name');
const arrIcon = $('.down-arrow-icon');
const dropdownLogout = $('.dropdown-logout')

// $(arrIcon).on('click', ()=> {
//     alert('ini array icon')
// })

$('.profile-btn').on('click', function(e){
    $(this).toggleClass('ring-thin ring-black')
    $(arrIcon).toggleClass('rotate-180')
    
    if(!$(this).hasClass('bg-slate-100') || !$(usernameCust).hasClass('w-20')){
        $(this).addClass('bg-slate-100');
        $(usernameCust).removeClass('w-6').addClass('w-20')
    } else {
        $(usernameCust).addClass('w-6').removeClass('w-20')
    }
    
    e.stopPropagation();  // Mencegah event bubble ke document
    $(dropdownLogout).toggle();
})

// Menutup dropdown jika klik di luar area dropdown
$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown-logout, .profile-btn').length) {
        $(".profile-btn").removeClass('bg-slate-100');
        $(dropdownLogout).hide();
        $(usernameCust).addClass('w-6').removeClass('w-20')
    }
});