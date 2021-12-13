<?php
session_start();
?>
<?php 
//create session variables
if(isset($_SESSION["loggedin"])) {
  $user_id = $_SESSION["uid"];
}
$loggedIn = isset($user_id);


require('database.php');

$place = $_GET['place'];

//get the place info
try {
	$placeQ = "SELECT * FROM places WHERE placeID=" . $place;
	$s5 = $db->prepare($placeQ);
	$s5->execute();
	$results = $s5->fetchAll();	
	$s5->closeCursor();
	if ($results == null) {
		header('location: place_404.php');
	} else $results = $results[0];
} catch (PDOException $ex) {
	if(!isset($_GET['logout'])) {
		throw $ex;
	}
	echo $ex->getMessage();
}

//if this page was reached via the addPic button, it will run picture_add
if($_SERVER["REQUEST_METHOD"] == "POST") {	
	// $name needs to be set for picture_add 
	$name = $results['placeName'];
	$sessionid = $user_id;
	include('picture_add.php');
}

//saving placeID for review.php
$pid = $results['placeID'];
?>

<!DOCTYPE html> 
<html>
<head>
<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="center">
<h2 style="text-decoration:underline;"><?php echo $results['placeName']; ?>: <?php echo $results['city']; ?>, <?php echo $results['country']; ?></h2>
<p>
<?php
$poster = $results['userID'];
if($poster < 1){
$poster = 1;
}
$userQ = 'SELECT username FROM users WHERE userID='. $poster .' LIMIT 1';
$s1 = $db->prepare($userQ);
$s1->execute();
$username = $s1->fetchAll()[0];
$s1->closeCursor();
if(!empty($username)){
echo 'Added by '. $username[0];
}
else{
echo 'Added by [Deleted]';
}
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
	<?php if(!empty($images[0]['image'])) : ?>

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
		  <p>
		  <?php
		  $userQ = 'SELECT username FROM users WHERE userID='. $img['userID'] .' LIMIT 1';
		  $s2 = $db->prepare($userQ);
		  $s2->execute();
		  $username = $s2->fetchAll()[0];
		  $s2->closeCursor();

		  
		  if(!empty($username)){
		  echo 'Added by '. $username[0];
		  }
		  else{
		  echo 'Added by [Deleted]';
		  }
		  ?>
		  </p>
		  <?php if ($loggedIn && $user_id == $img['userID']) : ?>
		  <div style="display:inline-block;">
			 <a href="<?php echo 'picture_del.php?place='.$place.'&image='.$img['image']; ?>" class="deleteProfile" style="margin-left: 4px;margin-top: 0px;">Delete</a>
		  </div>
		  <?php endif; ?>
		  </div>
	</div>

	<?php
	$counter++;
	endforeach;
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

<!-- display review score -->
<h4>Rating: <?php
	if(!is_null($results['reviewScore'])){
	echo $results['reviewScore'];
	}
	else{
	echo 'No ratings yet';
	}
?></h4>

<!-- add image form -->
<?php if($loggedIn) : ?>
	<label>Add an image
		<form method="post" action="<?php echo "place.php?place=".$place;?>" 
			enctype="multipart/form-data" onsubmit="return validatePic()">
			<input type="file" name="fileUpload" id="fileUpload" value="" class="loginInput" style="margin: 4px 0;"/>
			<input type="submit" class="wishlistAddButton" value="Add Picture" id="submit" style="margin: 4px 0;"/>
		</form>
	</label>
<?php endif; ?>

<!-- description -->
<p>
	<?php echo $results['description']; ?>
</p>

<?php include('review.php'); ?>

<?php if($loggedIn && $user_id == 1){ ?>
<div style="display:inline-block;">
<a href="<?php echo 'deletePlace.php?place='.$place; ?>" class="deleteProfile" style="margin-top:2em;">Delete Place</a>
</div>
<?php } ?>
</div>
</body>
</html>