<?php
session_start();
?>
<?php
if(isset($_SESSION["loggedin"])) {
  $user_id = $_SESSION["uid"];
}

require('database.php');

include('filter.php');

//get countries for the checkboxes
$counts = "SELECT DISTINCT country FROM places";
$s2 = $db->prepare($counts);
$s2->execute();
$checks = $s2->fetchAll();
$s2->closeCursor();
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
<div id="filters">
  <h3>Filters</h3>
  <form method="POST" name="filters" action="browse.php">
    <hr>
     <div class="filter-block">
      <h5>Sort By</h5>
      <div>
	<select name="sort">
	  <option value="">Choose an option</option>
	  <option value=".option1">Ranked: High to Low</option>
	  <option value=".option2">Ranked: Low to High</option>
	</select>
      </div>
    </div>
    <hr>
    <div class="filter-block">
      <h5>Countries</h5>
      <div>
	<ul>
	<?php
	$i=1;
	foreach($checks as $check): ?>
	  <li>
	  <input id="checkbox<?php echo $i; ?>" name="country[]" value="<?php echo $check['country']; ?>" type="checkbox">
	  <label id="countryLabel" for="checkbox<?php echo $i; ?>">
	  <?php echo $check['country']; ?>
	  </label>
	  </li>
	<?php
	$i++;
	endforeach; ?>
	</ul>
      </div>
    </div>
    <input type="submit" value="Apply Changes">
    <input type="hidden" name="query" value="<?php echo $search; ?>">
  </form>
</div>

<div id="results">
  <?php foreach($results as $res): ?>
  <a href="<?php echo 'place.php?place=' . $res['placeID']; ?>" class="pEntry">
  <div>
    <iframe name="content" style="display:none;">
    </iframe>
    <form method="POST" name="wishlist" action="addToUserWishlist.php" target="content">
    <div>
    <?php
    $imgQ = "SELECT image FROM pictures WHERE placeID=" . $res['placeID'];
    $s2 = $db->prepare($imgQ);
    $s2->execute();
	$img = $s2->fetchAll();
	if (count($img) != 0) {
		$imgPath = $img[0]['image'];
	}
	else $imgPath = 'default.jpg';
    $s2->closeCursor();
    ?>
    <img src="place_imgs/<?php echo $imgPath; ?>" alt="interesting">
    </div>
    <h2><?php echo $res['placeName']; ?>: <?php echo $res['city']; ?>, <?php echo $res['country']; ?></h2>
    <p>
     <?php echo $res['description']; ?>
    </p>
    <?php if(!empty($user_id)) : ?>	
        <div class="popular-addWishlist">
		  <input type="hidden" name="placeID" value="<?php echo $res['placeID']; ?>">
		  <input type="hidden" name="userID" value="<?php echo $user_id; ?>">  
		  <input type="submit" value="Add to Wishlist" class="wishlistAddButton">
		</div>
		<?php if($user_id == 1) : ?>
			<!-- Delete place button -->
		<?php endif; ?>
    <?php endif; ?>
    </form>
  </div>
  </a>
  <?php endforeach; ?>
</div>
</body>
</html>
