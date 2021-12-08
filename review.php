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
	background-color: #EEFFFF;
}

/* button.revBtn:active {	*/
.revBtn:active {	
	background-color: #77DFDF;
}


</style>
<script src="review_manage.js"></script>

<div id="reviewPane">

<div style="display:flex;"> 
	<span style="padding-left:8px;float:left;margin-top:2px;margin-left:10px"><?php echo $text; ?></span>
	<!-- Add review button only exists for logged in users -->
	<?php if (isset($_SESSION["loggedin"])) : ?>
	<button id="addRev" type="button" style="float:left;" class="revBtn" onclick="toggleRevBox()">
	Leave a review</button>
	<?php endif; ?>
</div>
<!-- little bit of added security, review editor only exists in DOM if user is logged in-->
<?php if (isset($_SESSION["loggedin"])) : ?>
<div class="review" id="editor" style="margin:1em; display:none;">
	<form action="review_add.php" method="post" onsubmit="return validateReview()">
		<div style="margin-top: 5px;">
			<label style="margin-left: 1em; padding-top: 8px;">Decimal score out of five:
			<input type="number" style="margin-left: 1em; width: 50px;" id="rateNum">
			</label>
		</div>
		<input type="text" id="revText" style="width: 98%; margin: 8px 10px;">
		<input type="submit" class="revBtn" style="margin-bottom: 5px;">
	</form>
</div>
<?php endif; ?>
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