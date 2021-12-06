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
.reviewBox {
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

button.addReview {		
	background-color: #99EEFF;
	border: 1.5px outset slateblue;
	height: 24px;
	margin-left: 12px;
	padding-bottom: 1px;
	padding-top: 0;
    cursor: pointer;
}

button.addReview:hover {	
	// background-color: rgb(255, 245, 0);
	// background-color: #BEFFFF;
}
</style>

<script>
function createReviewBox() {
	var li = document.CreateElement('li');
	var form = document.CreateElement('form');
	var text = document.CreateElement('input');
	text.type = "text";
	form.appendChild('text');
	li.appendChild('form');
	document.GetElementById('rlist').appendChild('li');
}
</script>

<div class="reviewBox">
<div style="display:flex;"> 
	<span style="padding-left:8px;float:left;margin-top:2px;"><?php echo $text; ?></span>
	<form>
	<button type="button" style="float:left;" class="addReview" onclick="createReviewBox();">Leave a review</button>
	</form>
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