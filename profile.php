<?php
include 'inc/header.php';

if ($login_check == false) {
  header('Location:login.php');
}

$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
  if ($_FILES['avatar']['name'] != null) {
    $UpdateCustomers = $cs->update_avatar($_POST, $id); // hàm check catName khi submit lên
  }
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
              <li class="nav-item"><a class="nav-link px-2" href="profile.html#changepassword"><i class="fa fa-fw fa-th mr-1"></i><span>Đổi mật khẩu</span></a></li>
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
        <div class="col">
          <div class="row">
            <div class="col mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="e-profile">
                    <div class="row">
                      <div class="col-12 col-sm-auto mb-3">
                        <div class="mx-auto" style="width: 140px; height: 140px;">
                          <div class="d-flex justify-content-center align-items-center rounded" style="height: 120px; background-color: rgb(233, 236, 239);">
                            <span><img style="width: 140px; height: 140px;" class="avatar img-thumbnail border-1" src="<?php echo (session::get('account_type') == 0) ?  "upload/avatars/" .  session::get('avatar') : session::get('avatar') ?>" /></span>
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
                              <form id="f_avatar" method="POST" enctype="multipart/form-data">
                                <label class="btn btn-primary"><input type="file" name="avatar" hidden>
                                  <i class="fa fa-fw fa-camera"></i>
                                  <span>Chọn ảnh</span></input>
                                </label>
                                <input type="text" name="avatarold" value="<?php echo $result['avatar']; ?>" hidden>
                                <?php if (isset($UpdateCustomers)) {
                                  echo $UpdateCustomers;
                                } ?>
                              </form>
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

                    <!-- Nav tabs -->


                    <ul class="nav nav-pills pills-dark mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#profile">Thông tin liên hệ</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#changepassword">Đổi mật khẩu</a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div id="profile" class="container tab-pane active">
                        <form id="f_profile" class="profile-validation" novalidate method="POST" enctype="multipart/form-data">
                          <!-- Form Name -->
                          <div class="row mt-4">
                            <div class="col-md-6 col-sm-12">
                              <label for="fullName">Họ và tên</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="fullName" id="fullName" class="form-control" aria-label="fullname" aria-describedby="basic-addon1" value="<?php echo $result['name']; ?>" required>
                              </div>
                              <div class="error mb-2" id="error-fullname">Họ và tên không được bỏ trống! hãy ghi tên để chúng tôi dễ xưng hô với bạn.</div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <label>Ngày sinh</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-birthday-cake"></i></span>
                                </div>
                                <input type="date" name="date_of_birth" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $result['date_of_birth']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <!-- Multiple Radios (inline) -->
                              <div class="form-group">
                                <label class="control-label" for="gender">Giới tính</label>
                                <div class="mt-1">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0" <?php echo ($result['gender'] == 0) ? "checked='checked'" :  "" ?>>
                                    <label class="form-check-label" for="inlineRadio">Nam</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1" <?php echo ($result['gender'] == 1) ? "checked='checked'" :  "" ?>>
                                    <label class="form-check-label" for="inlineRadio">Nữ</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="2" <?php echo ($result['gender'] == 2) ? "checked='checked'" :  "" ?>>
                                    <label class="form-check-label" for="inlineRadio">Khác</label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                              <label>Điện thoại +(84)</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-phone"></i></span>
                                </div>
                                <input type="number" name="phone" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="0<?php echo $result['phone']; ?>">
                              </div>
                              <div class="error mb-2" id="error-phone1">Số điện thoại không được bỏ trống!!!</div>
                              <div class="error mb-2" id="error-phone2">Số điện thoại sai cú pháp!!!</div>

                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <label>Địa chỉ email</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-envelope-o"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="basic-addon1" value="<?php echo $result['email']; ?>">
                              </div>
                              <div class="error mb-2" id="error-email1">Email không được bỏ trống!!!</div>
                              <div class="error mb-2" id="error-email2">Email bạn vừa nhập sai cú pháp!!!<br>
                                VD: kabistore@mail.com</div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 pt-4">
                              <div class="form-group" id="location-group">
                                <label for="maps_address"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Ghim vị trí giao hàng</label>
                                <!-- <input type="text" class="form-control" name="maps_address" id="maps_address" value="" placeholder="Nhập tên địa điểm cần tìm"> -->
                                <div id="maps_maparea">
                                  <div class="panel-google-maps">
                                    <div id="map"></div>
                                    <div id="menu-map" style="bottom: 6px;">
                                      <input id="satellite-v9" type="radio" name="rtoggle" value="satellite" checked="checked">
                                      <label for="satellite-v9">vệ tinh</label>
                                      <input id="streets-v11" type="radio" name="rtoggle" value="streets" checked="checked">
                                      <label for="streets-v11">đường phố</label>
                                      <input id="dark-v10" type="radio" name="rtoggle" value="dark">
                                      <label for="dark-v10">tối</label>
                                    </div>
                                  </div>
                                  <!-- <div class="panel-google-maps" id="maps_mapcanvas" class="form-group"></div> -->
                                  <!-- <div class="panel-google-maps">
                                                <div id="map"></div>
                                            </div> -->
                                  <div class="form-group">
                                    <input class="col-md-6" type="hidden" class="form-control" name="maps_maplat" id="lat" readonly="readonly" value="<?php echo $lat ?>">
                                    <input class="col-md-6" type="hidden" class="form-control" name="maps_maplng" id="lng" readonly="readonly" value="<?php echo $lng ?>">
                                    <input class="col-md-12" type="hidden" class="form-control" name="geocoder" id="geocoding" readonly="readonly">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 mt-2">
                              <label for="geocoder" class="lGeocoder"><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí hiện tại của bạn:</label>
                              <div id="geo-text" class="text-danger">Đang tìm vị trí...</div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 mt-3">
                              <button type="button" name="localtion" id="saveLocaltion" onclick="getLocation();" class="btn btn-danger btn-lock"><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí hiện tại</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col d-flex justify-content-end">
                              <button class="btn btn-primary" type="submit" id="btnUpdateInfo" name="save" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
                            </div>
                          </div>
                          <div id="error-submit-1" class="mt-50"></div>
                        </form>
                      </div>
                      <div id="changepassword" class="container tab-pane fade"><br>
                        <form id="f_changePassword" method="POST" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <label>Mật khẩu cũ</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-clock-o"></i></span>
                                </div>
                                <input type="password" name="passwordold" class="form-control">
                              </div>
                              <div class="error mb-2" id="error-passwordold">Bạn chưa nhập mật khẩu cũ!!!.</div>

                            </div>
                            <div class="col-md-6 col-sm-12">
                              <label>Mật khẩu mới</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"> <i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="passwordnew1" id="password1" class="form-control">
                              </div>
                              <div class="error mb-2" id="error-passwordnew1-1">Bạn chưa nhập mật khẩu mới!!!</div>
                              <div class="error mb-2" id="error-passwordnew1-2">Mật khẩu của bạn sai cú pháp!!!<br>
                                + VD: nguyenvanteo123456</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <label>Xác nhận mật khẩu mới</label>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"> <i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="passwordnew2" id="password2" class="form-control">
                              </div>
                              <div class="error mb-2" id="error-passwordnew2-1">Bạn chưa nhập mật khẩu mới!!!</div>
                              <div class="error mb-2" id="error-passwordnew2-2">Nhập lại mật khẩu chưa trùng khớp!!!</div>
                            </div>
                          </div>
                          <div class="checkbox">
                            <label><input type="checkbox" onclick="showPasswords()"> Hiện mật khẩu</label>
                          </div>
                          <div class="row">
                            <div class="col d-flex justify-content-end">
                              <button class="btn btn-primary" type="submit" id="btnUpdatePass" class="btn btn-success" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
                            </div>
                          </div>
                          <div id="error-submit-2" class="mt-50"></div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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


<script>
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('profile-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
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
<script src="js/customer.js"></script>
<script>
  updateProfile();
  changePassword();
  uploadAvatar();
</script>