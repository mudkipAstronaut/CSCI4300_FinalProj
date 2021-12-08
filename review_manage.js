function toggleRevBox() {
	let editor = document.getElementById('editor');
	if (editor.style.display == "none") 
		editor.style.display = "block";
	else editor.style.display = "none";
}

function validateReview() {
	let editor = document.getElementById('editor');
	let form1 = editor.firstChild;
	let rating = document.getElementById('rateNum');
	let review = form1.elements['revText'];
	if ((rating.value == null || rating.value == '') && 
	(review.value == null || review.value == '')) {
		return false;
	} else if (rating.value > 5 || rating.value < 0) {
		return false;
	}
	return true;	
}