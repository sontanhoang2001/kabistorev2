<?php include 'inc/header.php'; ?>
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    // echo "<script> window.location = 'catlist.php' </script>";

} else {
    $id = $_GET['productid']; // Lấy catid trên host
    $image = $_GET['image']; // Lấy catid trên host
    $delProduct = $pd->del_product($id, $image); // hàm check delete Name khi submit lên
}
?>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/style.css">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>
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
                                $productQuantity = $result['productQuantity'];
                        ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $result['product_code'] ?></td>
                                    <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>

                                    <td><a href="#" class="btn" data-productid="<?php echo $productId ?>" data-target="#productModal"><?php echo $result['productName'] ?></i></a></td>
                                    <td>
                                        <?php echo $productQuantity ?>
                                    </td>
                                    <td>
                                        <?php echo $result['product_soldout'] ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn" data-productid="<?php echo $productId ?>" data-qty="<?php echo $productQuantity ?>" data-toggle="modal" data-target="#importQtyModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo $result['product_remain'] ?></a>
                                    </td>
                                    <td><?php echo $fm->format_currency($result['price']) . " ₫" ?></td>
                                    <td><?php echo $result['catName'] ?></td>
                                    <td><?php echo $result['brandName'] ?></td>

                                    <td>
                                        <?php
                                        if ($result['type'] == 0) {
                                            echo 'Bình thường';
                                        } else {
                                            echo 'Hot nhất';
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
        <div class="modal-content editProductModal">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉ sửa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                fdgsg
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/order.js"></script>
<script src="js/product.js"></script>

<script src="js/helpers.js"></script>
<script>
    order();
    product_list();
</script>