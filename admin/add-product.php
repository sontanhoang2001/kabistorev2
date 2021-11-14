<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php
$pd = new product();
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
                                        <label for="validation5">Giá gốc <div class="text-success" id="root_priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation5" type="number" name="root_price" placeholder="Vd: 900" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation5">Giá cũ <div class="text-success" id="old_priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation5" type="number" name="old_price" placeholder="Vd: 900" min="0" value="0">
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation6">Giá mới <div class="text-success" id="priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation6" type="number" name="price" placeholder="Vd: 40000" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="validation6">Tiền lãi ước tính</label>
                                        <input class="form-control" id="validation6" type="text" name="interestRate" min="0" readonly>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation6" style="margin-bottom: 0px;">Ship: <label class="text-success" id="priceShippingText">0 ₫</label></label>
                                        <input class="form-control" id="validation6" type="number" name="priceShipping" min="0" value="0">
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="validation6">Tổng cộng</label>
                                        <input class="form-control" id="validation6" type="text" name="totalPrice" min="0" readonly>
                                        <div class=" valid-feedback">Looks good!</div>
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
                                <textarea class="form-control" id="product_desc"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label for="sel1">Trạng thái & Xếp loại sản phẩm</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="sel1">Size</label>
                                        <select class="form-control" id="select" name="size">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Không</option>
                                            <option value="1">Có size</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="validation6">Đã bán:</label>
                                        <input class="form-control" id="validation6" type="number" name="product_soldout" min="0" value="0">
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Thêm</button>
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

<?php include 'inc/footer.php'; ?>
<script src="js/helpers.js"></script>
<script src="js/product.js"></script>
<script src="js/bs-validation.js"></script>
<script>
    add_product();
</script>

<script src="js/ckeditor/ckeditor.js"></script>
<script>
    let YourEditor;
    ClassicEditor
        .create(document.querySelector('#product_desc'))
        .then(editor => {
            window.editor = editor;
            YourEditor = editor;
        })
</script>