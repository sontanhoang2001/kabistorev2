<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check) {
  header('Location:order.php');
}
?>

<div class="container mt-100 mb-100">
  <div class="d-flex justify-content-center">
    <div class="card login-form">
      <div class="card-body bg-light shadow">
        <h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
        <p class="text-center">Bắt đầu với tài khoản miễn phí của bạn</p>
        <div class="row mb-4">
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
        </div>
        <div class="row">
          <div class="col-12">
            <div class="error text-center" id="error-google">Tạm dừng hỗ trợ đăng nhập bằng Google</div>
            <div class="error text-center" id="error-zalo">Tạm dừng hỗ trợ đăng nhập bằng Zalo</div>
          </div>
        </div>
        <p class="divider-text">
          <span class="d-flex justify-content-center">HOẶC ĐĂNG KÝ VỚI KABI STORE</span>
        </p>
        <form method="POST" id="f_register" name="f_register" enctype="multipart/form-data">
          <div class="card-text">
            <div id="error-submit"></div>
            <!-- to error: add class "has-danger" -->
            <div class="form-group pt-10 mt-30">
              <label for="username">Tên đăng nhập</label>
              <input type="text" class="form-control form-control-sm" name="username" id="username">
            </div>
            <div class="error mb-2" id="error-username1">Tên đăng nhập không được bỏ trống!!!</div>
            <div class="error mb-2" id="error-username2">
              Tên đăng nhập sai cú pháp!!!<br>
              + VD: nguyenvanteo2001
            </div>
            <div class="form-group">
              <label for="password1">Mật khẩu</label>
              <input type="password" class="form-control form-control-sm" name="password1" id="password1">
            </div>
            <div class="error  mb-2" id="error-password1">Mật khẩu không được bỏ trống!!!</div>
            <div class="error  mb-2" id="error-password2">
              Mật khẩu sai cú pháp!!!<br>
              + VD: nguyenvanteo123456</div>
            <div class="form-group">
              <label for="password2">Xác nhận mật khẩu</label>
              <input type="password" class="form-control form-control-sm" name="password2" id="password2">
            </div>
          </div>
          <div class="error  mb-2" id="error-password3">Xác nhận mật khẩu không khớp!!!</div>
          <div class="checkbox">
            <label><input type="checkbox" onclick="showPasswords()"> Hiện mật khẩu</label>
          </div>
          <button type="submit" name="submit" class="btn btn-primary btn-block" id="submit"> Tạo tài khoản </button>
          <div class="mt-2">
            <div class="sign-up">
              Có tài khoản? <a href="login.html">Đăng nhập</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
<script src="js/customer.js"></script>
<script>
  register();
</script>