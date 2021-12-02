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
<h2><?php echo $results['placeName']; ?></h2>
<h3><?php echo $results['city']; ?>, <?php echo $results['country']; ?></h3>
<div>
<?php
$imgQ = "SELECT image FROM pictures WHERE placeID=" . $results['placeID'];
$s2 = $db->prepare($imgQ);
$s2->execute();
$img = $s2->fetchAll()[0];
$s2->closeCursor();
?>
<img src="place_imgs/<?php echo $img['image']; ?>" alt="interesting" style="width:50%;margin-left:auto;margin-right:auto;display:inherit;">
</div>
<p>
<?php echo $results['description']; ?>
</p>
</div>

</body>
</html>