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
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <?php
        if (isset($insertProduct)) {
            echo $insertProduct;
        }
        ?>
        <div class="block">

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <form action="productadd.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputdefault">Product name</label>
                                <input class="form-control" id="inputdefault" type="text" name="productName" placeholder="Enter product name...">
                            </div>
                            <div class="form-group">
                                <label for="inputdefault">Product id</label>
                                <input class="form-control" id="inputdefault" type="text" name="product_code" placeholder="Enter product code...">
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="inputdefault">Quantity</label>
                                        <input class="form-control" id="inputdefault" type="text" name="productQuantity" placeholder="Quantity...">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sel1">Category </label>
                                        <select class="form-control" id="select" name="category">
                                            <option>Lựa chọn</option>
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
                                        <label for="sel1">Brand</label>
                                        <select class="form-control" id="select" name="brand">
                                            <option>Select</option>
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
                                    <div class="form-group col-md-6">
                                        <label for="inputdefault">Old price</label>
                                        <input class="form-control" id="inputdefault" type="text" name="old_price" placeholder="Old price..." value="0">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputdefault">New Price</label>
                                        <input class="form-control" id="inputdefault" type="text" name="price" placeholder="New price...">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="sel1">Group</label>
                                        <select class="form-control" id="select" name="type">
                                            <option>Choose</option>
                                            <?php
                                            if ($result_product['type'] == 0) {
                                            ?>
                                                <option selected value="0">Non-Featured</option>
                                                <option value="1">Featured</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="1">Featured</option>
                                                <option selected value="0">Non-Featured</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div> 

                                    <div class="form-group col-md-8">
                                        <label for="inputdefault">Image upload</label>
                                        <input class="form-control" id="inputdefault" type="file" name="image" placeholder="Enter product name...">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputdefault">Description</label>
                                <textarea name="product_desc" class="tinymce" style="vertical-align: top; padding-top: 9px; width: 100%;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>