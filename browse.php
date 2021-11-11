<?php
include('database.php');

//get a default value for an empty search
//$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
//if($category_id == NULL || $category_id == FALSE){
//$category_id = 1;
//}
//Get name for selected category
//$queryCategory = 'SELECT * FROM categories WHERE categoryID=:category_id';
//$statement1 = $db->prepare($queryCategory);
//$statement1->bindValue(':category_id', $category_id);
//$statement1->execute();
//$category = $statement1->fetch();
//$category_name = $category['categoryName'];
//$statement1->closeCursor();

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
  <div class="pEntry">
    <div>
      <img src="place_imgs/london.jpg" alt="interesting">
    </div>
    <h2>City, Country</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Massa tincidunt dui ut ornare. Eu consequat ac felis donec et odio. Nunc non blandit massa enim nec dui. Blandit cursus risus at ultrices mi. Enim diam vulputate ut pharetra sit amet aliquam id. Vitae et leo duis ut diam quam. Mauris vitae ultricies leo integer malesuada nunc vel risus. Orci phasellus egestas tellus rutrum. Nisi quis eleifend quam adipiscing vitae proin sagittis. Sagittis orci a scelerisque purus semper eget duis.</p>
  </div>

  <div class="pEntry">
    <div>
      <img src="place_imgs/london.jpg" alt="interesting">
    </div>
    <h2>City, Country</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Massa tincidunt dui ut ornare. Eu consequat ac felis donec et odio. Nunc non blandit massa enim nec dui. Blandit cursus risus at ultrices mi. Enim diam vulputate ut pharetra sit amet aliquam id. Vitae et leo duis ut diam quam. Mauris vitae ultricies leo integer malesuada nunc vel risus. Orci phasellus egestas tellus rutrum. Nisi quis eleifend quam adipiscing vitae proin sagittis. Sagittis orci a scelerisque purus semper eget duis.</p>
  </div>

  <div class="pEntry">
    <div>
      <img src="place_imgs/london.jpg" alt="interesting">
    </div>
    <h2>City, Country</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl. Massa tincidunt dui ut ornare. Eu consequat ac felis donec et odio. Nunc non blandit massa enim nec dui. Blandit cursus risus at ultrices mi. Enim diam vulputate ut pharetra sit amet aliquam id. Vitae et leo duis ut diam quam. Mauris vitae ultricies leo integer malesuada nunc vel risus. Orci phasellus egestas tellus rutrum. Nisi quis eleifend quam adipiscing vitae proin sagittis. Sagittis orci a scelerisque purus semper eget duis.</p>
  </div>
</div>
</body>
</html>
