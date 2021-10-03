<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<!-- Demo styles -->
<style>
  /* Extra small devices (phones, 600px and down) */
  @media only screen and (max-width: 600px) {
    .swiper-container {
        width: 100%;
        height: 165px;
        margin-top: 4.2em;
        margin-left: auto;
        margin-right: auto;
    }
  }

  /* Small devices (portrait tablets and large phones, 600px and up) */
  @media only screen and (min-width: 600px) {
    .swiper-container {
        width: 100%;
        height: auto;
        margin-top: 4.2em;
        margin-left: auto;
        margin-right: auto;
    }
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    margin-left: 0;
    margin-right: 0;

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
</style>

<!-- Swiper -->
<div class="swiper-container">
  <div class="swiper-wrapper">
    <?php
    $get_slider = $product->show_slider();
    if ($get_slider) {
      while ($result_slider = $get_slider->fetch_assoc()) {
    ?>
        <div class="swiper-slide"><img class="d-block w-100 swiper-slide" src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="First slide"></div>
    <?php
      }
    }
    ?>
  </div>
  <!-- Add Pagination -->
  <!-- <div class="swiper-pagination"></div> -->

  <!-- Add Arrows -->
  <!-- <div class="swiper-button-next d-none d-md-block"></div>
  <div class="swiper-button-prev d-none d-md-block"></div> -->
</div>



<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    // navigation: {
    //   nextEl: '.swiper-button-next',
    //   prevEl: '.swiper-button-prev',
    // },
    autoplay: {
      delay: 3500,
    },
  });
</script>