<?php
include 'inc/header.php';
include 'lib/Social-Network-API/facebook_source.php';
include 'callbackPartial/sendMailForgotPassword.php';
// include 'lib/Social-Network-API/google_source.php';
//Social-Network-API

$login_check = Session::get('customer_login');
if ($login_check) {
  header('Location:index.php');
}
?>

<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendEmail'])) {
//   // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//   $checkSendMail = checkSendMail($_POST); // hàm check catName khi submit lên
// }
?>

<link rel="stylesheet" type="text/css" href="css/login-client.css">


<div class="global-container">
  <div class="card login-form">
    <div class="card-body bg-light shadow">
      <h3 class="card-title text-center">Khôi phục mật khẩu</h3>
      <div id="error-submit" class="text-center alert-danger"></div>
      <form method="POST" id="f_sendMail" enctype="multipart/form-data">
        <div class="card-text">
          <div class="form-group mt-4">
            <label for="email">Email khôi phục</label>
            <input type="email" class="form-control form-control-sm" name="email" id="email" require>
          </div>
        </div>
        <div class="error mb-2" id="error-email1">Bạn chưa điền email!!!</div>
        <div class="error mb-2" id="error-email2">Email sai định dạng!!!</div>
        <button type="submit" class="btn btn-primary btn-block" name="sendEmail">Gửi xác nhận</button>
      </form>

      <div class="text-center mt-3">
        <div class="small">Chúng tôi sẽ gửi mật khẩu cho bạn một các dễ dàng qua email của bạn.</div>
      </div>
      <div class="mt-4">
        <p class="divider-text">
          <span class="d-flex justify-content-center">HOẶC SỬ DỤNG</span>
        </p>
        <p>
        <div class="row">
          <div class="col-5">
            <a href="<?= $loginUrl ?>">
              <img class="icon-facebook" src="img/core-img/facebook-icon.png" class="">
            </a>
          </div>
          <div class="col-3">
            <a href="#">
              <img class="icon-google" src="img/core-img/google-icon.png" width="100" height="100">
            </a>
          </div>
          <div class="col-3">
            <a href="#">
              <img class="icon-zalo" src="img/core-img/zalo-icon.png" width="100" height="100">
            </a>
          </div>

          <!-- ?php if (isset($authUrl)) { ?> -->
          <!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <a href="<?= $authUrl ?>">
                      <img class="icon-google" src="https://icons-for-free.com/iconfiles/png/512/google+logo+new+icon-1320185797820629294.png" width="100" height="100">
                    </a>
                  </div> -->
          <!-- ?php } ?> -->
        </div>
        </p>
        <div class="row">
          <div class="col-12">
            <div class="error text-center" id="error-google">Tạm dừng hỗ trợ đăng nhập bằng Google</div>
            <div class="error text-center" id="error-zalo">Tạm dừng hỗ trợ đăng nhập bằng Zalo</div>
          </div>
        </div>
        <div class="sign-up">
          <a href="register.html" class="ml-2">Đăng ký</a> |<a href="login.html" class="ml-2">Đăng nhập</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
include 'inc/footer.php';
?>
<script src="js/customer.js"></script>
<script>
  checkSendMail();
</script>