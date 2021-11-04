<?php
include 'inc/header.php';
?>
<style>
	.wrapper.img {
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
	}
</style>

<section class="ftco-section mt-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="wrapper img" style="background-image: url(img/bg-img/img-contact.jpg);">
					<div class="row">
						<div class="col-md-9 col-lg-7">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4">Phản hồi của khách hàng</h3>
								<div id="form-message-warning" class="mb-4"></div>
								<div id="form-message-success" class="mb-4">
									Cảm ơn bạn! Chúng tôi sẽ gửi phản hồi cho bạn sớm nhất
								</div>
								<form method="post" autocomplete="off" name="google-sheet" id="googleSheet">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="name">Họ và tên</label>
												<input type="text" class="form-control" name="name" placeholder="Nhập tên..." require>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Số điện thoại</label>
												<input type="number" class="form-control" name="phone" placeholder="Nhấp số đt...">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="email">Đại chỉ Email</label>
												<input type="email" class="form-control" name="email" placeholder="...@gmail.com" require>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="subject">Tên yêu cầu</label>
												<input type="text" class="form-control" name="title" placeholder="Chủ đề..." require>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="#">Nội dung yêu cầu</label>
												<textarea class="form-control" id="message" name="message" cols="30" rows="4" placeholder="Nội dung..."></textarea>
											</div>
										</div>
										<input type="hidden" class="form-control" name="timestamp" require value="=now()">
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" id="submit" value="Gửi yêu cầu" disabled class="btn btn-primary">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat"></div>
<?php
include 'inc/footer.php';
?>
<script src="js/feedbackCustomer.js"></script>
<script src="js/fbchat.js"></script>