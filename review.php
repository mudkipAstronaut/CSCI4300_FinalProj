<?php
$query = "SELECT * FROM reviews WHERE placeID=" . $results['placeID'] . "ORDER BY score";
$do = $db->prepare($query);
$do->execute();
$reviews = $do->fetchAll();
$do->closeCursor();
?>

<div>
<>
<ul>
	<?php foreach($reviews as $review) : ?>
		<li>
			<div>
				
			</div>
		</li>
	<?php endforeach; ?>
</ul>
</div>