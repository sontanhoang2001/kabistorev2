<?php
include 'inc/header.php';

if ($login_check == false) {
  header('Location:login.php');
}

// if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
//        echo "<script> window.location = '404.php' </script>";

//    }else {
//        $id = $_GET['proid']; // Lấy productid trên host
//    }
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
  // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
  $UpdateCustomers = $cs->update_customers($_POST, $id); // hàm check catName khi submit lên
}
?>

<link rel="stylesheet" type="text/css" href="css/map.css">


<div class="container mt-100">
  <div class="row flex-lg-nowrap">
    <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
      <div class="card p-3">
        <div class="e-navlist e-navlist--active-bg">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link px-2 active" href="./overview.html"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Tổng quát</span></a></li>
            <?php if (session::get('account_type') == 0) { ?>
              <li class="nav-item"><a class="nav-link px-2" href="changepassword.html"><i class="fa fa-fw fa-th mr-1"></i><span>Đổi mật khẩu</span></a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link px-2" href="./settings.html"><i class="fa fa-fw fa-cog mr-1"></i><span>Cài đặt</span></a></li>
          </ul>
        </div>
      </div>
    </div>

    <?php
    $id = Session::get('customer_id');
    $get_customers = $cs->show_customers($id);
    if ($get_customers) {
      while ($result = $get_customers->fetch_assoc()) {
        $lng = $result['maps_maplng'];
        $lat = $result['maps_maplat'];
    ?>
        <form id="f_profile" method="POST" enctype="multipart/form-data">
          <div class="col">
            <div class="row">
              <div class="col mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="e-profile">
                      <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                          <div class="mx-auto" style="width: 140px;">
                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 120px; background-color: rgb(233, 236, 239);">
                              <span><img style="height: 142px;" class="avatar img-thumbnail border-1" src="<?php echo (session::get('account_type') == 0) ?  "upload/avatars/" .  session::get('avatar') : session::get('avatar') ?>" /></span>
                            </div>
                          </div>
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                          <div class="text-center text-sm-left mb-2 mb-sm-0">
                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $result['name']; ?></h4>
                            <p class="mb-0"><?php echo $result['email']; ?></p>
                            <div class="text-muted">Số dư: <small>330 xu</small></div>
                            <div class="mt-2">
                              <?php if (session::get('account_type') == 0) { ?>
                                <label class="btn btn-primary"><input type="file" name="avatar" hidden>
                                  <i class="fa fa-fw fa-camera"></i>
                                  <span>Chọn ảnh</span></input>
                                </label>
                                <input type="text" name="avatarold" value="<?php echo $result['avatar']; ?>" hidden>
                              <?php } else { ?>
                                <a href="https://www.facebook.com/me">
                                  <label class="btn btn-primary">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Cập nhật</span></input>
                                  </label>
                                </a>
                              <?php }  ?>
                            </div>
                          </div>
                          <div class="text-center text-sm-right">
                            <span class="badge badge-secondary">Khách hàng thông minh</span>
                            <div class="text-muted"><small>Gia nhập <?php echo $fm->formatDateVN($result['date_Joined']) ?></small></div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane active">
                        <!-- Form Name -->
                        <legend>
                          <!-- Thong bao trang thai dang nhap-->
                          <h5>
                            <?php
                            if (isset($UpdateCustomers)) {
                              echo '<td colspan="3">' . $UpdateCustomers . '</td>';
                            }
                            ?></h5>
                        </legend>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </form>
    <?php
      }
    }
    ?>

    <div class="col-12 col-md-3 mb-3">
      <form method="get" action="cart.html ">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <button class="btn btn-block btn-secondary" type="submit">
                <i class="fa fa-sign-out"></i>
                <span>Thanh toán</span>
              </button>
            </div>
          </div>
        </div>
      </form>

      <div class="card">
        <div class="card-body">
          <h6 class="card-title font-weight-bold">Hỗ trợ</h6>
          <p class="card-text">Nhận trợ giúp miễn phí từ các trợ lý thân thiện của chúng tôi.</p>
          <button type="button" class="btn btn-primary">Liên hệ chúng tôi</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php
include 'inc/footer.php';
?>

<link href="https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.3.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" type="text/css">
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script>
  var allow_order = false;
  var user_location,
    lat = <?php echo ($lat == null) ? 0 : $lat ?>,
    lng = <?php echo ($lng == null) ? 0 : $lng ?>;

  if (lng != 0 && lat != 0) {
    var saved_markers = [<?php echo $lng; ?>, <?php echo $lat; ?>];
    user_location = saved_markers;
  } else {
    user_location = [105.7691644, 10.0353821];
  }
</script>
<script src="js/map-API.js"></script>