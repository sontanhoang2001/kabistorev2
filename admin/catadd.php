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

// if (!isset($_GET['delid']) || $_GET['delid'] == NULL) {
//     // echo "<script> window.location = 'catlist.php' </script>";

// } else {
//     $id = $_GET['delid']; // Lấy catid trên host
//     $delCat = $cat->del_category($id); // hàm check delete Name khi submit lên
// }
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm loại sản phẩm</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="box round first grid">
                        <div class="block copyblock">
                            <form action="catAdd" method="post">
                                <div class="form-group">
                                    <label for="catName">Tên loại sản phẩm</label>
                                    <input type="text" name="catName" class="form-control" id="catName" aria-describedby="emailHelp" placeholder="vd: quần áo...">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Thêm</button>
                                <?php
                                if (isset($insertCat)) {
                                    echo $insertCat;
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả các loại sản phẩm</h6>
            <?php
            if (isset($delCat)) {
                echo $delCat;
            }
            ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display datatable table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Loại sản phẩm</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Loại sản phẩm</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        <?php
                        $show_cat = $cat->show_category();
                        if ($show_cat) {
                            $i = 0;
                            $tr_index = 2;

                            while ($result = $show_cat->fetch_assoc()) {
                                $i++;
                                $categoryID = $result['catId'];
                        ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['catName']; ?></td>
                                    <td>
                                        <a id="editCategory" data-id="<?php echo $categoryID ?>" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#myModal" contenteditable="false">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <a id="delCategory" data-id="<?php echo $categoryID ?>" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <!-- <a id="delCategory" onclick="return confirm('Bạn có thật sự muốn xóa???')" href="?delid=<?php echo $result['catId'] ?>" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật loại sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body"></div> -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="noModel">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <input class="form-control" id="categoryNameModel"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" id="updateCategory" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/ajax.js"></script>
<script>
    category();
</script>