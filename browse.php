<?php
session_start();
?>
<?php
require('database.php');

//get a default value for an empty search
$search = filter_input(INPUT_POST, 'query');
if($search == NULL || $search == FALSE){
$search = 'USA';
}
//Get all places with country
$querySearch = "SELECT * FROM places WHERE country LIKE :search OR city LIKE :search OR placeName LIKE :search";
$s1 = $db->prepare($querySearch);
$s1->bindValue(':search', $search);
$s1->execute();
$results = $s1->fetchAll();
$s1->closeCursor();

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
  <form>
    <div class="filter-block">
      <h5>Checkboxes</h5>
      <div>
	<ul>
	  <li><input id="checkbox1" type="checkbox"><label for="checkbox1">Option 1</label></li>
	  <li><input id="checkbox2" type="checkbox"><label for="checkbox2">Option 2</label></li>
	</ul>
      </div>
    </div>
    
    <div class="filter-block">
      <h5>Select</h5>
      <div>
	<select>
	  <option value="">Choose an option</option>
	  <option value=".option1">Option1</option>
	  <option value=".option2">Option2</option>
	  <option value=".option3">Option3</option>
	</select>
      </div>
    </div>

    <div class="filter-block">
      <h5>Radio</h5>
      <div>
	<ul>
	  <li><input id="radio1" type="radio"><label for="radio1">Option 1</label></li>
	  <li><input id="radio2" type="radio"><label for="radio2">Option 2</label></li>
	</ul>
      </div>
    </div>
  </form>
</div>

<div id="results">
  <?php foreach($results as $res): ?>
  <div class="pEntry">
    <div>
      <img src="place_imgs/london.jpg" alt="interesting">
    </div>
    <h2><?php echo$res['placeName']; ?></h2>
    <h3><?php echo $res['city']; ?>, <?php echo $res['country']; ?></h3>
    <p>
     <?php echo $res['description']; ?>
    </p>
  </div>
  <?php endforeach; ?>
</div>
</body>
</html>
