<!DOCTYPE html>
<html lang="en">


<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Demo styles -->
<style>
  .swiper {
    width: 100%;
    height: 100%;
  }

  .swiper-slide {
    width: 100% !important;
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
  }

  .swiper-wrapper {
    margin-left: 14px;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .swiper-button-prev:after,
  .swiper-rtl .swiper-button-next:after {
    content: '';
  }

  .swiper-button-next:after,
  .swiper-rtl .swiper-button-next:after {
    content: '';
  }

  .swiper:hover {
    cursor: grab;
  }

  .carousel-caption {
    display: flex;
    flex-direction: column;
    justify-content: center;
    top: 0;
    bottom: 0;
  }

  .carousel-caption h2,
  .carousel-caption p.lead {
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 1);
  }

  .carousel-indicators li {
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 100%;
    align-self: center;
    transition: all 0.6s ease-in-out;
  }

  .carousel-indicators li.active {
    width: 1rem;
    height: 1rem;
  }

  .carousel-control-prev,
  .carousel-control-next {
    top: 50%;
    transform: translateY(-50%);
    width: 3rem;
    height: 3rem;
    border: 2px solid #fff;
    border-radius: 100%;
  }

  .carousel-control-prev:hover,
  .carousel-control-next:hover {
    background: #000;
    color: #000;
  }

  /* .swiper-button-next,
    .swiper-rtl .swiper-button-prev {
      right: 28px !important;
    } */

  .swiper-pagination-bullet-active {
    background: #fff !important;
    width: 1rem !important;
    height: 1rem !important;
  }

  .swiper-pagination-bullet {
    width: 0.75rem !important;
    height: 0.75rem !important;
    border-radius: 100% !important;
    align-self: center !important;
    transition: all 0.6s ease-in-out !important;
    background: rgba(255, 255, 255, .5) !important;
  }

  /* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {

    .carousel-control-prev,
    .carousel-control-next {
      border: none;
    }

    .swiper-wrapper {
      height: 36rem;
    }
  }

  @media only screen and (min-height: 700px) {
    .swiper-wrapper {
      height: 39rem;
    }
  }
</style>

<!-- Swiper -->
<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <img class="img-fluid" src="https://scontent.fvca1-2.fna.fbcdn.net/v/t1.6435-9/241359287_106841691739964_7580451974362248265_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=e3f864&_nc_ohc=o9pS8g_yq9kAX8e-4xY&_nc_ht=scontent.fvca1-2.fna&oh=5eab4123b2a80e6e4f970fc6877542cb&oe=616302B3" width="1366" height="768" alt="Second slide">
      <div class="container">
        <div class="carousel-caption text-left">
          <h2 class="display-4 sm-display-4 font-weight-bold">Hãy ở nhà</h2>
          <p class="lead font-weight-bold">Sức khỏe là vàng, ở nhà an toàn cùng Vũng Liêm Now.</p>
          <p><a class="btn btn-lg btn-primary rounded-pill shadow" href="#" role="button">Khám ngay</a></p>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <img class="img-fluid" src="https://source.unsplash.com/random/1366x768?sig=234" width="1366" height="768" alt="Second slide">
      <div class="container">
        <div class="carousel-caption text-left">
          <h2 class="display-4 font-weight-bold">SLIDE TWO</h2>
          <p class="lead font-weight-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <p><a class="btn btn-lg btn-primary rounded-pill shadow" href="#" role="button">Call to Action</a></p>
        </div>
      </div>
    </div>
    <div class="swiper-slide">
      <img class="img-fluid" src="https://source.unsplash.com/random/1366x768?sig=234" width="1366" height="768" alt="Second slide">
      <div class="container">
        <div class="carousel-caption text-left">
          <h2 class="display-4 font-weight-bold">SLIDE TWO</h2>
          <p class="lead font-weight-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <p><a class="btn btn-lg btn-primary rounded-pill shadow" href="#" role="button">Call to Action</a></p>
        </div>
      </div>
    </div>

  </div>
  <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
  <div class="swiper-pagination"></div>

  <a class="swiper-button-prev carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>

  <a class="swiper-button-next carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    speed: 800,
    spaceBetween: 0,
    loop: true,
    centeredSlides: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    keyboard: {
      enabled: true,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>