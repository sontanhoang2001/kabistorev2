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
<section class="ftco-section mt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-5">
				<h2 class="heading-section">Liên hệ với chúng tôi</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="wrapper img" style="background-image: url(img/bg-img/img-contact.jpg);">
					<div class="row">
						<div class="col-md-9 col-lg-7">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4">Nhập thông tin</h3>
								<div id="form-message-warning" class="mb-4"></div>
								<div id="form-message-success" class="mb-4">
									Cảm ơn bạn! Chúng tôi sẽ gửi phản hồi cho bạn sớm nhất
								</div>
								<form method="POST" id="contactForm" name="contactForm" class="contactForm">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="name">Họ và tên</label>
												<input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên...">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Đại chỉ Email</label>
												<input type="email" class="form-control" name="email" id="email" placeholder="Email...">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="subject">Tên yêu cầu</label>
												<input type="text" class="form-control" name="subject" id="subject" placeholder="Chủ đề...">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="#">Nội dung yêu cầu</label>
												<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Nội dung..."></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" value="Gửi yêu cầu" class="btn btn-primary">
												<div class="submitting"></div>
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