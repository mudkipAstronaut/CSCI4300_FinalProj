<?php

//=========================
//update score 
//=========================

//code to get average and update place review score
$query = "SELECT AVG(score) AS average FROM reviews WHERE placeID = ".$place_id;
// $result = $db->prepare($query);
$result = $db->query($query);
// $statement->bindValue(':place_id', $place_id);
$result->execute();
$avgScore = $result->fetchAll()[0]['average'];
$result->closeCursor();
// echo $avgScore[0];
// $avgScore = $result->fetch_assoc();//->fetchAll()[0];

//update place review score
if(!empty($avgScore)) {
$update = "UPDATE places SET reviewScore = ".$avgScore." WHERE places.placeID = ".$place_id;
$statement = $db->prepare($update);
// $statement->bindValue(':place_id', $place_id);
$statement->execute();
}
?>  
