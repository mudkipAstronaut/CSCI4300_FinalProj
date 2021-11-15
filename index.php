<?php
require('database.php');

$places_place_id = filter_input(INPUT_GET, 'places.placeID',FILTER_VALIDATE_INT);
$wishlist_place_id = filter_input(INPUT_GET, 'wishlist.placeID',FILTER_VALIDATE_INT);

$queryPopular = "SELECT placeName,COUNT(*) AS Count FROM wishlist,places WHERE places.placeID = wishlist.placeID GROUP BY wishlist.placeID ORDER BY Count DESC LIMIT 5";
$statement1 = $db ->prepare($queryPopular);
$statement1 -> bindValue(':places.placeID', $places_place_id);
$statement1 -> bindValue(':wishlist.placeID', $wishlist_place_id);
$statement1 -> execute();
$places = $statement1 -> fetch();
//$place_name = $places['placeName'];
echo $queryPopular;
$statement1 -> closeCursor();

?>

<!DOCTYPE html> 
<html>
<link rel="stylesheet" href="style.css"/>
<body>
<header>
<?php include('header.php'); ?>
</header>

<div id="popularHeader"> 
	<p> Check out these popular Locations! </p>
</div>

<div class="popular-slideshow-container">

<div class="popularPlace fade">
  <div class="numbertext">1 / 3</div>
  <a href=""><img alt="Location" src="place_imgs/london.jpg"></a>
  <div class="popularText">
	<a href=""> City1, Country </a> *****
	Add To Wishlist
  </div>
</div>



<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
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
</script>

</body>
</html>
