<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php include '../classes/brand.php';  ?>
<?php
// gọi class category
$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $brandName = $_POST['brandName'];
    $insertBrand = $brand->insert_brand($brandName); // hàm check catName khi submit lên
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add brand</h2>
        <div class="block copyblock">
            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?>
            <form action="brandadd.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Enter brand name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>