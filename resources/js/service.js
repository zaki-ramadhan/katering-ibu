// data yang bakal dipake sesuaui index order-number
const serviceItems = {
    delivery: {
        title: "Layanan Antar Makanan",
        imagesrc: "delivery.svg",
        detail: "Kami menyediakan layanan antar makanan yang cepat dan tepat waktu untuk memastikan hidangan Anda sampai dalam kondisi terbaik. Baik untuk acara kecil maupun besar, kami siap mengantar pesanan langsung ke tempat Anda, memastikan makanan tetap segar dan hangat.",
    },
    event: {
        title: "Paket Katering untuk Acara Khusus",
        imagesrc: "event-2.svg",
        detail: "Tersedia paket katering untuk acara khusus seperti pernikahan, ulang tahun, acara kantor, dan lain-lain. Kami menyediakan berbagai pilihan menu yang dapat disesuaikan dengan kebutuhan acara Anda, sehingga setiap momen spesial menjadi lebih berkesan dengan sajian yang lezat.",
    },
    order: {
        title: "Pesanan Sesuka Hati",
        imagesrc: "order.svg",
        detail: "Kami juga menawarkan pesanan custom di mana Anda dapat menyesuaikan menu sesuai dengan selera dan kebutuhan. Apakah Anda menginginkan menu vegetarian, bebas gluten, atau spesifikasi diet lainnya, kami siap untuk menghadirkan hidangan yang sesuai dengan preferensi Anda.",
    }
}

// order number menyesuaikan dengan index mana yang di klik
$(".service-item").on('click', function() {
    // alert('test')
    const indexSelected = $(this).data("index");
    
    // data orderGuide akan ditampilkan sesuai index nomor brp yang akan diklik
    if(serviceItems[indexSelected]) {
        $(".head-detail").text(serviceItems[indexSelected].title);
        $(".detail-service").text(serviceItems[indexSelected].detail);

        const pathDirection = "../../images/"
        $(".service-img").attr('src', `${pathDirection}${serviceItems[indexSelected].imagesrc}`)
    }
})

// scroll button to top
$('.btn-scroll-top').on('click',()=> {
    $('html, body').animate({ scrollTop: 0 }, 600); // Atur kecepatan scroll
    return false; // Mencegah perilaku default dari tombol
});