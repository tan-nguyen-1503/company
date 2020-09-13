<?php
require './LayOut/header.php'
?>
  <div>
    <div class="overlay"></div>
    <div id="carouselSlide" class="carousel slide" data-ride="carousel" data-interval = "4000">
      <ol class="carousel-indicators">
        <li data-target="#carouselSlide" data-slide-to="0" class="active"></li>
        <li data-target="#carouselSlide" data-slide-to="1"></li>
        <li data-target="#carouselSlide" data-slide-to="2"></li>
        <li data-target="#carouselSlide" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <!--Main Slide-->
        <div class="carousel-item active" >
          <img class= "w-100"   src="./Public/images/Homepage/slide1.jpg" alt="HomeSlide">
          <div class="carousel-caption text-center">
            <p class="heading"><a href="index.html">BKComputer</a></p>
            <h6 class="sub typed"></h6>
          </div>
        </div>
          <!-- End of Main Slide-->
          <!--Slide sp1-->
        <div class="carousel-item">
          <img class= "w-100 "   src="./Public/images/Homepage/2018-macbook-pro.jpg" alt="HomeSlide">
          <div class="carousel-caption text-center">
            <p>MacBook Pro 2019</p>
            <h4>More power.More performance.More pro.</h4>
            <a href="laptop.php" class="btn btn-outline-light btn-lg">Buy Now</a>
          </div>
        </div>
          <!--  Slide sp1-->
          <!--Slide sp2-->
        <div class="carousel-item">
          <img class= "w-100"   src="./Public/images/Homepage/iMac.jpg" alt="HomeSlide">
          <div class="carousel-caption text-center">
            <p>iMac 2019</p>
            <h4>Pretty. Freaking powerful.</h4>
            <a href="laptop.php" class="btn btn-outline-light btn-lg">Buy Now</a>
          </div>
        </div>
          <!-- End of Slide sp2-->
          <!--Slide sp2-->
        <div class="carousel-item">
            <img class= "w-100"   src="./Public/images/Homepage/Slide5.jpg" alt="HomeSlide">
            <div class="carousel-caption text-center">
              <p>Beats Solo Headphones</p>
              <h4>More Matte Collection</h4>
              <a href="accessories.php" class="btn btn-outline-light btn-lg">Buy Now</a>
            </div>
          </div>
            <!-- End of Slide sp2-->
      </div>
      <!-- Button next and prev -->
      <a class="carousel-control-prev" href="#carouselSlide" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#carouselSlide" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </a>
        <!-- End of Button next and prev -->
    </div>
  </div>
    <!--End of Slide-->
<?php
require './LayOut/footer.php'
?>
