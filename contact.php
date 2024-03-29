<?php
include 'inc/header.php';
Session::set('REQUEST_URI', getRequestUrls()); // lưu vị trí đường dẫn trang khi chưa đăng nhập
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
								<div class="fb-page" data-href="https://www.facebook.com/ilovekabistore" data-width="350" data-hide-cover="false" data-show-facepile="false"></div>

								<h3 class="mb-4 mt-5">Phản hồi của khách hàng</h3>
								<div id="form-message-warning" class="mb-4"></div>
								<div id="form-message-success" class="mb-4">
									Cảm ơn bạn! Chúng tôi sẽ gửi phản hồi cho bạn sớm nhất
								</div>
								<form method="post" autocomplete="off" name="google-sheet" id="googleSheet">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="name">Họ và tên</label>
												<input type="text" class="form-control" name="name" placeholder="Nguyen Van A" require>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Số điện thoại</label>
												<input type="number" class="form-control" name="phone" placeholder="0932854821">
												<div class="error mb-2" id="error-phone1">Bạn chưa nhập số điện thoại!</div>
												<div class="error mb-2" id="error-phone2">Số điện thoại nhập chưa đúng!</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="email">Địa chỉ Email</label>
												<input type="email" class="form-control" name="email" placeholder="kabistore@gmail.com" require>
												<div class="error mb-2" id="error-email1">Bạn chưa nhập email!</div>
												<div class="error mb-2" id="error-email2">Email bạn vừa nhập sai cú pháp!</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="subject">Tên yêu cầu</label>
												<input type="text" class="form-control" name="title" placeholder="Cần nhập sỉ" require>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="#">Nội dung yêu cầu</label>
												<textarea class="form-control" id="message" name="message" cols="30" rows="4" placeholder="Tôi muốn sỉ số lượng lớn..."></textarea>
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

<?php
include 'inc/footer.php';
?>
<script src="js/feedbackCustomer.js"></script>

<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat"></div>
<script src="js/fbchat.js"></script>