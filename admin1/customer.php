<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
$cs = new customer();
if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script> window.location = 'inbox.php' </script>";
} else {
    $id = $_GET['customerid']; // Lấy catid trên host
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin khách hàng</h2>
        <?php
        $get_customer = $cs->show_customers($id);
        if ($get_customer) {
            while ($result = $get_customer->fetch_assoc()) {


        ?>
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="row container d-flex justify-content-center">
                            <div class="col-xl-6 col-md-12">
                                <div class="card user-card-full">
                                    <div class="row m-l-0 m-r-0">
                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                            <div class="card-block text-center text-white">
                                                <div class="m-b-25"> <img src="uploads/avatars/<?php echo $result['avatar']; ?>" class="img-radius" alt="User-Profile-Image"> </div>
                                                <h6 class="f-w-600"><?php echo $result['name']; ?></h6>
                                                <p>Username: <?php echo $result['username']; ?></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="card-block">
                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Birthdate</p>
                                                        <h6 class="text-muted f-w-400"><?php echo (date('d-m-Y h:m:s',strtotime($result['date_of_birth']))); ?></h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Gender</p>
                                                        <h6 class="text-muted f-w-400">
                                                            <?php
                                                            $gender = $result['gender'];
                                                            if ($gender == "nam") {
                                                                echo "Nam";
                                                            } else {
                                                                echo "Nữ";
                                                            }
                                                            ?>
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Email</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $result['email']; ?></h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Phone</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $result['phone']; ?></h6>
                                                    </div>
                                                </div>
                                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Shippng information</h6>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Shipping address</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $result['address'] .".";?></h6>
                                                    </div>
                                                </div>
                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }

        ?>


    </div>
</div>
<?php include 'inc/footer.php'; ?>