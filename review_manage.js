function toggleRevBox(content) {
	let editor = document.getElementById('editor');
	let addRev = document.getElementById('addRev');
	if (editor.style.display == "none") {
		editor.style.display = "block";
		addRev.innerHTML = "Close editor";
	}
	else {
		editor.style.display = "none";
		addRev.innerHTML = content;
	}	
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

function validatePic() {
	let upload = document.getElementById("fileUpload");
	if (upload.value == "" || upload.value == null) return false;
	else return true;
}