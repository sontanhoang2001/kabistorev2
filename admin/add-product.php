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
    <p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.


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
                                <label class="font-weight-bold" for="validation1">Mã sản phẩm</label>
                                <input class="form-control" id="validation1" type="text" name="product_code" placeholder="Vd: 4583258743857..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="validation2">Tên sản phẩm</label>
                                <input class="form-control" id="validation2" type="text" name="productName" placeholder="Vd: búp bê baby..." required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-bold" for="validation3">Số lượng</label>
                                        <input class="form-control" id="validation3" type="number" name="productQuantity" placeholder="Vd: 900" min="1" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-bold" for="sel1">Loại sản phẩm </label>
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
                                        <label class="font-weight-bold" for="sel1">Thương hiệu</label>
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
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-bold" for="validation5">Phần trăm lãi<div class="text-success" id="per_priceText">0 %</div></label>
                                        <input class="form-control" id="validation5" type="number" name="perPrice" placeholder="Vd: 70" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-bold" for="validation5">Giá gốc <div class="text-success" id="root_priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation5" type="number" name="root_price" placeholder="Vd: 900" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-bold" for="validation5">Giá cũ <div class="text-success" id="old_priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation5" type="number" name="old_price" placeholder="Vd: 900" min="0" value="0">
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-bold" for="validation6">Giá mới <div class="text-success" id="priceText">0 ₫</div></label>
                                        <input class="form-control" id="validation6" type="number" name="price" placeholder="Vd: 40000" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="font-weight-bold" for="validation6">Tiền lãi ước tính</label>
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
                                <label class="font-weight-bold" for="inputdefault">Hình ảnh sản phẩm</label>
                                <div class="form-group mt-2">
                                    <input type="file" id="input_img" name="input_img[]" onchange="uploadProductImg(0)" accept="image/*" multiple>
                                </div>

                                <div class="form-group" id="reviewImage">
                                    <img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="../upload/default-product350x350.jpg">
                                </div>
                                <textarea class="form-control" id="image" style="vertical-align: top; padding-top: 9px; width: 100%;" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Mô tả sản phẩm</label>
                                <textarea class="form-control" id="product_desc"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <h6 class="font-weight-bold">Chọn size</h6>
                                        <div class="ml-2">
                                            <input type="checkbox" id="size1">
                                            <label for="size1"> Size: XS</label><br>
                                            <input type="checkbox" id="size2">
                                            <label for="size2"> Size: S</label><br>
                                            <input type="checkbox" id="size3">
                                            <label for="size3"> Size: M</label><br>
                                            <input type="checkbox" id="size4">
                                            <label for="size4"> Size: L</label><br>
                                            <input type="checkbox" id="size5">
                                            <label for="size5"> Size: X</label><br>
                                            <input type="checkbox" id="size6">
                                            <label for="size6"> Size: XL</label><br>
                                            <input type="checkbox" id="size7">
                                            <label for="size7"> Size: XXL</label><br>
                                            <input type="checkbox" id="size8">
                                            <label for="size8"> Free Size</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h6 class="font-weight-bold">Chọn màu</h6>
                                        <div class="ml-2">
                                            <div class="box-color" style="background-color: white;"></div>&nbsp;<input type="checkbox" id="color1" value="Trắng">
                                            <label for="color1"> Trắng</label><br>
                                            <div class="box-color" style="background-color: red;"></div>&nbsp;<input type="checkbox" id="color2" value="Đỏ">
                                            <label for="color2"> Đỏ</label><br>
                                            <div class="box-color" style="background-color: black;"></div>&nbsp;<input type="checkbox" id="color3" value="Đen">
                                            <label for="color3"> Đen</label><br>
                                            <div class="box-color" style="background-color: #ff9900;"></div>&nbsp;<input type="checkbox" id="color4" value="Cam">
                                            <label for="color4"> Cam</label><br>
                                            <div class="box-color" style="background-color: #fbff00;"></div>&nbsp;<input type="checkbox" id="color5" value="Vàng">
                                            <label for="color5"> Vàng</label><br>
                                            <div class="box-color" style="background-color: #cc0099;"></div>&nbsp;<input type="checkbox" id="color6" value="Tím">
                                            <label for="color6"> Tím</label><br>
                                            <div class="box-color" style="background-color: #999966;"></div>&nbsp;<input type="checkbox" id="color7" value="Xám">
                                            <label for="color7"> Xám</label><br>
                                            <div class="box-color" style="background-color: #00cc00;"></div>&nbsp;<input type="checkbox" id="color8" value="Xanh-Lá">
                                            <label for="color8"> Xanh-Lá</label><br>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h6>&nbsp;</h6>
                                        <div class="ml-2">
                                            <div class="box-color" style="background-color: #66ff66;"></div>&nbsp;<input type="checkbox" id="color9" value="Xanh-Nhạt">
                                            <label for="color9"> Xanh-Nhạt</label><br>
                                            <div class="box-color" style="background-color: #009933;"></div>&nbsp;<input type="checkbox" id="color10" value="Xanh-Đậm">
                                            <label for="color10"> Xanh-Đậm</label><br>
                                            <div class="box-color" style="background-color: #0099ff;"></div>&nbsp;<input type="checkbox" id="color11" value="Xanh-Biển">
                                            <label for="color11"> Xanh-Biển</label><br>
                                            <div class="box-color" style="background-color: #99ccff;"></div>&nbsp;<input type="checkbox" id="color12" value="Xanh-Lam">
                                            <label for="color12"> Xanh-Lam</label><br>
                                            <div class="box-color" style="background-color: #ff3399;"></div>&nbsp;<input type="checkbox" id="color13" value="Hồng">
                                            <label for="color13"> Hồng</label><br>
                                            <h6>Màu khác</h6>
                                            <textarea id="colorOption" cols="15" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h6 class="font-weight-bold">Màu sắc đã chọn:</h6>
                                        <p id="color"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label class="font-weight-bold" for="sel1">Trạng thái & Xếp loại sản phẩm</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="font-weight-bold" for="validation6">*</label>
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