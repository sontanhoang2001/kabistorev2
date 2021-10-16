<?php
include 'inc/header.php';
include '../classes/category.php';  ?>
<?php
// gọi class category
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $catName = $_POST['catName'];
    $insertCat = $cat->insert_category($catName); // hàm check catName khi submit lên
}
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Danh mục sản phẩm</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="box round first grid">
                        <h2>Add category</h2>
                        <div class="block copyblock">
                            <?php
                            if (isset($insertCat)) {
                                echo $insertCat;
                            }
                            ?>
                            <form action="catAdd" method="post">
                                <table class="form">
                                    <tr>
                                        <td>
                                            <input type="text" name="catName" placeholder="Category name..." class="medium" />
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
            </div>
        </div>
    </div>
    <!-- Content Row -->
</div>


<?php include 'inc/footer.php'; ?>