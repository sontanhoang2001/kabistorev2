const scriptURL = 'https://script.google.com/macros/s/AKfycbxSL5G-1iFPTQ5kU1A8Y9qYfM7mR5XKulCkWn62xnyPD6gS3eU_cRGJwBhQ1vI2Z0ygDg/exec'
const form = document.forms['google-sheet']

var fullName = "", email = "", title = "", message = "";

$("input[name=name]").keyup(function (e) {
	fullName = $(this).val();
	checkEnable();
});

$("input[name=email]").keyup(function (e) {
	email = $(this).val();
	checkEnable();
});

$("input[name=title]").keyup(function (e) {
	title = $(this).val();
	checkEnable();
});

$("#message").keyup(function (e) {
	message = $(this).val();
	checkEnable();
});

function checkEnable() {
	if (fullName != "" && email != "" && title != "" && message != "") {
		$("#submit").removeAttr("disabled");
	} else {
		$("#submit").attr("disabled", "disabled");
	}
}

form.addEventListener('submit', e => {
	e.preventDefault()
	$("#submit").val("Đang gửi...");
	$("#submit").attr("disabled", "disabled");

	fetch(scriptURL, {
		method: 'POST',
		body: new FormData(form)
	})
		.then(response => successAction())
		.catch(error => console.error('Error!', error.message))
})

function successAction() {
	var message = "Cảm ơn bạn đã gửi phản hồi!";
	let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
	$("#form-message-success").addClass("mb-100");
	$("#googleSheet").remove();
}