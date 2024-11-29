// ! logout dropdown
const usernameAdmin = $('.admin-name');
const arrIcon = $('.down-arrow-icon');
const dropdownLogout = $('.dropdown-logout')

// $(arrIcon).on('click', ()=> {
//     alert('ini array icon')
// })

$('.profile-btn').on('click', function(e){
    $(this).toggleClass('ring-thin ring-black')
    $(arrIcon).toggleClass('rotate-180')
    
    if(!$(this).hasClass('bg-slate-200') || !$(usernameAdmin).hasClass('w-20')){
        $(this).addClass('bg-slate-200');
        $(usernameAdmin).removeClass('w-6').addClass('w-20')
    } else {
        $(usernameAdmin).addClass('w-6').removeClass('w-20')
    }
    
    e.stopPropagation();  // Mencegah event bubble ke document
    $(dropdownLogout).toggle();
})

// Menutup dropdown jika klik di luar area dropdown
$(document).on('click', function(e) {
    if (!$(e.target).closest('.dropdown-logout, .profile-btn').length) {
        $(".profile-btn").removeClass('bg-slate-200');
        $(dropdownLogout).hide();
        $(usernameAdmin).addClass('w-6').removeClass('w-20')
    }
});