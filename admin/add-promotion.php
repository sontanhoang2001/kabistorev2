<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php

$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insert_promotions = $pd->insert_promotions($_POST);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm mã giảm giá</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng thêm thông tin mã giảm giá</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                            <div class="form-group">
                                <label for="validation1">Mã giảm giá</label>
                                <input class="form-control" id="validation1" type="text" name="promotionsCode" placeholder="Vd: hellokabistore..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="form-group">
                                <label for="validation2">Tên mã giảm giá</label>
                                <input class="form-control" id="validation2" type="text" name="promotionsName" placeholder="Vd: Mừng ngày khai trương..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Mô tả mã giảm giá</label>
                                <textarea class="form-control" id="description" name="description" style="vertical-align: top; padding-top: 9px; width: 100%;" placeholder="Vd: Mô tả ngắn gọn..." required></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="validation3">Đơn mua tối thiểu</label>
                                        <input class="form-control" id="validation3" type="number" name="condition" min="1" placeholder="Vd: 50000..." required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation5">Số tiền giảm giá</label>
                                        <input class="form-control" id="validation5" type="number" name="discountMoney" min="0" placeholder="Vd: 5000..." required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sel1">Màu sắc</label>
                                        <select class="form-control" id="select" name="style">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="validation3">Ngày bắt đầu khuyến mãi</label>
                                        <input class="form-control" id="validation3" type="datetime-local" name="start_date" placeholder="Vd: 900" min="1" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="validation5">Ngày kết thúc khuyến mãi</label>
                                        <input class="form-control" id="validation5" type="datetime-local" name="end_date" placeholder="Vd: 900" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="sel1">Trạng thái</label>
                                        <select class="form-control" id="type" name="status">
                                            <option selected value="null">Lựa chọn</option>
                                            <option value="0">Tắt</option>
                                            <option selected value="1">Bật</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                            </div>
                        </form>
                        <div class="form-group">
                            <?php
                            if (isset($insert_promotions)) {
                                echo $insert_promotions;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="promotions-list"><i class="fa fa-list-alt" aria-hidden="true"></i> Xem danh sách mã giảm giá đã thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<script src="js/product.js"></script>
<script src="js/bs-validation.js"></script>