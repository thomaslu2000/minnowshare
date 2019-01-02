<?php 
session_start();
include("header.php"); 
?>

<div class="container" align=center>
    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndicators" data-slide-to="1"></li>
        <li data-target="#carouselIndicators" data-slide-to="2"></li>
        <li data-target="#carouselIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="images/welcome.png" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="images/personal.png" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="images/friends.png" alt="Third slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="images/world.png" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>
<div class="container mt-4" align=center>
  <hr>
   <h2>About</h2><br>
   <p>MinnowShare is a small site that lets you upload files and share them with others.</p>
   <br><hr><br>
   <h3>Contact Info</h3>
    <p>Please send all messages to <a href="mailto:info@minnowshare.com">info@minnowshare.com</a></p>
    
</div>
<?php include("footer.php"); ?>
