<?php

$query = "SELECT * FROM reviews WHERE placeID=" . $pid;
$do = $db->prepare($query);
$do->execute();
$reviews = $do->fetchAll();
$do->closeCursor();

if (count($reviews) != 0) {
	$text = "Reviews";
} else $text = "No reviews have been written for this location.";
?>

<style>
#reviewPane {
	background-color: rgb(255, 215, 0);
	padding-top: 10px;
	border: solid slateblue 1.5px;
}

.reviewList {
	padding:0 20px 0 20px;
}

.review {
	border: solid black 1.5px;
	margin-bottom: 10px;
	padding:0 10px 0 10px;
	background-color: #99EEFF;
}

/* button.revBtn {		*/
.revBtn {		
	background-color: #99EEFF;
	border: 1.5px outset slateblue;
	height: 24px;
	margin-left: 12px;
	padding-bottom: 1px;
	padding-top: 0;
    cursor: pointer;
}

/* button.revBtn:hover {	*/
.revBtn:hover {	
	background-color: #BEFFFF;
}

/* button.revBtn:active {	*/
.revBtn:active {	
	background-color: #77DFDF;
}


</style>
<script src="review_manage.js"></script>

<div id="reviewPane">
<div style="display:flex;"> 
	<span style="padding-left:8px;float:left;margin-top:2px;"><?php echo $text; ?></span>
	<button id="addRev" type="button" style="float:left;" class="revBtn" onclick="manageReviewBox()">
	Leave a review</button>
</div>
<ul class="reviewList" id="rlist">
	<?php foreach($reviews as $review) : ?> 
		<?php 
		$query = "SELECT username FROM users WHERE userID=" . $review['userID'];
		$do = $db->prepare($query);
		$do->execute();
		$user = $do->fetchAll()[0];
		$do->closeCursor();
		?>
		<li>
			<div class="review">
				<?php if($review['written'] != '' & $review['written'] != NULL) : ?>					
				<p> <?php echo $user['username']; echo "\tRating: "; echo $review['score']; ?> </p>
				<p> <?php echo $review['written']; ?></p>
				<?php endif; ?>
			</div>
		</li>
	<?php endforeach; ?> 
</ul>
<br/>
</div>