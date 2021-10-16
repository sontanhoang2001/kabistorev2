<?php
include 'inc/header.php';
include 'inc/sidebar.php';

include '../classes/admin.php';
?>

<?php
$ad = new admin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $passold = ($_POST['passold']);
    $passnew1 = ($_POST['passnew1']);
    $passnew2 = ($_POST['passnew2']);
    $changepassword = $ad->changepassword($passold, $passnew1, $passnew2); // hàm check User and Pass khi submit lên
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Đổi Password</h2>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <form action="changepassword.php" method="post">
                            <div class="form-group">
                                <label for="inputdefault">Password old</label>
                                <input class="form-control" id="inputdefault" type="password" name="passold" placeholder="Nhập password cũ...">
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Password new</label>
                                <input class="form-control" id="inputdefault" type="password" name="passnew1" placeholder="Nhập password mới...">
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Password confirm</label>
                                <input class="form-control" id="inputdefault" type="password" name="passnew2" placeholder="Nhập Password mới thêm lần nữa...">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                               <?php
                                if (isset($changepassword)) {
                                    echo $changepassword;
                                }
                                ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>