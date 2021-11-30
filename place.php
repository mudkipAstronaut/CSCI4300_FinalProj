<?php
session_start();
?>
<?php
require('database.php');

$place = $_GET['place'];

//get the place info
$placeQ = "SELECT * FROM places WHERE placeID=" . $place;
$s5 = $db->prepare($placeQ);
$s5->execute();
$results = $s5->fetchAll()[0];
$s5->closeCursor();
?>

<!DOCTYPE html> 
<html>
<link rel="stylesheet" href="style.css"/>
<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="center">
<h2><?php echo $results['placeName']; ?></h2>
<h3><?php echo $results['city']; ?>, <?php echo $results['country']; ?></h3>
<div>
	<img src="place_imgs/london.jpg" alt="interesting"  style="width:50%;margin-left:auto;margin-right:auto;display:inherit;">
</div>
<p>
<?php echo $results['description']; ?>
</p>
</div>

</body>
</html>