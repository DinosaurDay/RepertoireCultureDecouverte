window.onload = function () {
    //Slider 1
    document.querySelector('#carouselExampleSlidesOnly div div').classList.add('active');
    var myCarousel = document.querySelector("#myCarousel");
    var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 20,
    wrap: false,
    });

    //Slider 2
    document.querySelector('#carouselExampleSlidesOnlyBis div div').classList.add('active');
    var myCarousel = document.querySelector("#myCarousel");
    var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 20,
    wrap: false,
    });
};
