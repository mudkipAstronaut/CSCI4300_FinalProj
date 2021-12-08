//creates or destroys the review editor
//  div [ 
//  form [ div input submit ] 
//	]
function manageReviewBox() {
	let revPane = document.getElementById('reviewPane');	
	
	if (document.getElementById('editor') == null) {
		//create container div
		let editor = document.createElement('div');
		editor.className = "review";
		editor.id = "editor";
		editor.style.cssText = 'margin:1em;';
		
		//create and set form tag
		let form1 = document.createElement('form');
		form1.setAttribute('action','');		
		form1.setAttribute('onsubmit', 'return validateReview()');
		
		
		//creating elements of the review form
		//numerical rating
		let rate = document.createElement('div');
		rate.style.cssText = "margin-top: 5px;";
		
		let rateLabel = document.createElement('label');
		rateLabel.innerHTML = "Decimal score out of five";
		rateLabel.style.cssText = 'margin-left: 1em;padding-top:8px;';
		
		let rateNum = document.createElement('input');
		rateNum.type = "number";
		rateNum.style.cssText = 'margin-left:1em;width:50px;';
		rateNum.id = "rateNum";
		
		rateLabel.appendChild(rateNum);
		rate.appendChild(rateLabel);
		
		//text of the review, if any
		let text = document.createElement('input');
		text.type = "text";
		text.id = "revText";
		text.style.cssText = 'width:98%;margin:8px 10px;';
		text.placeholder
		
		//submit rating/review
		let submit = document.createElement('input');
		submit.type = "submit";
		submit.className = "revBtn";
		submit.style.cssText = "margin-bottom: 5px;";
		
		//put together review box
		form1.append(rate, text, submit);  //fill form
		editor.appendChild(form1);
		let revList = document.getElementById('rlist');
		revPane.insertBefore(editor, revList);
	} else {	
		revPane.removeChild(document.getElementById('editor'));
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