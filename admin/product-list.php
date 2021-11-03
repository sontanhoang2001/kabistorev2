<?php include 'inc/header.php'; ?>
<?php include '../classes/product.php';  ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
?>

<link rel="stylesheet" href="css/style.css">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý sản phẩm</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables.
        <br><a href="add-category"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm Đơn hàng</a>.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các sản phẩm</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>SL ban đầu</th>
                            <th>Đã bán</th>
                            <th>Trong kho</th>
                            <th>Giá</th>
                            <th>Loại</th>
                            <th>Thương hiệu</th>
                            <th>Ưu tiên</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Đơn hàng</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        <?php
                        $list_product = $pd->show_product();
                        if ($list_product) {
                            $i = 0;
                            while ($result = $list_product->fetch_assoc()) {
                                $i++;
                                $productId = $result['productId'];
                                $image =  json_decode($result['image']);
                                $product_img = $image[0]->image;

                                $product_remain = $result['product_remain'];
                                $product_code = $result['product_code'];
                        ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td data-productcode="<?php echo $product_code ?>" onclick="pasteFindByAttr(this, 'productcode')"><?php echo $product_code ?></td>
                                    <td><img data-src="<?php echo $product_img ?>" width="100px" height="100px" class="lazy"></td>

                                    <td><a href="#" class="btn" data-productid="<?php echo $productId ?>" data-target="#productModal"><?php echo $result['productName'] ?></a></td>
                                    <td>
                                        <?php echo $result['productQuantity'] ?>
                                    </td>
                                    <td>
                                        <?php echo $result['product_soldout'] ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn" data-productid="<?php echo $productId ?>" data-qty="<?php echo $product_remain ?>" data-toggle="modal" data-target="#importQtyModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $product_remain ?></a>
                                    </td>
                                    <td><?php echo $fm->format_currency($result['price']) . " ₫" ?></td>
                                    <td><?php echo $result['catName'] ?></td>
                                    <td><?php echo $result['brandName'] ?></td>
                                    <td>
                                        <?php
                                        switch ($result['type']) {
                                            case 0: {
                                                    echo "Bình thường";
                                                    break;
                                                }
                                            case 1: {
                                                    echo "Hot nhất";
                                                    break;
                                                }
                                            case 2: {
                                                    echo "Xếp hạng cao nhât";
                                                    break;
                                                }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn" data-productid="<?php echo $productId ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="#" class="btn" data-productid="<?php echo $productId ?>" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông tin sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body"></div> -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div id="facebookPluginModel" class="fb-post" data-href="" data-width="470	" data-show-text="true" data-lazy="true"></div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mã sản phẩm</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-qrcode" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="productCodeModel" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên sản phẩm</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-font" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" id="productNameModel" readonly value="Bánh quy bơ">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-name" class="col-form-label">Giá bán</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-line-chart" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="priceModel" readonly value="19k">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="recipient-name" class="col-form-label">Số lượng trong kho</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> <i class="fa fa-truck" aria-hidden="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="remainModel" readonly value="19k">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="copyProductName" class="btn btn-primary" onclick="pasteFind('#productNameModel');">Group</button>
                <a href="#" id="productDetaild" class="btn btn-info">Chi tiết</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- import quantity product Modal -->
<div class="modal fade" id="importQtyModal" tabindex="-1" role="dialog" aria-labelledby="importQtyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importQtyModalLabel">Nhập hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="recipient-name" class="col-form-label">Tên sản phẩm</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-truck" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" name="productNameImportModal" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="recipient-name" class="col-form-label">Số lượng trong kho</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"> <i class="fa fa-truck" aria-hidden="true"></i></span>
                            </div>
                            <input type="number" class="form-control" name="product_remainModal" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="recipient-name" class="col-form-label">Số lượng nhập thêm</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                            </div>
                            <input type="number" name="product_more_quantity" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="btnImportQty">Nhập</button>
            </div>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉ sửa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
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
                                        <label for="sel1">Loại sản phẩm </label>
                                        <select class="form-control" id="category" name="category">
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
                                        <select class="form-control" id="brand" name="brand">
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

                                    <div class="form-group col-md-4">
                                        <label for="sel1">Size</label>
                                        <select class="form-control" id="size" name="size">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Không</option>
                                            <option value="1">Có size</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="validation5">Giá cũ</label>
                                        <input class="form-control" id="validation5" type="number" name="old_price" placeholder="Vd: 900" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="validation6">Giá mới</label>
                                        <input class="form-control" id="validation6" type="number" name="price" placeholder="Vd: 40000" min="0" required>
                                        <div class=" valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Hình ảnh</label>
                                <div class="form-group" id="reviewImage">
                                    <img class="mr-2 mt-2" style="width: 100px; height: 100px;" src="../upload/default-product350x350.jpg">
                                </div>
                                <textarea class="form-control" id="image" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Mô tả sản phẩm</label>
                                <button type="button" class="btn-light pull-right" id="btnEditor">editor</button>
                                <textarea class="form-control tinymce" id="product_desc" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="sel1">Trạng thái & Xếp loại sản phẩm</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="null">Lựa chọn</option>
                                            <option value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                            <option value="9">Ngưng kinh doanh</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" name="submit" id="btnUpdateProduct" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel">Xóa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="font-weight-normal" id="productNameDelModel"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="btnDelProduct">Xóa</button>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/helpers.js"></script>
<script src="js/order.js"></script>
<script src="js/product.js"></script>
<script>
    order();
    product_list();
</script>

<!-- BEGIN: load jquery -->
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>

<!-- END: load jquery -->
<script src="js/setup.js" type="text/javascript"></script>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#btnEditor').click(function() {
        setupTinyMCE();
        // setDatePicker('date-picker');
        // $('input[type="checkbox"]').fancybutton();
        // $('input[type="radio"]').fancybutton();
    })
</script>
<!-- Load TinyMCE -->