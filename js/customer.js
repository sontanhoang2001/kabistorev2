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


function updateProfile() {
    var data_right = true;

    $('input[name="fullName"]').keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            // fullName không được bỏ trống
            $("#error-fullname").show();
        } else {
            data_right = true;
            $("#error-fullname").fadeOut();
        }
    });

    $('input[name="phone"]').keyup(function () {
        if ($(this).val() == "" || $(this).val() == 0) {
            data_right = false;
            $("#error-phone1").show();
        } else {
            data_right = true;
            $("#error-phone1").fadeOut();
        }

        const regexPhoneNumber = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
        if ($(this).val().match(regexPhoneNumber)) {
            data_right = true;
            $("#error-phone2").fadeOut();
        } else {
            data_right = false;
            // phone sai cú pháp
            $("#error-phone2").show();
        }
    });

    $('input[name="email"]').keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-email1").show();
        } else {
            data_right = true;
            $("#error-email1").fadeOut();
        }

        const regexPhoneNumber = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/;
        if ($(this).val().match(regexPhoneNumber)) {
            data_right = true;
            $("#error-email2").fadeOut();
        } else {
            data_right = false;
            // phone sai cú pháp
            $("#error-email2").show();
        }
    });

    $('#f_profile').submit(function (e) {
        e.preventDefault();
        var formData = {
            fullName: $('input[name="fullName"]').val(),
            date_of_birth: $('input[name="date_of_birth"]').val(),
            gender: $('input[name="gender"]:checked').val(),
            phone: $('input[name="phone"]').val(),
            email: $('input[name="email"]').val(),
            maps_maplat: $('input[name="maps_maplat"]').val(),
            maps_maplng: $('input[name="maps_maplng"]').val()
        }

        if (data_right == true) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/updateProfile.php",
                dataType: "JSON",
                data: {
                    "formData": formData
                },
                success: function (data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0: {
                            $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Cập nhật thông tin thất bại!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 1: {
                            $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-success alert-dismissible fade show mb-1" role="alert">Bạn đã cập nhật thông tin thành công!</div>');
                            $("#error-submit" + messageIndex).show().delay(10000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 2: {
                            $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Các trường không được bỏ trống!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 3: {
                            $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Số điện thoại sai cú pháp!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 4: {
                            $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Email sai cú pháp!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                    }
                },
                error: function (data) {
                    $("#error-submit-1").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                        $(this).remove();
                    });
                }
            });
            messageIndex++;
        }
    });
}


function changePassword() {
    var data_right = false;

    $('input[name="passwordold"]').keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-passwordold").show();
        } else {
            data_right = true;
            $("#error-passwordold").fadeOut();
        }
    });

    $('input[name="passwordnew1"]').keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-passwordnew1-1").show();
        } else {
            data_right = true;
            $("#error-passwordnew1-1").fadeOut();
        }

        if (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(this) == false) {
            data_right = false;
            // password sai cú pháp
            $("#error-passwordnew1-2").show().delay(3000).fadeOut(1000);
        } else {
            data_right = false;
            // phone sai cú pháp
            $("#error-passwordnew1-2").show();
        }
    });

    $('input[name="passwordnew2"]').keyup(function () {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-passwordnew2-1").show();
        } else {
            if ($(this).val() != $('input[name="passwordnew1"]').val()) {
                data_right = false;
                $("#error-passwordnew2-2").show();
            } else {
                data_right = true;
                $("#error-passwordnew2-1").fadeOut();
                $("#error-passwordnew2-2").fadeOut();
            }
        }
    });

    $('#f_changePassword').submit(function (e) {
        e.preventDefault();
        var formData = {
            passwordold: $('input[name="passwordold"]').val(),
            passwordnew1: $('input[name="passwordnew1"]').val(),
            passwordnew2: $('input[name="passwordnew2"]').val()
        }

        if (formData.passwordold == "") {
            data_right = false;
            $("#error-passwordold").show();
        } else {
            data_right = true;
            $("#error-passwordold").fadeOut();
        }

        if (formData.passwordnew1 == "") {
            data_right = false;
            $("#error-passwordnew1-1").show();
        } else {
            data_right = true;
            $("#error-passwordnew1-1").fadeOut();
        }

        if (formData.passwordnew2 == "") {
            data_right = false;
            $("#error-passwordnew2-1").show();
        } else {
            data_right = true;
            $("#error-passwordnew2-1").fadeOut();
        }


        if (data_right == true) {
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/changePassword.php",
                dataType: "JSON",
                data: {
                    "formData": formData
                },
                success: function (data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0: {
                            $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu cũ, mật khẩu mới và xác nhận mật khẩu không được phét bỏ trống!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 1: {
                            $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-success alert-dismissible fade show mb-1" role="alert">Đổi mật khẩu thành công!</div>');
                            $("#error-submit" + messageIndex).show().delay(10000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 2: {
                            $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu bạn vừa nhập không đúng định dạng!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 3: {
                            $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu cũ bạn vừa nhập ko đúng!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                        case 4: {
                            $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Xác nhận mật khẩu ko chính xác!!!</div>');
                            $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function () {
                                $(this).remove();
                            });
                            break;
                        }
                    }
                },
                error: function (data) {
                    console.log(data);
                    $("#error-submit-2").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function () {
                        $(this).remove();
                    });
                }
            });
            messageIndex++;
        }
    });
}

function uploadAvatar() {
    $('input[name="avatar"]').change(function (e) {
        $('#f_avatar').submit();
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
function showPasswords() {
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