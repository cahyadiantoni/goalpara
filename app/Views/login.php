<?= view('layout/header'); ?>

<video
	playsinline
	autoplay
	muted
	loop
	id="preview0"
	style="
		display: none;
		height: 150px;
		position: fixed;
		top: 200px;
		left: 40%;
		z-index: 10000;
	"
></video>
<div id="login" style="">
	<div
		style="
			width: 100%;
			min-height: 800px;
			margin-bottom: 5px;
			padding-top: 45px;
			background-color: #3db379;
		"
	>
		<img src="<?= base_url() ?>assets/img/logo.png" style="width: 130px; margin-left: 20px" />

		<div
			class="row"
			style="
				width: 90%;
				margin: 20px auto;
				background-color: #fff;
				border-radius: 15px;
				min-height: 500px;
				box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 10px;
			"
		>
			<div
				class="col-sm-8 col-sm-offset-2"
				style="padding-left: 0px; padding-right: 0px"
			>
				<!--      Wizard container        -->
				<div class="wizard-container" style="padding-top: 0px">
					<form action="<?= base_url('login') ?>" method="post">
						<!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

						<div
							class="wizard-header"
							style="width: 100%; text-align: center; padding: 15px 0 5px"
						></div>
						<div
							style="
								width: 80%;
								margin: 0px auto;
								text-align: left;
								padding: 0px 0px 20px;
								color: #000;
								font-size: 14px;
							"
						>
							<div
								style="
									font-size: 16px;
									font-weight: bold;
									color: #000;
									padding: 10px 10px 20px 0px;
								"
							>
								Masuk Akun
							</div>
							Selamat Datang, silahkan isi Username dan Password anda untuk
							memulai!
						</div>

						<div class="row">
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<div class="form-group label-floating" style="width: 77%">
										<label class="control-label"
											>Username <small>(required)</small></label
										>
										<input
											name="username"
											id="username"
											type="text"
											class="form-control"
										/>
									</div>
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock</i>
									</span>
									<div class="form-group label-floating" style="width: 77%">
										<label class="control-label"
											>Password <small>(required)</small></label
										>
										<input
											name="password"
											id="password"
											type="password"
											class="form-control"
										/>
									</div>
								</div>
							</div>
						</div>

						<div class="wizard-footer">
						<button
							type="submit"
							class=""
							style="
								margin-top: 10px;
								box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
								width: 90%;
								margin: 0px auto;
								height: 36px;
								text-align: center;
								padding-top: 8px;
								padding-bottom: 8px;
								background-color: #199a50;
								border-radius: 18px;
								color: white;
								font-size: 14px;
								font-weight: bold;
							"
						>
							Login
						</button>
						<!-- Menampilkan pesan error jika ada -->
						<?php if(session()->getFlashdata('error')): ?>
							<div class="alert alert-danger" role="alert">
								<?= session()->getFlashdata('error') ?>
							</div>
						<?php endif; ?>
							<div
								id="info"
								style="width: 100%; margin-top: 15px; text-align: center"
							></div>
							<div class="clearfix"></div>
						</div>
						<div class="input-group">
							<span style="margin-left: 20px; margin-right: 10px">
								<input
									name="remember"
									id="remember"
									type="checkbox"
									class="form-control"
								/>
							</span>
							<div class="form-group label-floating" style="width: 77%">
								Ingat saya
							</div>
						</div>
						<div
							style="
								width: 90%;
								margin: 10px auto;
								min-heigt: 30px;
								border-bottom: 1px #ccc solid;
							"
						></div>
						<div
							style="
								width: 70%;
								margin: 10px auto;
								text-align: center;
								color: #333;
							"
						>
							Goalpara, 2024
						</div>
					</form>
				</div>
				<!-- wizard container -->
			</div>
		</div>
		<!-- end row -->
	</div>
</div>


<?= view('layout/footer');?>

