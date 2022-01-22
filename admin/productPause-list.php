<?php
include 'inc/header.php';
include '../classes/product.php';
include '../classes/category.php';
include '../classes/brand.php';
require_once '../helpers/format.php';
include '../config/global.php';

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
    <p class="mb-4">Một ngày tràng đầy năng lượng, giàu sức khỏe, mua may bán đắt, tiền vô như nước tiền ra như giọt coffee đặc.
        <br><a href="add-product"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm sản phẩm</a>.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các sản phẩm</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="get">
                        <div class="ml-1">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="number" name="product_num" class="form-control" style="width: 60px;" min="1" value="<?php echo $product_num ?>" />
                                </div>
                                <button type="submit" class="btn btn-primary ml-1">Hiển thị</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


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
                        $type = 9; // product-list normal
                        $list_product = $pd->show_product($type, $page, $product_num, $searchText);
                        $get_amount_all_show_product = $pd->get_amount_all_show_product($type, $searchText);
                        $result = $get_amount_all_show_product->fetch_assoc();
                        $totalRow = $result['totalRow'];
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
                                    <td><a href="#" class="btn" data-productid="<?php echo $productId ?>" data-target="#productModal"><img data-src="<?php echo $product_img ?>" width="100px" height="100px" class="lazy"></a></td>

                                    <td><?php echo $result['productName'] ?></td>
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
                <!-- Pagination -->
                <?php
                if ($totalRow >= $product_num) {
                    $product_button = ceil(($totalRow) / $product_num);
                    $page_now = $page;
                }
                ?>
                <div class="container mt-5 mb-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination" id="pagination"></ul>
                    </nav>
                </div>
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
                <a href="#" id="productDetaild" target="_blank" class="btn btn-info">Chi tiết</a>
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
        <div class="modal-content colMax">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa sản phẩm</h5>
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
                                    <div class="form-group col-md-6">
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
                                    <div class="form-group col-md-6">
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
                                <label for="inputdefault">Hình ảnh</label>
                                <div class="form-group mt-2">
                                    <input type="file" id="input_img" name="input_img[]" onchange="uploadProductImg(1)" accept="image/*" multiple>
                                </div>
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
                                    <div class="form-group col-md-3">
                                        <h6 class="font-weight-bold">Chọn size</h6>
                                        <div class="ml-2">
                                            <input type="checkbox" id="size1">
                                            <label for="size1"> Size: S</label><br>
                                            <input type="checkbox" id="size2">
                                            <label for="size2"> Size: M</label><br>
                                            <input type="checkbox" id="size3">
                                            <label for="size3"> Size: X</label><br>
                                            <input type="checkbox" id="size4">
                                            <label for="size4"> Size: XL</label><br>
                                            <input type="checkbox" id="size5">
                                            <label for="size5"> Freesize</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h6 class="font-weight-bold">Chọn màu</h6>
                                        <div class="ml-2">
                                            <input type="checkbox" id="color1" value="Trắng">
                                            <label for="color1"> Trắng</label><br>
                                            <input type="checkbox" id="color2" value="Đỏ">
                                            <label for="color2"> Đỏ</label><br>
                                            <input type="checkbox" id="color3" value="Đen">
                                            <label for="color3"> Đen</label><br>
                                            <input type="checkbox" id="color4" value="Cam">
                                            <label for="color4"> Cam</label><br>
                                            <input type="checkbox" id="color5" value="Vàng">
                                            <label for="color5"> Vàng</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <h6>&nbsp;</h6>
                                        <div class="ml-2">
                                            <input type="checkbox" id="color6" value="Lá">
                                            <label for="color6"> Lá</label><br>
                                            <input type="checkbox" id="color7" value="Hồng">
                                            <label for="color7"> Hồng</label>
                                            <h6>Màu khác</h6>
                                            <textarea id="color8" cols="15" rows="2"></textarea>
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
                                    <div class="form-group col-md-5">
                                        <label class="font-weight-bold" for="sel1">Trạng thái & Xếp loại sản phẩm</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="null">Lựa chọn</option>
                                            <option selected value="0">Bình thường</option>
                                            <option value="1">Hot nhất</option>
                                            <option value="2">Xếp cao nhất</option>
                                            <option value="9">Ngừng kinh doanh</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="font-weight-bold" for="validation6">Đã bán:</label>
                                        <input class="form-control" id="validation6" type="number" name="product_soldout" min="0" value="0">
                                        <div class=" valid-feedback">Looks good!</div>
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


<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#sidebarToggleTop").click();
    })
    $('#dataTable').dataTable({
        "paging": false
    });
</script>
<script src="js/helpers.js"></script>
<script src="js/order.js"></script>
<script src="js/product.js"></script>
<script>
    order();
    product_list();
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

<script src="../js/pagination/jquery.twbsPagination.js" type="text/javascript"></script>
<script type="text/javascript">
    var product_num = <?php echo $product_num ?>;
    $(function() {
        window.pagObj = $('#pagination').twbsPagination({
            totalPages: <?php echo $product_button ?>,
            visiblePages: 4,
            startPage: <?php echo $page_now ?>,
            onPageClick: function(event, page) {
                // console.info(page + ' (from options)');
            }
        }).on('page', function(event, page) {
            // console.info(page + ' (from event listening)');
            location.href = "productPause-list?page=" + page + "&product_num=" + product_num;
        });
    });
</script>