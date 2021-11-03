<?php include 'inc/header.php';
include '../classes/product.php';
$fm = new Format();
$pd = new product();

if (isset($_GET['promotionsId'])) {
    $promotionsId = $_GET['promotionsId'];
}
$get_AllPromotion = $pd->get_AllPromotion($promotionsId);
if ($get_AllPromotion) {
    while ($result = $get_AllPromotion->fetch_assoc()) {
        $promotionsId = $result['promotionsId'];
        $promotionsCode = $result['promotionsCode'];
        $promotionsName = $result['promotionsName'];
        $description = $result['description'];
        $condition = $result['condition'];
        $discountMoney = $result['discountMoney'];
        $style = $result['style'];
        $creation_date = $result['creation_date'];
        $start_date = $result['start_date'];
        $start_date = substr($fm->formatDateTimeSetTimestampl($start_date), 0, 16);
        $end_date = $result['end_date'];
        $end_date = substr($fm->formatDateTimeSetTimestampl($end_date), 0, 16);
        $status = $result['status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $update_Promotion = $pd->update_Promotion($promotionsId, $_POST);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa mã giảm giá</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng chỉnh sửa mã giảm giá</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                            <div class="form-group">
                                <label for="validation1">Mã giảm giá</label>
                                <input class="form-control" id="validation1" type="text" name="promotionsCode" value="<?php echo $promotionsCode ?>" placeholder="Vd: hellokabistore..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="form-group">
                                <label for="validation2">Tên mã giảm giá</label>
                                <input class="form-control" id="validation2" type="text" name="promotionsName" value="<?php echo $promotionsName ?>" placeholder="Vd: Mừng ngày khai trương..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Mô tả mã giảm giá</label>
                                <textarea class="form-control" id="description" name="description" style="vertical-align: top; padding-top: 9px; width: 100%;" placeholder="Vd: Mô tả ngắn gọn..." required><?php echo $description ?></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="validation3">Đơn mua tối thiểu</label>
                                        <input class="form-control" id="validation3" type="number" name="condition" min="1" value="<?php echo $condition ?>" placeholder="Vd: 50000..." required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation5">Số tiền giảm giá</label>
                                        <input class="form-control" id="validation5" type="number" name="discountMoney" min="0" value="<?php echo $discountMoney ?>" placeholder="Vd: 5000..." required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sel1">Màu sắc</label>
                                        <select class="form-control" id="select" name="style">
                                            <option value="null">Lựa chọn</option>
                                            <option <?php echo ($style == 1) ? 'selected' : '' ?> value="1">1</option>
                                            <option <?php echo ($style == 2) ? 'selected' : '' ?> value="2">2</option>
                                            <option <?php echo ($style == 3) ? 'selected' : '' ?> value="3">3</option>
                                            <option <?php echo ($style == 4) ? 'selected' : '' ?> value="4">4</option>
                                            <option <?php echo ($style == 5) ? 'selected' : '' ?> value="5">5</option>
                                            <option <?php echo ($style == 6) ? 'selected' : '' ?> value="6">6</option>
                                            <option <?php echo ($style == 7) ? 'selected' : '' ?> value="7">7</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="validation3">Ngày bắt đầu khuyến mãi</label>
                                        <input class="form-control" id="validation3" type="datetime-local" name="start_date" value="<?php echo $start_date ?>" placeholder="Vd: 900" min="1" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="validation5">Ngày kết thúc khuyến mãi</label>
                                        <input class="form-control" id="validation5" type="datetime-local" name="end_date" value="<?php echo $end_date ?>" placeholder="Vd: 900" min="0" required>
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
                                            <option <?php echo ($status == 0) ? 'selected' : '' ?> value="0">Tắt</option>
                                            <option <?php echo ($status == 1) ? 'selected' : '' ?> value="1">Bật</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                            </div>
                        </form>
                        <div class="form-group">
                            <?php
                            if (isset($update_Promotion)) {
                                echo $update_Promotion;
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

<!-- BEGIN: load jquery -->
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>

<!-- END: load jquery -->
<script src="js/setup.js" type="text/javascript"></script>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">

    $('#btnEditor').click(function() {
        $('#description').removeClass().addClass("tinymce");
        setupTinyMCE();
        // setDatePicker('date-picker');
        // $('input[type="checkbox"]').fancybutton();
        // $('input[type="radio"]').fancybutton();
    })
</script>
<!-- Load TinyMCE -->