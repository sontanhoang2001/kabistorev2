<?php
include 'inc/header.php';
include '../classes/product.php';
require_once '../helpers/format.php';

// gọi class category
$product = new product();
$fm = new Format();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $priceShipping = $_POST['priceShipping'];
    $update_priceShipping = $product->update_priceShipping($priceShipping);
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật phí giao hàng</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <?php $get_priceShipping =  $product->get_priceShipping();
    if ($get_priceShipping) {
        $result = $get_priceShipping->fetch_assoc();
        $price = $result['price'];
    }
    ?>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="box round first grid">
                        <div class="block copyblock">
                            <div class="form-group">
                                <label for="my-input">Giá giao hàng cũ</label>
                                <div class="text-danger"><del><?php echo $fm->format_currency($price) ?> ₫</del></div>
                            </div>
                            <form method="post">
                                <div class="form-group">
                                    <label for="priceShipping">Giá cước giao hàng mới</label>
                                    <div class="text-success mb-2" id="priceShippingNew">0 ₫</div>
                                    <input type="number" name="priceShipping" class="form-control" id="brandName" aria-describedby="emailHelp" placeholder="Viết liền không đấu phẩy...">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
                            </form>

                            <div class="form-group mt-2">
                                <?php
                                if (isset($update_priceShipping)) {
                                    echo $update_priceShipping;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/helpers.js"></script>
<script src="js/ship.js"></script>