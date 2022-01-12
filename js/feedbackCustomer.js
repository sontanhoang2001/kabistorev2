const scriptURL = 'https://script.google.com/macros/s/AKfycbxSL5G-1iFPTQ5kU1A8Y9qYfM7mR5XKulCkWn62xnyPD6gS3eU_cRGJwBhQ1vI2Z0ygDg/exec'
const form = document.forms['google-sheet']

var fullName = "",
    email = "",
    title = "",
    message = "";


$("input[name=name]").keyup(function(e) {
    fullName = $(this).val();
    checkEnable();
});

$('input[name="phone"]').keyup(function() {
    phone = $(this).val();
    if (phone == "") {
        $("#error-phone1").show();
        $("#submit").attr("disabled", "disabled");
    } else {
        $("#error-phone1").fadeOut();
        $("#submit").removeAttr("disabled");
    }

    const regexPhoneNumber = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
    if (phone.match(regexPhoneNumber)) {
        $("#error-phone2").fadeOut();
        checkEnable();
    } else {
        // phone sai cú pháp
        $("#error-phone2").show();
        $("#submit").attr("disabled", "disabled");
    }
});

$('input[name="email"]').keyup(function() {
    email = $(this).val();
    if (email == "") {
        $("#error-email1").show();
        $("#submit").attr("disabled", "disabled");
    } else {
        $("#error-email1").fadeOut();
        $("#submit").removeAttr("disabled");
    }


    const regexPhoneNumber = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/;
    if (email.match(regexPhoneNumber)) {
        checkEnable();
        $("#error-email2").fadeOut();
    } else {
        $("#submit").attr("disabled", "disabled");
        // email sai cú pháp
        $("#error-email2").show();
    }
});


$("input[name=title]").keyup(function(e) {
    title = $(this).val();
    checkEnable();
});

$("#message").keyup(function(e) {
    message = $(this).val();
    checkEnable();
});

function checkEnable() {
    if (fullName != "" && phone != "" && email != "" && title != "" && message != "") {
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