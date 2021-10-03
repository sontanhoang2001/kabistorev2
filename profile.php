<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  header('Location:login.php');
}
?>
<?php
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<h1>
  <br<<br><br><br>
</h1>
<div class="container">
  <div class="row flex-lg-nowrap">
    <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
      <div class="card p-3">
        <div class="e-navlist e-navlist--active-bg">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link px-2 active" href="./overview.html"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Tổng quát</span></a></li>
            <li class="nav-item"><a class="nav-link px-2" href="./users.html"><i class="fa fa-fw fa-th mr-1"></i><span>CRUD</span></a></li>
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
    ?>

        <form class="form" novalidate="" action="" method="post" enctype="multipart/form-data">
          <div class="col">
            <div class="row">
              <div class="col mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="e-profile">
                      <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                          <div class="mx-auto" style="width: 140px;">
                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                              <span><img class="avatar img-thumbnail border-1" src="upload/<?php echo $result['avatar']; ?>" /></span>
                            </div>
                          </div>
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                          <div class="text-center text-sm-left mb-2 mb-sm-0">
                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $result['name']; ?></h4>
                            <p class="mb-0"><?php echo $result['email']; ?></p>
                            <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                            <div class="mt-2">
                              <label class="btn btn-primary"><input type="file" name="avatar" hidden>
                                <i class="fa fa-fw fa-camera"></i>
                                <span>Chọn ảnh</span></input>
                              </label>
                              <input type="text" name="avatarold" value="<?php echo $result['avatar']; ?>" hidden>
                            </div>
                          </div>
                          <div class="text-center text-sm-right">
                            <span class="badge badge-secondary">administrator</span>
                            <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                          </div>
                        </div>
                      </div>
                      <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="editprofile.php" class="active nav-link">Thông tin</a></li>
                        <li class="nav-item"><a href="editprofilelocation.php" class="nav-link">Vị trí giao hàng</a></li>
                      </ul>
                      <div class="tab-content pt-3">
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

                          <div class="row">
                            <div class="col">
                              <div class="row">
                                <div class="col-12">
                                  <label>Họ và tên</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-user">
                                      </i>
                                    </div>
                                    <input id="Name (Full name)" name="name" type="text" placeholder="Họ và tên" class="form-control input-md" value="<?php echo $result['name']; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-6">
                              <div class="form-group">
                                <label>Ngày sinh</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-birthday-cake"></i>
                                  </div>
                                  <input id="date_of_birth" name="date_of_birth" type="text" placeholder="06-06-2001" class="form-control input-md" value="<?php echo $result['date_of_birth']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Multiple Radios (inline) -->
                          <div class="form-group">
                            <label class=" control-label" for="gender">Giới tính</label>
                            <div class="">
                              <label class="radio-inline" for="gender-0">
                                <input type="radio" name="gender" id="Gender-0" value="nam" <?php
                                                                                            if ($result['gender'] == 'nam') {
                                                                                              echo "checked='checked'";
                                                                                            }
                                                                                            ?>>
                                Nam
                              </label>
                              <label class="radio-inline" for="gender-1">
                                <input type="radio" name="gender" id="gender-1" value="nữ" <?php
                                                                                            if ($result['gender'] == 'nữ') {
                                                                                              echo "checked='checked'";
                                                                                            }
                                                                                            ?>>
                                Nữ
                              </label>
                              <label class="radio-inline" for="gender-2">
                                <input type="radio" name="gender" id="gender-2" value="Khác" <?php
                                                                                              if ($result['gender'] == 'Khác') {
                                                                                                echo "checked='checked'";
                                                                                              }
                                                                                              ?>>
                                khác
                              </label>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Điện thoại</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </div>
                                  <input id="phone" name="phone" type="text" placeholder="+(84)921842332" class="form-control input-md" value="<?php echo $result['phone']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-envelope-o"></i>
                                  </div>
                                  <input id="email" name="email" type="text" placeholder="Họ và tên" class="form-control input-md" value="<?php echo $result['email']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-horizontal">
                            <div class="form-group">
                              <label class="col-md col-xs-12" for="Permanent Address">Địa chỉ</label>
                              <div class="col-md-6  col-xs-6">
                                <input id="Permanent Address" name="area" type="text" placeholder="Xã/Phường" class="form-control input-md" value="<?php echo $result['area']; ?>">
                              </div>

                              <div class="col-md-6 col-xs-6">
                                <input id="Permanent Address" name="district" type="text" placeholder="Quận/Huyện" class="form-control input-md" value="<?php echo $result['district']; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md control-label" for="Permanent Address"></label>
                              <div class="col-md-6 col-xs-6">
                                <input id="Permanent Address" name="city" type="text" placeholder="Tỉnh/TP" class="form-control input-md" value="<?php echo $result['city']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col d-flex justify-content-end">
                              <button class="btn btn-primary" type="submit" name="save" class="btn btn-success"><a><span class="glyphicon glyphicon-floppy-disk"></span> Cập nhật</a></button>
                            </div>
                          </div>
                        </div>
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
      <form method="get" action="offlinepayment.php ">
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