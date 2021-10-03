<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php';  ?>
<?php
// gọi class category
$product = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST

    $insertSlider = $product->insert_slider($_POST, $_FILES); // hàm check catName khi submit lên
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm slider</h2>
        <div class="block">
            <?php
            if (isset($insertSlider)) {
                echo $insertSlider;
            }
            ?>

            <div class="container">
                <div class="row">
                    <form action="slideradd.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputdefault">Title</label>
                                <input class="form-control" id="inputdefault" type="text" name="sliderName" placeholder="Nhập tiêu đề...">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="inputdefault">Image upload</label>
                                <input class="form-control" id="inputdefault" type="file" name="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="sel1">Show</label>
                                <select class="form-control" id="select" name="type">
                                    <option>Choose</option>
                                    <option value="1">On</option>
                                    <option value="0">Off</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-2">
                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                            </div>
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