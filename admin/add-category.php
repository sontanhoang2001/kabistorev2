﻿<?php
include 'inc/header.php';
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
                                <button type="submit" name="submit" class="btn btn-primary" disabled><i class="fa fa-plus-circle"></i> Thêm</button>
                            </form>
                        </div>
                    </div>
                    <div class="text-right">

                        <a href="category-list"><i class="fa fa-list-alt" aria-hidden="true"></i> Xem danh sách đã thêm</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- Content Row -->
</div>


<?php include 'inc/footer.php'; ?>
<script src="js/category.js"></script>
<script>
    add_Category();
</script>