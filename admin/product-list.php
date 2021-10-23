<?php include 'inc/header.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?>
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
                            <th>Đã nhập</th>
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
                        ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $result['product_code'] ?></td>
                                    <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>

                                    <td><?php echo $result['productName'] ?></td>
                                    <td>
                                        <?php echo $result['productQuantity'] ?>

                                    </td>
                                    <td>
                                        <?php echo $result['product_soldout'] ?>

                                    </td>
                                    <td>
                                        <?php echo $result['product_remain'] ?>

                                    </td>
                                    <td><?php echo $fm->format_currency($result['price']) . " ₫" ?></td>
                                    <td><?php echo $result['catName'] ?></td>
                                    <td><?php echo $result['brandName'] ?></td>

                                    <td>
                                        <?php
                                        if ($result['type'] == 0) {
                                            echo 'Non-featurered';
                                        } else {
                                            echo 'Featured';
                                        }

                                        ?></td>

                                    <td>
                                        <a class="btn btnn btn-warning" href="productedit.php?productid=<?php echo $result['productId'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp; <a class="btn btnn btn-danger" href="?productid=<?php echo $result['productId'] ?>&image=<?php echo $result['image'] ?>" onclick="return confirm('Bạn có chắc muốn xóa??? Bạn chỉ có thể xóa khi sản phẩm chưa được bán ra, để đảm bảo dữ liệu người dùng vui lòng xóa lịch sử người dùng và thực hiện lại bước xóa sản phẩm này!');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        <a href="productmorequantity.php?productid=<?php echo $result['productId'] ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm</a>
                                    </td>

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

<?php include 'inc/footer.php'; ?>