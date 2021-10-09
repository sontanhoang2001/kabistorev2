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
  $UpdateCustomers = $cs->update_customers_location($_POST, $id); // hàm check catName khi submit lên
}
?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<h1>
  <br<<br><br>
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
                        <li class="nav-item"><a href="editprofile.php" class="nav-link">Thông tin</a></li>
                        <li class="nav-item"><a href="editprofilelocation.php" class="active nav-link">Vị trí giao hàng</a></li>
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


                          <div class="form-horizontal">
                            <div class="form-group">
                              <label class="col-md col-xs-12" for="Permanent Address">Địa chỉ giao hàng thông thường</label>
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

                          <div class="form-group">
                            <label for="maps_address">Xác định vị trí giao hàng bằng vị trí chính xác</label>
                            <input type="text" class="form-control" name="maps_address" id="maps_address" value="" placeholder="Nhập tên địa điểm cần tìm">
                            <div id="maps_maparea">
                              <div class="panel-google-maps" id="maps_mapcanvas" style="margin-top:10px;" class="form-group"></div>
                              <div class="form-group">
                                <input type="hidden" class="form-control" name="maps_maplat" id="maps_maplat" value="{maps_maplat}" readonly="readonly">
                              </div>
                              <div class="form-group">
                                <input type="hidden" class="form-control" name="maps_maplng" id="maps_maplng" value="{maps_maplng}" readonly="readonly">
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
              <script>
                // Creat map and map tools
                function initializeMap() {
                  var zoom = parseInt($("#" + mapZ).val()),
                    lat = parseFloat($("#" + mapLat).val()),
                    lng = parseFloat($("#" + mapLng).val()),
                    Clat = parseFloat($("#" + mapCenLat).val()),
                    Clng = parseFloat($("#" + mapCenLng).val());
                  Clat || (Clat = <?php echo $result['maps_maplat']; ?>, $("#" + mapCenLat).val(Clat));
                  Clng || (Clng = <?php echo $result['maps_maplng']; ?>, $("#" + mapCenLng).val(Clng));
                  lat || (lat = Clat, $("#" + mapLat).val(lat));
                  lng || (lng = Clng, $("#" + mapLng).val(lng));
                  zoom || (zoom = 17, $("#" + mapZ).val(zoom));

                  mapW = $('#' + ele).innerWidth();
                  mapH = mapW * 3 / 4;

                  // Init MAP
                  $('#' + ele).width(mapW).height(mapH > 500 ? 500 : mapH);
                  map = new google.maps.Map(document.getElementById(ele), {
                    zoom: zoom,
                    center: {
                      lat: Clat,
                      lng: Clng
                    }
                  });

                  // Init default marker
                  var markers = [];
                  markers[0] = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(lat, lng),
                    draggable: true,
                    animation: google.maps.Animation.DROP
                  });
                  markerdragEvent(markers);

                  // Init search box
                  var searchBox = new google.maps.places.SearchBox(document.getElementById(addEle));

                  google.maps.event.addListener(searchBox, 'places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                      return;
                    }

                    for (var i = 0, marker; marker = markers[i]; i++) {
                      marker.setMap(null);
                    }

                    markers = [];
                    var bounds = new google.maps.LatLngBounds();
                    for (var i = 0, place; place = places[i]; i++) {
                      var marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location,
                        draggable: true,
                        animation: google.maps.Animation.DROP
                      });

                      markers.push(marker);
                      bounds.extend(place.geometry.location);
                    }

                    markerdragEvent(markers);
                    map.fitBounds(bounds);
                    console.log(places);
                  });

                  // Add marker when click on map
                  google.maps.event.addListener(map, 'click', function(e) {
                    for (var i = 0, marker; marker = markers[i]; i++) {
                      marker.setMap(null);
                    }

                    markers = [];
                    markers[0] = new google.maps.Marker({
                      map: map,
                      position: new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()),
                      draggable: true,
                      animation: google.maps.Animation.DROP
                    });

                    markerdragEvent(markers);
                  });

                  // Event on zoom map
                  google.maps.event.addListener(map, 'zoom_changed', function() {
                    $("#" + mapZ).val(map.getZoom());
                  });

                  // Event on change center map
                  google.maps.event.addListener(map, 'center_changed', function() {
                    $("#" + mapCenLat).val(map.getCenter().lat());
                    $("#" + mapCenLng).val(map.getCenter().lng());
                    console.log(map.getCenter());
                  });
                }
              </script>
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