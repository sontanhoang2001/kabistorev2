<?php
include 'inc/header.php';
include 'lib/Social-Network-API/facebook_source.php';
// include 'lib/Social-Network-API/google_source.php';
//Social-Network-API

$login_check = Session::get('customer_login');
if ($login_check) {
  header('Location:index.php');
}
?>

<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
//   // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//   $login_Customer = $cs->login_customer($_POST); // hàm check catName khi submit lên
// }
?>

<link rel="stylesheet" type="text/css" href="css/login-client.css">


<div class="global-container">
  <div class="card login-form">
    <div class="card-body bg-light shadow">
      <h3 class="card-title text-center">Đăng nhập</h3>
      <div class="card-text">
        <?php
        if (isset($login_Customer)) {
          echo $login_Customer;
        }
        ?>
        <div id="error-submit"></div>
        <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
        <form method="POST" id="f_login" name="f_login" enctype="multipart/form-data">
          <!-- to error: add class "has-danger" -->
          <div class="form-group pt-10 mt-30">
            <label for="username">Tên đăng nhập</label>
            <input type="text" class="form-control form-control-sm" name="username" id="username">
          </div>
          <div class="error mb-2" id="error-username">Tên đăng nhập không được bỏ trống!!!</div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <a href="#" style="float:right;font-size:12px;">Quên mật khẩu?</a>
            <input type="password" class="form-control form-control-sm" name="password" id="password">
          </div>
      </div>
      <div class="error  mb-2" id="error-password1">Mật khẩu không được bỏ trống!!!</div>
      <div class="error  mb-2" id="error-password2">
        Mật khẩu sai cú pháp!!!<br>
        Tối thiểu tám ký tự, ít nhất một chữ cái và một số</div>
      <div class="checkbox">
        <label><input type="checkbox" onclick="showPasswordLogin()"> Hiện mật khẩu</label>
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="login">Đăng nhập</button>
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
          Không có tài khoản? <a href="register.html" class="ml-2">Đăng ký</a>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
include 'inc/footer.php';
?>
<script src="js/login.js"></script>
<script src="js/customer.js"></script>
<script>
  login();
</script>