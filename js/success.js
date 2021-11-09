$(document).ready(function () {
    audioSuccess.play();
    $(".number_cart").html("0");;
    $.ajax({
        async: true,
        type: "POST",
        url: "callbackPartial/newOrderNotification.php",
        dataType: 'json',
        data: {},
        success: function (data) {
            console.log(data);
        }, error: function (data) {
            console.log(data);
        }
    })
});