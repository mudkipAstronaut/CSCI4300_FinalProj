<?php
require('database.php');

$places_place_id = filter_input(INPUT_GET, 'places.placeID',FILTER_VALIDATE_INT);
$wishlist_place_id = filter_input(INPUT_GET, 'wishlist.placeID',FILTER_VALIDATE_INT);

$queryPopular = "SELECT placeName,city,country,reviewScore,COUNT(*) AS Count FROM wishlist,places WHERE places.placeID = wishlist.placeID GROUP BY wishlist.placeID ORDER BY Count DESC LIMIT 5";
$statement1 = $db ->prepare($queryPopular);
$statement1 -> execute();
$popularPlaces = $statement1->fetchAll();
$statement1 -> closeCursor();

$queryHighlyRated = "SELECT placeName,city,country,reviewScore FROM places ORDER BY reviewScore DESC LIMIT 5";
$statement2 = $db ->prepare($queryHighlyRated);
$statement2 -> execute();
$highlyRatedPlaces = $statement2->fetchAll();
$statement2 -> closeCursor();

?>

<!DOCTYPE html> 
<html>
<link rel="stylesheet" href="style.css"/>
<body>
<header>
<?php include('header.php'); ?>
</header>

<!-- Popular Places -->

<div id="popularHeader"> 
	<p> Check out these popular Locations! </p>
</div>

<div class="popular-slideshow-container">

<?php $i = 1; ?>
<?php foreach ($popularPlaces as $popularPlace) : ?>
  <div class="popularPlace fade">
    <div class="numbertext"><?php echo $i; ?> / 5</div>
    <a href=""><img alt="Location" src="place_imgs/london.jpg"></a>
    <div class="popular-locationInfo">
   	  <a href=""><?php echo $popularPlace['placeName']; ?>: <?php echo $popularPlace['city']; ?>, <?php echo $popularPlace['country']; ?> </a> 
	  <div class="popular-addWishlist">
	    Add to Wishlist
	  </div>
	  <div class="popular-rating"> 
	    Rating: <?php echo $popularPlace['reviewScore']; ?>  
		<?php if ($popularPlace['reviewScore'] == NULL) : ?>
		  No Reviews Yet
		<?php endif; ?>
	  </div>
    </div>
  </div>
  <?php $i++; ?>
<?php endforeach; ?>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
</div>

<!-- Highly Rated Places -->

<div id="popularHeader"> 
	<p> Check out these highly rated Locations! </p>
</div>

<div class="popular-slideshow-container">

<?php $i = 1; ?>
<?php foreach ($highlyRatedPlaces as $highlyRatedPlace) : ?>
  <div class="ratedPlace fade">
    <div class="numbertext"><?php echo $i; ?> / 5</div>
    <a href=""><img alt="Location" src="place_imgs/london.jpg"></a>
    <div class="popular-locationInfo">
   	  <a href=""><?php echo $highlyRatedPlace['placeName']; ?>: <?php echo $highlyRatedPlace['city']; ?>, <?php echo $highlyRatedPlace['country']; ?> </a> 
	  <div class="popular-addWishlist">
	    Add to Wishlist
	  </div>
	  <div class="popular-rating"> 
	    Rating: <?php echo $highlyRatedPlace['reviewScore']; ?>  
		<?php if ($highlyRatedPlace['reviewScore'] == NULL) : ?>
		  No Reviews Yet
		<?php endif; ?>
	  </div>
    </div>
  </div>
  <?php $i++; ?>
<?php endforeach; ?>

<a class="prev" onclick="plusSlidesHR(-1)">&#10094;</a>
<a class="next" onclick="plusSlidesHR(1)">&#10095;</a>
</div>

<br>
<div style="text-align:center">
  <span class="dot2" onclick="currentSlideHR(1)"></span> 
  <span class="dot2" onclick="currentSlideHR(2)"></span> 
  <span class="dot2" onclick="currentSlideHR(3)"></span> 
  <span class="dot2" onclick="currentSlideHR(4)"></span> 
  <span class="dot2" onclick="currentSlideHR(5)"></span> 
</div>

<script>

/* For Popular Places */
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("popularPlace");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

/* For Highly Rated Places */
var slideIndexHR = 1;
showSlidesHR(slideIndexHR);

function plusSlidesHR(n) {
  showSlidesHR(slideIndexHR += n);
}

function currentSlideHR(n) {
  showSlidesHR(slideIndexHR = n);
}

function showSlidesHR(n) {
  var i;
  var slides = document.getElementsByClassName("ratedPlace");
  var dots = document.getElementsByClassName("dot2");
  if (n > slides.length) {slideIndexHR = 1}    
  if (n < 1) {slideIndexHR = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndexHR-1].style.display = "block";  
  dots[slideIndexHR-1].className += " active";
}
</script>

</body>
</html>
