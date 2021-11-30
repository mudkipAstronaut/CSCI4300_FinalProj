<?php
session_start();
?>
<?php
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
<link rel="stylesheet" href="style.css"/>
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
	  <li><input id="checkbox<?php echo $i; ?>" name="country[]" value="<?php echo $check['country']; ?>" type="checkbox">
	  <label for="checkbox<?php echo $i; ?>">
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
  <div class="pEntry">
    <div>
    <?php
    $imgQ = "SELECT image FROM pictures WHERE placeID=" . $res['placeID'];
    $s2 = $db->prepare($imgQ);
    $s2->execute();
    $img = $s2->fetchAll()[0];
    $s2->closeCursor();
    ?>
      <img src="place_imgs/<?php echo $img['image']; ?>" alt="interesting">
    </div>
    <h2><?php echo$res['placeName']; ?></h2>
    <h3><?php echo $res['city']; ?>, <?php echo $res['country']; ?></h3>
    <p>
     <?php echo $res['description']; ?>
    </p>
  </div>
  </a>
  <?php endforeach; ?>
</div>
</body>
</html>
