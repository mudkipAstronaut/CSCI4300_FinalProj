<?php
session_start();
?>
<?php
require('database.php');

$places_place_id = filter_input(INPUT_GET, 'places.placeID',FILTER_VALIDATE_INT);
$wishlist_place_id = filter_input(INPUT_GET, 'wishlist.placeID',FILTER_VALIDATE_INT);
if(isset($_SESSION["loggedin"])) {
  $user_id = $_SESSION["uid"];
}

$queryPopular = "SELECT places.placeID,placeName,city,country,reviewScore,COUNT(*) AS Count FROM wishlist,places,pictures WHERE places.placeID = wishlist.placeID AND pictures.placeID = wishlist.placeID GROUP BY wishlist.placeID ORDER BY Count DESC LIMIT 5";
$statement1 = $db ->prepare($queryPopular);
$statement1 -> execute();
$popularPlaces = $statement1->fetchAll();
$statement1 -> closeCursor();

$queryHighlyRated = "SELECT places.placeID,placeName,city,country,reviewScore FROM places,pictures WHERE places.placeID = pictures.placeID GROUP BY places.placeID ORDER BY reviewScore DESC LIMIT 5";
$statement2 = $db ->prepare($queryHighlyRated);
$statement2 -> execute();
$highlyRatedPlaces = $statement2->fetchAll();
$statement2 -> closeCursor();

$url = "index.php";

?>



<!DOCTYPE html> 
<html>


<style>

body {
	background-image: url("place_imgs/Homepage-background-beach.jpg");
	background-repeat: no-repeat;
	background-size: cover;
	background-color: #cccccc;
}

.testWhite {
	background-color: white;
	width: 800px;
	margin: 0 auto;
	border-radius: 25px;
	border: 2px solid slateblue;
	padding: 10px;
}

</style>


<link rel="stylesheet" href="css/style.css"/>
<body>
<header>
<?php include('header.php'); ?>
</header>

<br>
<div class="testWhite">

<!-- Popular Places -->

<div id="popularHeader"> 
	<p> Check out these popular Locations! </p>
</div>

<div class="popular-slideshow-container">

<?php $i = 1; ?>
<?php foreach ($popularPlaces as $popularPlace) : ?>
<iframe name="content" style="display:none;">
</iframe>
<form method="POST" name="wishlist" action="addToUserWishlist.php" target="content">
  <div class="popularPlace fade">
    
    <div class="numbertext"><?php echo $i; ?> / 5</div>
	<?php
	  require('database.php');
	  
	  $getPlaceImage = "SELECT image,userID FROM pictures WHERE :currentPlace = pictures.placeID GROUP BY pictures.pictureID LIMIT 1";
	  $statement3 = $db ->prepare($getPlaceImage);
	  $statement3->bindValue(':currentPlace', $popularPlace['placeID']);
	  $statement3 -> execute();
	  $placePictures = $statement3->fetchAll();
	  
	  if (count($placePictures)==1) {
	    foreach ($placePictures as $placePicture) {
		  $imagePath = $placePicture['image'];
	    }
	  } else {
		  $imagePath = 'default.jpg';
	  }
	  $statement3 -> closeCursor();
	?>
	
	<a href="<?php echo 'place.php?place=' . $popularPlace['placeID']; ?>"><img alt="Location" src="place_imgs/<?php echo $imagePath; ?>" width="700" height="600"></a>
	
    <div class="popular-locationInfo">
   	  <a href="<?php echo 'place.php?place=' . $popularPlace['placeID']; ?>"><?php echo $popularPlace['placeName']; ?>: <?php echo $popularPlace['city']; ?>, <?php echo $popularPlace['country']; ?> </a> 
	  <?php if(isset($_SESSION["loggedin"])) : ?>		
	    <div class="popular-addWishlist">
		  <input type="hidden" name="placeID" value="<?php echo $popularPlace['placeID']; ?>">
		  <input type="hidden" name="userID" value="<?php echo $user_id; ?>">  
		  <input type="hidden" name="callingURL" value="<?php echo $url; ?>">
		  <input type="submit" value="Add to Wishlist" class="wishlistAddButton">
	    </div>
	  <?php endif; ?>
	  
	  <div class="popular-rating"> 
	    Rating: <?php echo $popularPlace['reviewScore']; ?>  
		<?php if ($popularPlace['reviewScore'] == NULL) : ?>
		  No Ratings Yet
		<?php endif; ?>
	  </div>
    </div>
  </div>
  <?php $i++; ?>
</form>
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
<iframe name="content" style="display:none;">
</iframe>
<form method="POST" name="wishlist" action="addToUserWishlist.php" target="content">
  <div class="ratedPlace fade">
    <div class="numbertext"><?php echo $i; ?> / 5</div>
	
	<?php
	  require('database.php');
	  
	  $getPlaceImage = "SELECT image,userID FROM pictures WHERE :currentPlace = pictures.placeID GROUP BY pictures.pictureID LIMIT 1";
	  $statement4 = $db ->prepare($getPlaceImage);
	  $statement4->bindValue(':currentPlace', $highlyRatedPlace['placeID']);
	  $statement4 -> execute();
	  $placePictures = $statement4->fetchAll();
	  
	  if (count($placePictures)==1) {
	    foreach ($placePictures as $placePicture) {
		  $imagePath = $placePicture['image'];
	    }
	  } else {
		  $imagePath = 'default.jpg';
	  }
	  $statement4 -> closeCursor();
	?>
	
	
    <a href="<?php echo 'place.php?place=' . $highlyRatedPlace['placeID']; ?>"><img alt="Location" src="place_imgs/<?php echo $imagePath; ?>" width="700" height="600"></a>
    <div class="popular-locationInfo">
   	  <a href="<?php echo 'place.php?place=' . $highlyRatedPlace['placeID']; ?>"><?php echo $highlyRatedPlace['placeName']; ?>: <?php echo $highlyRatedPlace['city']; ?>, <?php echo $highlyRatedPlace['country']; ?> </a> 
	  
	  <?php if(isset($_SESSION["loggedin"])) : ?>		
	    <div class="popular-addWishlist">
		  <input type="hidden" name="placeID" value="<?php echo $highlyRatedPlace['placeID']; ?>">
		  <input type="hidden" name="userID" value="<?php echo $user_id; ?>">  
		  <input type="hidden" name="callingURL" value="<?php echo $url; ?>">
		  <input type="submit" value="Add to Wishlist" class="wishlistAddButton">
	    </div>
	  <?php endif; ?>
	  
	  <div class="popular-rating"> 
	    Rating: <?php echo $highlyRatedPlace['reviewScore']; ?>  
		<?php if ($highlyRatedPlace['reviewScore'] == NULL) : ?>
		  No Ratings Yet
		<?php endif; ?>
	  </div>
    </div>
  </div>
  <?php $i++; ?>
</form>
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

</div>

<br>

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
