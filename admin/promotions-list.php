<?php include 'inc/header.php';
include '../classes/product.php';
require_once '../helpers/format.php';
$product = new product();
$fm = new Format();
if (isset($_GET['update_statusPromotions']) && isset($_GET['promotionsId']) && isset($_GET['status'])) {
    $update_statusPromotions = $_GET['update_statusPromotions'];
    if ($update_statusPromotions == true) {
        $promotionsId = $_GET['promotionsId'];
        $status = $_GET['status'];
        $update_statusPromotions = $product->update_statusPromotions($promotionsId, $status);
    }
}
if (isset($_GET['delpromotions']) && (isset($_GET['promotionsId']))) {
    $delpromotions = $_GET['delpromotions'];
    if ($delpromotions == true) {
        $promotionsId = $_GET['promotionsId'];
        $del_slider = $product->del_Promotions($promotionsId);
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=1179829049097202&autoLogAppEvents=1" nonce="LMMRbqRK"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý mã giảm giá</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables.
        <br><a href="add-promotion"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tạo thêm giảm giá</a>.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các giảm giá</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ngày tạo</th>
                            <th>Mã giảm giá</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Điều kiện</th>
                            <th>Tiền giảm giá</th>
                            <th>Màu sắc</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
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
                        $get_AllPromotions = $product->get_AllPromotions();
                        if ($get_AllPromotions) {
                            $i = 0;
                            $query = "SELECT promotionsId, promotionsCode, promotionsName, description, condition, discountMoney, style, creation_date, start_date, end_date FROM tbl_promotions";

                            while ($result = $get_AllPromotions->fetch_assoc()) {
                                $i++;
                                $promotionsId = $result['promotionsId'];
                                $promotionsCode = $result['promotionsCode'];
                                $promotionsName = $result['promotionsName'];
                                $description = $result['description'];
                                $condition = $result['condition'];
                                $discountMoney = $result['discountMoney'];
                                $style = $result['style'];
                                $creation_date = $result['creation_date'];
                                $start_date = $result['start_date'];
                                $end_date = $result['end_date'];
                                $status = $result['status'];
                        ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td>
                                        <?php echo $creation_date ?>
                                    </td>
                                    <td>
                                        <?php echo $promotionsCode ?>
                                    </td>
                                    <td>
                                        <?php echo $promotionsName ?>
                                    <td>
                                        <?php echo $description ?>
                                    </td>
                                    <td>
                                        <?php echo $condition ?>
                                    </td>
                                    <td>
                                        <?php echo $discountMoney ?>
                                    </td>
                                    <td>
                                        <?php echo $style ?>
                                    </td>
                                    <td>
                                        <?php echo $start_date ?>
                                    </td>
                                    <td>
                                        <?php echo $end_date ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($status == 1) {
                                        ?>
                                            <a class="btn btn btn-success" href="?update_statusPromotions=true&promotionsId=<?php echo $promotionsId ?>&status=0"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn btn btn-warning" href="?update_statusPromotions=true&promotionsId=<?php echo $promotionsId ?>&status=1"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="edit mr-2" href="update-Promotion?promotionsId=<?php echo $promotionsId ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a class="delete" href="?delpromotions=true&promotionsId=<?php echo $promotionsId ?>" class="btn" data-confirm="Bạn có muốn xóa khuyến mãi không?"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<?php include 'inc/footer.php'; ?>
<script src="js/helpers.js"></script>
<script src="js/order.js"></script>
<script src="js/product.js"></script>
<script>
    order();
    product_list();

    $('.delete').on("click", function(e) {
        e.preventDefault();

        var choice = confirm($(this).attr('data-confirm'));

        if (choice) {
            window.location.href = $(this).attr('href');
        }
    });
</script>