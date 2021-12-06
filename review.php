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
	background-color: #BEFFFF;
}

button.addReview:active {	
	background-color: #77DFDF;
}


</style>
<script>
function createReviewBox() {
	let div = document.createElement('div');
	div.className = "review";
	div.style.cssText = 'margin:1em;';
	let form = document.createElement('form');
	
	//creating elements of the review form
	//numerical rating
	let rateLabel = document.createElement('label');
	rateLabel.innerHTML = "Decimal score out of five";
	rateLabel.style.cssText = 'margin-left: 1em;padding-top:8px;';
	let rateText = document.createElement('input');
	rateText.style.cssText = 'margin-left:1em;width:30px;';
	rateLabel.appendChild(rateText);
	//text of the review, if any
	let text = document.createElement('input');
	text.type = "text";
	text.style.cssText = 'width:98%;margin:8px 10px;';
	//submit rating/review
	let submit = document.createElement('input');
	submit.type = "submit";
	
	form.append(rateLabel, text);
	div.appendChild(form);
	let revList = document.getElementById('rlist');
	document.getElementsByClassName('reviewBox')[0].insertBefore(div, revList);
}
</script>

<div class="reviewBox">
<div style="display:flex;"> 
	<span style="padding-left:8px;float:left;margin-top:2px;"><?php echo $text; ?></span>
	<button id="addRev" type="button" style="float:left;" class="addReview" onclick="createReviewBox()">
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