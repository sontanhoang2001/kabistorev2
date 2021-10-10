var messageIndex = 0;
function login() {
    $(".icon-google").click(function (e) {
        $("#error-google").show().delay(3000).fadeOut(1000);
    });
    $(".icon-zalo").click(function (e) {
        $("#error-zalo").show().delay(3000).fadeOut(1000);
    });

    $("#username").keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            // username không được bỏ trống
            $("#error-username").show();
        } else {
            data_right = true;

            $("#error-username").fadeOut();
        }
    });

    $("#password").keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            // password không được bỏ trống
            $(this.password1).focus();
            $("#error-password1").show();
        } else {
            data_right = true;

            $("#error-password1").fadeOut();
        }

    });



    $("#f_login").submit(function (e) {
        e.preventDefault();
        var data_right = true;
        if (this.username.value == "") {
            data_right = false;
            // username không được bỏ trống
            $("#error-username").show().delay(3000).fadeOut(1000);
        }
        if (this.password.value == "") {
            data_right = false;
            // password không được bỏ trống
            $("#error-password1").show().delay(3000).fadeOut(1000);
        }
        if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(this.password.value) == false) {
            data_right = false;
            // password sai cú pháp
            $("#error-password2").show().delay(3000).fadeOut(1000);
        }

        var formData = {
            username: this.username.value,
            password: this.password.value
        }

        if (data_right == true) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/login.php",
                dataType: "JSON",
                data: {
                    "formData": formData
                },
                success: function (data) {
                    var res = JSON.parse(JSON.stringify(data))
                    console.log(res.status);
                    var Status = res.status,
                        Url = res.url;
                    switch (Status) {
                        case 0: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu Không được bỏ trống!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 1: {
                            location.href = Url;
                            break;
                        }
                        case 2: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu chưa đúng!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                    }
                },
                error: function () {
                    $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                        $(this).remove();
                    });
                }
            });
            messageIndex++;
        }
    });
}

function register() {
    var data_right = false;

    $("#username").keyup(function () {
        if ($('#username').val() == "") {
            data_right = false;
            // username không được bỏ trống
            $("#error-username1").show();
        } else {
            data_right = true;

            $("#error-username1").fadeOut();
        }
        if (/^[a-z0-9_-]{3,16}$/.test($('#username').val()) == false) {
            data_right = false;
            // username sai cú pháp
            $(this).focus();
            $("#error-username2").show();
        } else {
            data_right = true;

            $("#error-username2").fadeOut();

        }
    });

    $("#password1").keyup(function () {
        if ($('#password1').val() == "") {
            data_right = false;
            // password không được bỏ trống
            $(this.password1).focus();
            $("#error-password1").show();
        } else {
            data_right = true;

            $("#error-password1").fadeOut();
        }
        if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test($('#password1').val()) == false) {
            data_right = false;
            // password sai cú pháp
            $(this).focus();
            $("#error-password2").show();
        } else {
            data_right = true;

            $("#error-password2").fadeOut();

        }

        if ($('#password2').val() != $('#password1').val()) {
            data_right = false;
            // xác nhận password không trùng khớp
            $(this.password1).focus();
            $("#error-password3").show();
        } else {
            data_right = true;

            $("#error-password3").fadeOut();
        }
    });

    $("#password2").keyup(function () {
        if ($('#password2').val() != $('#password1').val()) {
            data_right = false;
            // xác nhận password không trùng khớp
            $(this.password1).focus();
            $("#error-password3").show();
        } else {
            data_right = true;

            $("#error-password3").fadeOut();
        }
    });


    $(".icon-google").click(function (e) {
        $("#error-google").show().delay(5000).fadeOut(1000);
    });
    $(".icon-zalo").click(function (e) {
        $("#error-zalo").show().delay(5000).fadeOut(1000);
    });

    $("#f_register").submit(function (e) {
        e.preventDefault();

        var formData = {
            username: this.username.value,
            password1: this.password1.value,
            password2: this.password2.value
        }

        console.log(data_right);
        if (data_right == true) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/register.php",
                dataType: "JSON",
                data: {
                    "formData": formData
                },
                success: function (data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu Không được bỏ trống!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 1: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-success alert-dismissible fade show mb-1" role="alert">Bạn đã đăng ký tài khoản thành công! <a href="login.html">Đăng nhập ngay</a></div>');
                            $("#error-submit" + messageIndex).show();
                            break;
                        }
                        case 2: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Đăng ký tài khoản không thành công!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 3: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tài khoản này đã tồn tại!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 4: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu nhập lại không chính xác!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 5: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập sai cú pháp!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 6: {
                            $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu sai cú pháp!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                    }
                },
                error: function (data) {
                    $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                        $(this).remove();
                    });
                }
            });
            messageIndex++;
        }
    });
}


//Show password
function showPasswordLogin() {
    var x = document.getElementById("password");
    if (x.type == "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//Show password
function showPasswordRegister() {
    var x = document.getElementById("password1");
    var y = document.getElementById("password2");

    if (x.type == "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    if (y.type == "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}
