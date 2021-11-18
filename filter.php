<?php
require_once('database.php');

//the search bar query

//get a default value for an empty search
$search = filter_input(INPUT_POST, 'query');
if(!isset($search)){
$search = '';
}

//Get all places with country
$querySearch = "SELECT * FROM places WHERE (country LIKE '%$search%' OR city LIKE '%$search%' OR placeName LIKE '%$search%' OR description LIKE '%$search%')";

//end of search bar query

//the filter query

//get the sortby value
$sort = filter_input(INPUT_POST, 'sort');
if(isset($_POST['country'])){
$countries = $_POST['country'];
}

$conts = '';
if(!empty($countries)):
$conts = "AND country IN ('" . implode("','", $countries) . "')";
endif;

$ord = '';
if($sort == '.option1'):
$ord = "ORDER BY reviewScore DESC";
elseif($sort == '.option2'):
$ord = "ORDER BY reviewScore ASC";
endif;

//end of filter query

$filQuery = $querySearch . " " . $conts . " " . $ord;
$s3 = $db->prepare($filQuery);
$s3->execute();
$results = $s3->fetchAll();
$s3->closeCursor();

?>