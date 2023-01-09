<?php
include 'inc/header.php';
?>
<?php include '../classes/product.php';  ?>
<?php
// gọi class category
$product = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $insertSlider = $product->insert_slider($_POST, $_FILES); // hàm check catName khi submit lên
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm slider</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="box round first grid">
                        <div class="block copyblock">
                            <form action="add-slider" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputdefault">Tiều đề slider</label>
                                        <input class="form-control" id="inputdefault" type="text" name="sliderTitle" placeholder="Nhập tiêu đề...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputdefault">Nội dung slider</label>
                                        <input class="form-control" id="inputdefault" type="text" name="sliderContent" placeholder="Nhập tiêu đề...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputdefault">Liên kết slider</label>
                                        <input class="form-control" id="inputdefault" type="text" name="sliderLink" placeholder="Nhập tiêu đề...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputdefault">Upload ảnh slider: 1366x768</label>                                        <a href="https://source.unsplash.com/random/1366x768?sig=234" target="_blank">Lấy ảnh nhẫu nhiên</a>
                                        <input class="form-control" id="inputdefault" type="file" name="image">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="sel1">Hiển thị</label>
                                        <select class="form-control" id="select" name="type">
                                            <option>Chọn hiển thị</option>
                                            <option value="1">Bật</option>
                                            <option value="0">Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Thêm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($insertSlider)) {
                        echo $insertSlider;
                    }
                    ?>
                    <div class="text-right">
                        <a href="slider-list"><i class="fa fa-list-alt" aria-hidden="true"></i> Xem danh sách đã thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>
<?php include 'inc/footer.php'; ?>