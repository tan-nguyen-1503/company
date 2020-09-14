<?php
require 'util.php';
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
            <p class="heading"><a href="index.php">BKComputer</a></p>
            <h6 class="sub typed"></h6>
          </div>
        </div>
          <!-- End of Main Slide-->
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
