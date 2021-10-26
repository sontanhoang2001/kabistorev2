<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php

$pd = new product();
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $insertProduct = $pd->insert_product($_POST, $_FILES);
// }
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
                                        <input class="form-control" id="validation3" type="number" name="productQuantity" placeholder="Vd: 900" min="1" required>
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
                                        <input class="form-control" id="validation5" type="number" name="old_price" placeholder="Vd: 900" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation6">Giá mới</label>
                                        <input class="form-control" id="validation6" type="number" name="price" placeholder="Vd: 40000" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sel1">Size</label>
                                        <select class="form-control" id="select" name="size">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Không</option>
                                            <option value="1">Có size</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Hình ảnh sản phẩm</label>
                                <div class="form-group" id="reviewImage">
                                    <img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="../upload/default-product350x350.jpg">
                                </div>
                                <textarea class="form-control" id="image" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Mô tả sản phẩm</label>
                                <textarea class="form-control" id="product_desc" class="tinymce" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="sel1">Trạng thái & Xếp loại sản phẩm</label>
                                        <select class="form-control" id="select" name="type">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                    <a href="product-list"><i class="fa fa-list-alt" aria-hidden="true"></i> Xem danh sách sản phẩm đã thêm</a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Load TinyMCE -->

<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>
<script src="js/product.js"></script>
<script>
    add_product();
</script>