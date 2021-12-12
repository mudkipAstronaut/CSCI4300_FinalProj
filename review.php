<?php
//get reviews for the place
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

.revBtn {		
	background-color: #99EEFF;
	border: 1.5px outset slateblue;
	height: 24px;
	margin-left: 12px;
	padding-bottom: 1px;
	padding-top: 0;
    cursor: pointer;
}

.revBtn:hover {	
	background-color: #EEFFFF;
}

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
	<button id="addRev" type="button" style="float:left;" class="revBtn" onclick="toggleRevBox('Leave a review')">
	Leave a review</button>	
	<form id="delRev" style="float:left; display:none;" action="review_delete.php" method="post">
		<input type="hidden" name="userID" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="placeID" value="<?php echo $place; ?>"/>
		<input type="submit" class="revBtn" value="Delete Review"/>
	</form>
	<?php endif; ?>
</div>

<!-- little bit of added security, review editor only exists in DOM if user is logged in-->
<?php if (isset($_SESSION["loggedin"])) : ?>
<div class="review" id="editor" style="margin:1em; display:none;">
	<form id="revForm" action="review_add.php" method="post" onsubmit="return validateReview()">
		<input type="hidden" name="userID" value="<?php echo $user_id; ?>"/>
		<input type="hidden" name="placeID" value="<?php echo $place; ?>"/>
		<div style="margin-top: 5px;">
			<label style="margin-left: 1em; padding-top: 8px;">Decimal score out of five:
			<input type="number" step="0.1" name="score" style="margin-left: 1em; width: 50px;" id="rateNum">
			</label>
		</div>
		<!-- <input type="text" name="written" id="revText" style="width: 98%; margin: 8px 10px;"/> -->
		<textarea name="written" id="revText" style="width: 1082px;height: 140px;margin: 8px 10px;"></textarea>
		<input value="Post" type="submit" class="revBtn" style="width: 98%; margin-bottom: 5px;"/>
	</form>
</div>
<?php endif; ?>

<ul class="reviewList" id="rlist">
	<?php foreach($reviews as $review) : ?> 
		<?php 
		//check if review is written by current user, and if so change review editor;
		
		//$loggedIn has to be on the left, so that if the user isn't logged in it will 
		//short circuit the AND statement
		$revUser = $review['userID'];
		if ($loggedIn && $revUser == $user_id) : ?>
		<script>
			//change editor button text
			let addRev = document.getElementById('addRev');
			addRev.innerHTML = "Edit Review";
			addRev.setAttribute('onclick', 'toggleRevBox(\'Edit Review\')');
			//change editor action to review_edit.php
			let editor = document.getElementById('editor');
			let form = document.getElementById('revForm');
			form.setAttribute('action','review_edit.php');
			let revText = <?php echo json_encode($review['written']); ?>;
			//display delete-review button
			if(revText != "" && revText != null) {
				document.getElementById('delRev').style.display = "block";
				form.elements[3].innerHTML = revText;				
			}
		</script>
		<?php endif; ?>
		<?php
		//get username for review or leave it as [Deleted]
		$username = "[Deleted]";
		$query = "SELECT username FROM users WHERE userID=" . $review['userID'];
		$do = $db->prepare($query);
		$do->execute();
		$result = $do->fetchAll();
		$do->closeCursor();
		if ($result != null) {
			$username = $result[0]['username'];
		} 
		?>
		<?php if($review['written'] != '' & $review['written'] != NULL) : ?>	
		<li>
			<div class="review">
				<div style="display:flex;width:100%;">
					<p style="float:left;"> <?php echo $username; echo "\tRating: "; echo $review['score']; ?> </p>
					<?php if($loggedIn && $user_id == 1) : ?>
					<form style="float:right;margin-left:12px;" id="delRev" action="review_delete.php" method="post">
						<input type="hidden" name="userID" value="<?php echo $revUser; ?>"/>
						<input type="hidden" name="placeID" value="<?php echo $place; ?>"/>
						<input type="submit" class="deleteProfile" value="Delete Review"/>
					</form>
					<?php endif; ?>				
				</div>
				<p> <?php echo $review['written']; ?></p>
			</div>
		</li>
		<?php endif; ?>
	<?php endforeach; ?> 
</ul>
<br/>
</div>