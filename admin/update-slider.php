<?php include 'inc/header.php';
include '../classes/product.php';
$fm = new Format();
$pd = new product();

if (isset($_GET['sliderId'])) {
    $sliderId = $_GET['sliderId'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update_slider = $pd->update_slider($sliderId, $_POST);
}

$show_sliderEdit = $pd->show_sliderEdit($sliderId);
if ($show_sliderEdit) {
    while ($result = $show_sliderEdit->fetch_assoc()) {
        $sliderId = $result['sliderId'];
        $slider_image = $result['slider_image'];
        $sliderTitle = $result['sliderTitle'];
        $sliderContent = $result['sliderContent'];
        $sliderLink = $result['sliderLink'];
        $type = $result['type'];
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa slider</h1>
    <p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng chỉnh sửa slider</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                            <div class="form-group">
                                <label for="validation1">Hình ảnh slider</label>
                                <div class="row">
                                    <div class="col">
                                        <img height="220px" width="100%" class="lazy" src="../upload/slider/<?php echo $slider_image ?>" id="sliderImgView">
                                    </div>
                                </div>

                                <input class="mt-2" type="file" name="slider_image">
                                <input class="mt-2" type="text" name="slider_image_old" value="<?php echo $slider_image ?>" hidden>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <label for="validation2">Chủ đề</label>
                                <input class="form-control" id="validation2" type="text" name="sliderTitle" value="<?php echo $sliderTitle ?>" placeholder="Vd: Khuyến mãi..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Nội dung</label>
                                <input class="form-control" id="validation3" type="text" name="sliderContent" value="<?php echo $sliderContent ?>" placeholder="Vd: Giảm tới 30%..." required>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="inputdefault">Liên kết</label>
                                        <input class="form-control" id="validation3" type="text" name="sliderLink" value="<?php echo $sliderLink ?>" placeholder="Vd: url..." required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sel1">Trạng thái</label>
                                        <select class="form-control" id="type" name="type">
                                            <option selected value="null">Lựa chọn</option>
                                            <option <?php echo ($type == 0) ? 'selected' : '' ?> value="0">Tắt</option>
                                            <option <?php echo ($type == 1) ? 'selected' : '' ?> value="1">Bật</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
                            </div>
                        </form>
                        <div class="form-group">
                            <?php
                            if (isset($update_slider)) {
                                echo $update_slider;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="slider-list"><i class="fa fa-list-alt" aria-hidden="true"></i> Xem danh sách slider</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/product.js"></script>
<script src="js/bs-validation.js"></script>