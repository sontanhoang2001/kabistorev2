<?php
include 'inc/header.php';
include '../classes/admin.php';
$ad = new admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $passold = ($_POST['passold']);
    $passnew1 = ($_POST['passnew1']);
    $passnew2 = ($_POST['passnew2']);
    $changepassword = $ad->changepassword($passold, $passnew1, $passnew2); // hàm check User and Pass khi submit lên
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Đổi mật khẩu</h1>
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
                            <form action="changepassword.php" method="post">
                                <div class="form-group">
                                    <label for="inputdefault">Mật khẩu cũ</label>
                                    <input class="form-control" id="inputdefault" type="password" name="passold" placeholder="Nhập password cũ...">
                                </div>
                                <div class="form-group">
                                    <label for="inputdefault">Mật khẩu mới</label>
                                    <input class="form-control" id="inputdefault" type="password" name="passnew1" placeholder="Nhập password mới...">
                                </div>
                                <div class="form-group">
                                    <label for="inputdefault">Xác nhận mật khẩu mới</label>
                                    <input class="form-control" id="inputdefault" type="password" name="passnew2" placeholder="Nhập Password mới thêm lần nữa...">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
                                </div>
                                <div class="form-group">
                                    <?php
                                    if (isset($changepassword)) {
                                        echo $changepassword;
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
</div>

<?php include 'inc/footer.php'; ?>