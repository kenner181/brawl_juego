// ********************************** //
//              CARRUSEL              //
// ********************************** //

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 80,
    grabCursor: true,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    speed: 800,
    breakpoints: {
        991: {
            slidesPerView: 3
        }
    }
});
