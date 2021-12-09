<?php
session_start();
?>
<?php 
if(isset($_SESSION["loggedin"])) {
  $user_id = $_SESSION["uid"];
}

require('database.php');

$place = $_GET['place'];

//get the place info
try {
	$placeQ = "SELECT * FROM places WHERE placeID=" . $place;
	$s5 = $db->prepare($placeQ);
	$s5->execute();
	$results = $s5->fetchAll()[0];
	$s5->closeCursor();
} catch (PDOException $ex) {
	if(!isset($_GET['logout'])) {
		throw $ex;
	}
	echo $ex->getMessage();
}

//saving placeID for review.php
$pid = $results['placeID'];
?>

<!DOCTYPE html> 
<html>
<head>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="center">
<h2 style="text-decoration:underline;"><?php echo $results['placeName']; ?>: <?php echo $results['city']; ?>, <?php echo $results['country']; ?></h2>
<p>
<?php
$userId = $results['userID'];
if($userId < 1){
$userId = 1;
}
$userQ = 'SELECT username FROM users WHERE userID='. $userId .' LIMIT 1';
$s1 = $db->prepare($userQ);
$s1->execute();
$username = $s1->fetchAll()[0];
$s1->closeCursor();

echo 'Added by '. $username[0];
?></p>

<div class="slideshow-container">

<?php
$imgQ = "SELECT image, userID FROM pictures WHERE placeID=" . $results['placeID'];
$s2 = $db->prepare($imgQ);
$s2->execute();
$images = $s2->fetchAll();
$s2->closeCursor();

$numImg = count($images);
$counter=1;
?>

<!-- image container won't show if there are no images -->
<?php if(!empty($img['image'])) : ?>

<?php
foreach($images as $img): ?>
<div class="mySlides fade">

     <div class="numbertext"><?php echo $counter.'/'.$numImg; ?></div>
     <img src="place_imgs/<?php 
     	  $imgPath = $img['image'];
	  if(empty($imgPath)){
	  $imgPath = 'default.jpg';
	  }
	  echo $imgPath; 
	  ?>" alt="interesting" style="width:100%;">
	  
      <div class="text">
      <?php
      $userQ = 'SELECT username FROM users WHERE userID='. $img['userID'] .' LIMIT 1';
      $s2 = $db->prepare($userQ);
      $s2->execute();
      $username = $s2->fetchAll()[0];
      $s2->closeCursor();

      echo 'Added by '. $username[0];
      ?>
      </div>
</div>

<?php
$counter++;
endforeach;

if(empty($images)){
echo '
<div class="mySlides fade">
<div class="numbertext">1/1</div>
<img src="place_imgs/default.jpg" alt="interesting" style="width:100%;">
<div class="text">Added by Admin</div>
</div>';
}
?>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

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
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  
}
</script>
<?php endif; ?>
</div>
<h4>Rating: <?php
if(!is_null($results['reviewScore'])){
echo $results['reviewScore'];
}
else{
echo 'No ratings yet';
}
?></h4>
<p>
<?php echo $results['description']; ?>
</p>

<?php include('review.php'); ?>

</div>
</body>
</html>