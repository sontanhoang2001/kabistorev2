var messageIndex = 0;

function login() {
    $(".icon-google").click(function(e) {
        $("#error-google").show().delay(3000).fadeOut(1000);
    });
    $(".icon-zalo").click(function(e) {
        $("#error-zalo").show().delay(3000).fadeOut(1000);
    });

    $("#username").keyup(function() {
        if ($(this).val() == "") {
            data_right = false;
            // username không được bỏ trống
            $("#error-username").show();
        } else {
            data_right = true;

            $("#error-username").fadeOut();
        }
    });

    $("#password").keyup(function() {
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



    $("#f_login").submit(function(e) {
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
                success: function(data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status,
                        Url = res.url;
                    switch (Status) {
                        case 0:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu Không được bỏ trống!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 1:
                            {
                                location.href = Url;
                                break;
                            }
                        case 2:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu chưa đúng!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                    }
                },
                error: function() {
                    $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function() {
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

    $("#username").keyup(function() {
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

    $("#password1").keyup(function() {
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

    $("#password2").keyup(function() {
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


    $(".icon-google").click(function(e) {
        $("#error-google").show().delay(5000).fadeOut(1000);
    });
    $(".icon-zalo").click(function(e) {
        $("#error-zalo").show().delay(5000).fadeOut(1000);
    });

    $("#f_register").submit(function(e) {
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
                success: function(data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập hoặc mật khẩu Không được bỏ trống!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 1:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-success alert-dismissible fade show mb-1" role="alert">Bạn đã đăng ký tài khoản thành công! <a href="login.html">Đăng nhập ngay</a></div>');
                                $("#error-submit" + messageIndex).show();
                                break;
                            }
                        case 2:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Đăng ký tài khoản không thành công!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 3:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tài khoản này đã tồn tại!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 4:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu nhập lại không chính xác!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 5:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Tên đăng nhập sai cú pháp!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                        case 6:
                            {
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Mật khẩu sai cú pháp!!!</div>');
                                $("#error-submit" + messageIndex).show().delay(5000).fadeOut(1000).queue(function() {
                                    $(this).remove();
                                });
                                break;
                            }
                    }
                },
                error: function(data) {
                    $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-danger alert-dismissible fade show mb-1" role="alert">Lỗi kết nối!!!</div>');
                    $("#error-submit" + messageIndex).show().delay(3000).fadeOut(1000).queue(function() {
                        $(this).remove();
                    });
                }
            });
            messageIndex++;
        }
    });
}


function updateProfile() {
    var data_right = false;
    var gender = $('input:radio[name="gender"]:checked').val();

    $('input[name="fullName"]').keyup(function() {
        if ($(this).val() == "") {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
            // fullName không được bỏ trống
            $("#error-fullname").show();
        } else {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
            $("#error-fullname").fadeOut();
        }
    });


    $('input[name="gender"]').click(function() {
        if ($(this).val() == gender) {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
        } else {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
        }
    });

    $('input[name="date_of_birth"]').change(function() {
        if ($(this).val() == "") {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
        } else {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
        }
    });

    $('input[name="phone"]').keyup(function() {
        if ($(this).val() == "" || $(this).val() == 0) {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
            $("#error-phone1").show();
        } else {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
            $("#error-phone1").fadeOut();
        }

        const regexPhoneNumber = /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
        if ($(this).val().match(regexPhoneNumber)) {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
            $("#error-phone2").fadeOut();
        } else {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
            // phone sai cú pháp
            $("#error-phone2").show();
        }
    });

    $('input[name="email"]').keyup(function() {
        const regexPhoneNumber = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/;
        if ($(this).val().match(regexPhoneNumber)) {
            $("#btnUpdateInfo").removeAttr("disabled");
            data_right = true;
            $("#error-email1").fadeOut();
        } else {
            $("#btnUpdateInfo").attr("disabled", "disabled");
            data_right = false;
            // phone sai cú pháp
            $("#error-email1").show();
        }
    });

    $("#saveLocaltion").click(function() {
        $("#btnUpdateInfo").removeAttr("disabled");
    })


    $("#f_profile").submit(function(e) {
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

        if (formData.maps_maplat != "" && formData.maps_maplng != "") {
            if (data_right == true || check_validation == true) {
                $.ajax({
                    type: "POST",
                    url: "~/../callbackPartial/updateProfile.php",
                    dataType: "JSON",
                    data: {
                        "formData": formData
                    },
                    success: function(data) {
                        var res = JSON.parse(JSON.stringify(data))
                        var Status = res.status;
                        switch (Status) {
                            case 0:
                                {
                                    var message = "Cập nhật thông tin thất bại!";
                                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                    toast.change('Vui lòng thử lại...', 3500);
                                    break;
                                }
                            case 1:
                                {
                                    $("#labelFullName").text(formData.fullName);
                                    var message = "Bạn đã cập nhật thông tin thành công!";
                                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                    toast.change('Đã lưu và thay đổi...', 3500);
                                    break;
                                }
                            case 2:
                                {
                                    var message = "Các trường không được bỏ trống!";
                                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                    toast.change('Vui lòng thử lại...', 3500);
                                    break;
                                }
                            case 3:
                                {
                                    var message = "Số điện thoại sai cú pháp!";
                                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                    toast.change('Vui lòng thử lại...', 3500);
                                    break;
                                }
                            case 4:
                                {
                                    var message = "Email sai cú pháp!!";
                                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                    toast.change('Vui lòng thử lại...', 3500);
                                    break;
                                }
                        }
                    },
                    error: function(data) {
                        var message = "Lỗi máy chủ!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);
                    }
                });
            } else {
                var message = "Thông tin vừa nhập chưa hoàn tất!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng chỉnh sửa lại...', 2500);
            }
        } else {
            var message = "Bạn chưa chon vị trí giao hàng!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Nhấn vào bản đồ để chọn...', 2000);
        }
    });
}


function changePassword() {
    var data_right = false;

    $('input[name="passwordold"]').keyup(function() {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-passwordold").show();
        } else {
            data_right = true;
            $("#error-passwordold").fadeOut();
        }
    });

    $('input[name="passwordnew1"]').keyup(function() {
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

    $('input[name="passwordnew2"]').keyup(function() {
        if ($(this).val() == "") {
            data_right = false;
            $("#error-passwordnew2-1").show();
            $("#btnUpdatePass").attr("disabled", "disabled");
        } else {
            if ($(this).val() != $('input[name="passwordnew1"]').val()) {
                data_right = false;
                $("#error-passwordnew2-2").show();
                $("#btnUpdatePass").attr("disabled", "disabled");

            } else {
                data_right = true;
                $("#error-passwordnew2-1").fadeOut();
                $("#error-passwordnew2-2").fadeOut();
                $("#btnUpdatePass").removeAttr("disabled");
            }
        }
    });

    $('#f_changePassword').submit(function(e) {
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
                success: function(data) {
                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0:
                            {
                                var message = "Các trường không được bỏ trống!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                var message = "Đổi mật khẩu thành công!";
                                let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                toast.change('Đã lưu và thay đổi...', 3500);
                                break;
                            }
                        case 2:
                            {
                                var message = "Mật khẩu không đúng định dạng!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 3:
                            {
                                var message = "Mật khẩu cũ vừa nhập không đúng!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 4:
                            {
                                var message = "Nhập lại mật khẩu ko chính xác!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                    }
                },
                error: function(data) {
                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
        }
    });
}


function checkSendMail() {
    var data_right = false;

    $('input[name="email"]').keyup(function() {
        if ($(this).val() == "") {
            data_right = false;
            $("button[name=sendEmail]").attr("disabled", "disabled");
            $("#error-email1").show();
        } else {
            data_right = true;
            $("button[name=sendEmail]").removeAttr('disabled');
            $("#error-email1").fadeOut();
        }

        var pattern = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/i
        if (!pattern.test($(this).val())) {
            data_right = false;
            $("#error-email2").show();
            $("button[name=sendEmail]").attr("disabled", "disabled");
        } else {
            data_right = true;
            $("button[name=sendEmail]").removeAttr('disabled');
            $("#error-email2").fadeOut();
        }
    });

    $('#f_sendMail').submit(function(e) {
        e.preventDefault();

        var email = $('input[name="email"]').val();

        if (email == "") {
            data_right = false;
            $("#error-email1").show();
            $("button[name=sendEmail]").attr("disabled", "disabled");
        } else {
            data_right = true;
            $("#error-email1").fadeOut();
        }

        if (data_right == true) {
            var sendEmail = $('button[name=sendEmail]');
            $(sendEmail).text("Đang xử lý...");
            $(sendEmail).prop('disabled', 'true');
            $.ajax({
                type: "POST",
                url: "~/../callbackPartial/sendMailForgotPassword.php",
                dataType: "JSON",
                data: {
                    "email": email
                },
                success: function(data) {
                    $("button[name=sendEmail]").removeAttr('disabled');

                    var res = JSON.parse(JSON.stringify(data))
                    var Status = res.status;
                    switch (Status) {
                        case 0:
                            {
                                $(sendEmail).text("Gửi xác nhận");
                                $(sendEmail).removeAttr('disabled');

                                var message = "Hệ thống lỗi!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng thử lại...', 3500);
                                break;
                            }
                        case 1:
                            {
                                $('#f_sendMail').css("display", "none");
                                $("#error-submit").append('<div id="error-submit' + messageIndex + '" class="alert alert-success fade show mb-1" role="alert">Bạn đã xác nhận thành công! Vui lòng kiểm tra hộp thư của bạn.</div>');
                                $("#error-submit" + messageIndex).show();
                                var message = "Bạn đã xác nhận thành công!";
                                let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                toast.change('Vui lòng kiểm tra hộp thư của bạn!', 2000);
                                break;
                            }
                        case 2:
                            {
                                $(sendEmail).text("Gửi xác nhận");
                                $(sendEmail).removeAttr('disabled');

                                var message = "Email không tồn tại trong hệ thống!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng kiểm tra lại...', 3500);
                                break;
                            }
                        case 3:
                            {
                                $(sendEmail).text("Gửi xác nhận");
                                $(sendEmail).removeAttr('disabled');

                                var message = "Email không được bỏ trống!";
                                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                toast.change('Vui lòng kiểm nhập lại...', 3500);
                                break;
                            }
                    }
                },
                error: function(data) {
                    $(sendEmail).text("Gửi xác nhận");
                    $(sendEmail).removeAttr('disabled');

                    var message = "Lỗi máy chủ!";
                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                    toast.change('Vui lòng thử lại...', 3500);
                }
            });
            messageIndex++;
        }
    });
}

// Tải ảnh
function uploadAvatar() {
    // get attr avatar old
    var avatarImageOld = $("#avatarImage").attr("src");
    // load effect
    $("#avatarImage").attr("src", "img/core-img/loadAvatar.gif");
    var fileImage = document.getElementById('avatar');

    var form_data = new FormData();
    form_data.append("image", fileImage.files[0]);

    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();

    var filename = date + '_' + time + fileImage.files[0].name;

    $.ajax({
        url: "https://api.imgbb.com/1/upload?name=" + filename + "&key=349ac570c10df02ade51500393e25fb1",
        method: "POST",
        timeout: 0,
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: form_data,
        success: function(response) {
            // console.log(response);
            var jx = JSON.parse(response);
            // console.log(jx.data.url);
            var urlAvatarImage = jx.data.url;
            if (jx.success == true) {
                $.ajax({
                    url: "~/../callbackPartial/updateAvatar.php",
                    method: "POST",
                    data: {
                        "urlAvatarImage": urlAvatarImage
                    },
                    success: function(data) {
                        var res = JSON.parse(data);
                        var Status = res.status;

                        switch (Status) {
                            case 0:
                                {
                                    var message = "Cập nhật ảnh không thành công!";
                                    let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                                    toast.change('Vui lòng thử lại...', 3500);

                                    // restore avatar
                                    $("#avatarImage").attr("src", avatarImageOld);
                                    break;
                                }
                            case 1:
                                {
                                    // tạo ảnh xem trước
                                    $("#avatarImage").attr("src", urlAvatarImage);

                                    var message = "Cập nhận ảnh thành công!";
                                    let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
                                    toast.change('Ảnh đại diện đã được thay đổi!', 2000);
                                    break;
                                }
                        }
                    },
                    error: function(data) {
                        var message = "Lỗi máy chủ!";
                        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                        toast.change('Vui lòng thử lại...', 3500);

                        // restore avatar
                        $("#avatarImage").attr("src", avatarImageOld);
                    }
                })
            } else {
                var message = "Cập nhật ảnh không thành công!";
                let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
                toast.change('Vui lòng thử lại...', 3500);

                // restore avatar
                $("#avatarImage").attr("src", avatarImageOld);
            }
        },
        error: function() {
            var message = "Upload ko thành công!";
            let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
            toast.change('Vui lòng thử lại...', 3500);

            // restore avatar
            $("#avatarImage").attr("src", avatarImageOld);
        }
    });

}


// var formData = new FormData($(this)[0]);

// // Check file selected or not
// formData.append('avatar', $('input[type=file]')[0].files[0]);
// formData.append('avatarold', $('input[type=text]')[0]);

// $.ajax({
//     url: "~/../callbackPartial/updateAvatar.php",
//     method: "POST",
//     data: new FormData(this),
//     contentType: false,
//     processData: false,
//     success: function (data) {
//         var res = JSON.parse(data);
//         var Status = res.status;
//         var SrcImage = res.srcImage;

//         switch (Status) {
//             case 0: {
//                 var message = "Cập nhật ảnh không thành công!";
//                 let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
//                 toast.change('Vui lòng thử lại...', 3500);
//                 break;
//             }
//             case 1: {
//                 var avatarImage = "upload/avatars/" + SrcImage;
//                 $("#avatarImage").attr("src", avatarImage);
//                 $("#avatarold").val(SrcImage);

//                 var message = "Cập nhận ảnh thành công!";
//                 let toast = $.niceToast.success('<strong>Success</strong>: ' + message + '');
//                 toast.change('Ảnh đại diện đã được thay đổi!', 2000);
//                 break;
//             }
//             case 2: {
//                 var message = "Ảnh lỗi";
//                 let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
//                 toast.change('Vui lòng thử lại...', 3500);
//                 break;
//             }
//             case 3: {
//                 var message = "Ảnh phải tối thiểu dưới 1MB!";
//                 let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
//                 toast.change('Vui lòng thử lại...', 3500);
//                 break;
//             }
//         }
//     }, error: function (data) {
//         var message = "Lỗi máy chủ!";
//         let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
//         toast.change('Vui lòng thử lại...', 3500);
//     }
// })


function navProfile() {
    $('#overview').click(function() {
        var message = "Chức năng này đang được nâng cấp!";
        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
        toast.change('Vui lòng quay lại sau...', 3500);
    })
    $('#plus').click(function() {
        var message = "Chức năng này đang được nâng cấp!";
        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
        toast.change('Vui lòng quay lại sau...', 3500);
    })

    $('#setting').click(function() {
        var message = "Chức năng này đang được nâng cấp!";
        let toast = $.niceToast.error('<strong>Error</strong>: ' + message + '');
        toast.change('Vui lòng quay lại sau...', 3500);
    })
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