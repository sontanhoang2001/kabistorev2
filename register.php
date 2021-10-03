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

<?php
// gọi class category

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
  $insertCustomer = $cs->insert_customer($_POST); // hàm check catName khi submit lên
}
?>

<head>
  <link rel="stylesheet" type="text/css" href="css/login-client.css">
</head>
<br><br><br><br><br><br>

<div class="container">
  <div class="row">
    <div class="col-md-4 col-sm-offset-4">
      <div class="card bg-light shadow">
        <div class="card-body">
          <from>
            <h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
            <p class="text-center">Bắt đầu với tài khoản miễn phí của bạn</p>
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <a href="https://cdn.iconscout.com/icon/free/png-512/facebook-logo-2019-1597680-1350125.png">
                  <img class="icon-facebook" src="https://cdn.iconscout.com/icon/free/png-512/facebook-logo-2019-1597680-1350125.png" class="">
                </a>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <a href="https://cdn.iconscout.com/icon/free/png-512/facebook-logo-2019-1597680-1350125.png">
                  <img class="icon-google" src="https://icons-for-free.com/iconfiles/png/512/google+logo+new+icon-1320185797820629294.png" width="100" height="100">
                </a>
              </div>
            </div>
            <p class="divider-text">
              <span class="bg-light">HOẶC ĐĂNG KÝ VỚI BIBIONE NOW</span>
            </p>
            <?php
            if (isset($insertCustomer)) {
              echo $insertCustomer;
            }
            ?>
            <form action="" method="POST">
              <div class="form-group">
                <label>Tên đăng nhập</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input id="username" name="username" type="text" placeholder="nguyenvana2k1" class="form-control input-md">
                </div>
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-unlock-alt"></i>
                  </div>
                  <input id="password" name="password1" type="password" placeholder="vanA123456" class="form-control input-md">
                </div>
              </div>
              <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-unlock-alt"></i>
                  </div>
                  <input id="password" name="password2" type="password" placeholder="vanA123456" class="form-control input-md">
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block"> Tạo tài khoản </button>
              </div> <!-- form-group// -->
              <p class="text-center">Có tài khoản? <a href="login.php">Đăng nhập</a> </p>
          </from>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<br>

<?php
include 'inc/footer.php';
?>