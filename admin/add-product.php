<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php

$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertProduct = $pd->insert_product($_POST, $_FILES);
}
?>

<?php
if (isset($insertProduct)) {
    echo $insertProduct;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm sản phẩm</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng thêm thông tin sản phẩm</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                            <div class="form-group">
                                <label for="validation1">Mã sản phẩm</label>
                                <input class="form-control" id="validation1" type="text" name="product_code" placeholder="Vd: 4583258743857..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="form-group">
                                <label for="validation2">Tên sản phẩm</label>
                                <input class="form-control" id="validation2" type="text" name="productName" placeholder="Vd: búp bê baby..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="validation3">Số lượng</label>
                                        <input class="form-control" id="validation3" type="text" name="productQuantity" placeholder="Vd: 900" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sel1">Loại sản phẩm </label>
                                        <select class="form-control" id="select" name="category">
                                            <option value="0">Lựa chọn</option>
                                            <?php
                                            $cat = new category();
                                            $catlist = $cat->show_category();
                                            if ($catlist) {
                                                while ($result = $catlist->fetch_assoc()) {

                                            ?>
                                                    <option value=" <?php echo $result['catId'] ?> "> <?php echo $result['catName'] ?> </option>

                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sel1">Thương hiệu</label>
                                        <select class="form-control" id="select" name="brand">
                                            <option value="0">Lựa chọn</option>
                                            <?php
                                            $brand = new brand();
                                            $brandlist = $brand->show_brand();
                                            if ($brandlist) {
                                                while ($result = $brandlist->fetch_assoc()) {
                                            ?>
                                                    <option value=" <?php echo $result['brandId'] ?> "> <?php echo $result['brandName'] ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="validation5">Giá cũ</label>
                                        <input class="form-control" id="validation5" type="text" name="old_price" placeholder="Vd: 900" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation6">Giá mới</label>
                                        <input class="form-control" id="validation6" type="text" name="price" placeholder="Vd: 40000" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="sel1">Nhóm ưu tiên</label>
                                        <select class="form-control" id="select" name="type">
                                            <option>Lựa chọn</option>
                                            <option selected value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Hình ảnh</label>
                                <textarea name="image" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="tinymce" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Load TinyMCE -->

<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();


    $(document).ready(function() {
        var a = $('select[name="category"] option:selected').val();

        var json = '["City1","City2","City3"]';
        var arr = $.parseJSON(json);
        console.log(arr[1]);
    })


    // $(document).submit(function(e) {
    //     e.preventDefault();
    //     alert("ok");
    // });
</script>