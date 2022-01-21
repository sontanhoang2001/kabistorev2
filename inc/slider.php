<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="../css/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="../css/swiper/swiper.css">

<!-- Demo styles -->

<!-- Swiper -->
<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    $i = 0;
    $show_slider = $product->show_slider();
    if ($show_slider) {
      while ($result = $show_slider->fetch_assoc()) {
        $sliderTitle = $result['sliderTitle'];
        $sliderContent = $result['sliderContent'];
        $slider_image = $result['slider_image'];
        $sliderLink = $result['sliderLink'];
    ?>
        <div class="swiper-slide">
          <?php
          if ($i == 0) {
          ?>
            <img class="img-fluid img-effect" src="upload/slider/<?php echo $slider_image ?>" width="1366" height="768">
          <?php } else {
          ?>
            <img class="img-fluid" src="img/core-img/best-loader.gif" data-src="upload/slider/<?php echo $slider_image ?>" width="1366" height="768" data-status="0">
          <?php
          } ?>
          <?php if ($sliderTitle != null) { ?>
            <div class="carousel-caption text-left">
              <h2 class="display-4 sm-display-4 font-weight-bold"><?php echo $sliderTitle ?></h2>
              <p class="lead font-weight-bold"><?php echo $sliderContent ?></p>
              <p><a class="btn btn-lg btn-primary rounded-pill shadow" href="<?php echo $sliderLink ?>" role="button">Xem ngay</a></p>
            </div>
          <?php } ?>
        </div>
    <?php
        $i++;
      }
    } ?>
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
<script src="../js/swiper/swiper-bundle.min.js"></script>

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