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
					<form action="" method="">
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
							Selamat Datang, silahkan isi Kode pengguna dan Password anda untuk
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
											>Kode <small>(required)</small></label
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
											name="passwd"
											id="passwd"
											type="password"
											class="form-control"
										/>
									</div>
								</div>
							</div>
						</div>

						<div class="wizard-footer">
							<div
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
								onclick="logProses();"
							>
								Login
							</div>
							<div
								id="info"
								style="width: 100%; margin-top: 15px; text-align: center"
							></div>
							<div class="clearfix"></div>
						</div>
						<div class="input-group">
							<span style="margin-left: 20px; margin-right: 10px">
								<input
									name="cek"
									id="cek"
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

<div
	id="main"
	style="display: none; background-color: #f6f6f6; min-height: 700px"
>
	<div
		id="headmain"
		class="header"
		style="
			position: fixed !important;
			top: 0px !important;
			min-height: 235px;
			padding-top: 0px;
			background: url(img/shil.png) top left no-repeat #3db379;
			background-size: cover;
			opacity: 0.95;
			border-radius: 0px 0px 0px 30px;
		"
	>
		<div class="left" style="margin-left: 10px; margin-top: 40px">
			<i
				class="material-icons"
				style="font-size: 24px; font-weight: normal; color: #fff"
				>menu</i
			>
		</div>
		<div class="right" style="margin-right: 10px; margin-top: 30px"></div>
		<div
			style="
				color: #fff;
				font-size: 14px;
				margin: 30px 5px 0px 0px;
				padding-left: 45px;
				font-weight: bold;
			"
		>
			<img src="<?= base_url() ?>assets/img/logo.png" width="150" />
		</div>
		<div
			id="dsptgl"
			style="
				margin-top: 20px;
				margin-bottom: 20px;
				width: 100%;
				text-align: center;
			"
		></div>
		<div
			style="
				width: 90%;
				margin: 50px auto;
				background-color: #fff;
				border-radius: 25px;
				min-height: 50px;
				color: #333;
				padding: 16px 10px 10px 20px;
			"
		>
			<div style="width: 60%; display: inline-block">
				<i class="material-icons" style="font-size: 18px; padding-right: 10px"
					>person_outline</i
				><span
					style="
						vertical-align: 5px;
						padding-top: 35px;
						text-transform: none;
						font-weight: bold;
						font-size: 12px;
					"
					id="gnama"
				></span>
			</div>
			<div
				style="
					width: 35%;
					display: inline-block;
					text-align: right;
					font-size: 12px;
					vertical-align: 3px;
				"
				id="gkav"
			></div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div style="background-color: #0e8a65">
		<div
			class=""
			style="
				width: 100%;
				margin-top: 232px;
				padding-top: 10px;
				background-color: #f6f6f6;
				border-radius: 0px 30px 0px 0px;
				min-height: 450px;
			"
		>
			<div
				style="
					width: 93%;
					min-height: 300px;
					margin: 20px auto;
					background-color: #fff;
					border-radius: 10px;
					box-shadow: rgba(12, 10, 20, 0.1) 0px 2px 4px 0px,
						rgba(12, 10, 20, 0.1) 0px 2px 16px 0px;
				"
			>
				<div class="tab">
					<div
						class="header sub tab"
						style="
							width: 100%;
							margin: 0px auto;
							padding-top: 0px;
							padding-left: 5px;
							border-top: 0px #ccc solid;
							border-bottom: 0px #ccc solid;
						"
					>
						<button
							class="active"
							onclick="openTab('pencapaian')"
							style="padding: 10px 12px"
						>
							<i
								class="material-icons"
								style="font-size: 18px; padding-right: 10px"
								>map</i
							><span
								style="
									vertical-align: 5px;
									margin-top: 15px;
									text-transform: none;
									font-weight: bold;
									font-size: 12px;
								"
								>Loket</span
							>
						</button>
						<button onclick="kasirTab();" style="padding: 10px 12px">
							<i
								class="material-icons"
								style="font-size: 18px; padding-right: 10px"
								>redeem</i
							><span
								style="
									vertical-align: 5px;
									padding-top: 35px;
									text-transform: none;
									font-weight: bold;
									font-size: 12px;
								"
								>Rekap Kasir</span
							>
						</button>
					</div>
				</div>

				<div
					class="tab-content active"
					id="pencapaian"
					style="
						width: 95%;
						margin: 0px auto;
						padding: 15px 10px;
						border-top: 1px #ccc solid;
						padding-bottom: 20px;
					"
				>
					<div
						onclick="openPage('tiket');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/boot.png" />
						<span style="font-weight: bold; padding-bottom: 10px">Loket</span>
					</div>
					<div
						onclick="openPage('booth');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/loket.png" />
						<span style="font-weight: bold; padding-bottom: 10px">Booth</span>
					</div>
					<div
						onclick="openPage('cekout');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/out.png" />

						<span style="font-weight: bold; padding-bottom: 10px"
							>Checkout</span
						>
					</div>
					<div
						onclick="openPage('refund');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/refund.png" />
						<span style="font-weight: bold; padding-bottom: 10px">Refund</span>
					</div>

					<div
						onclick="openPage('ceksaldo');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/cek.png" />
						<span
							style="font-weight: bold; padding-bottom: 10px; padding-top: 10px"
							>Cek Saldo</span
						>
					</div>
					<div
						onclick="cekLocal();"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/cek.png" />
						<span
							style="font-weight: bold; padding-bottom: 10px; padding-top: 10px"
							>Zoo Market</span
						>
					</div>
					<div
						onclick="openPage('listwahana');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/wahana.png" />
						<span
							style="font-weight: bold; padding-bottom: 10px; padding-top: 10px"
							>Gate</span
						>
					</div>
					<div
						onclick="openPage('printer');"
						style="display: inline-block; width: 24%; text-align: center"
					>
						<img style="width: 65px" src="<?= base_url() ?>assets/img/printer.png" />
						<span
							style="font-weight: bold; padding-bottom: 10px; padding-top: 10px"
							>Printer</span
						>
					</div>
					<div
						class="cards"
						style="
							width: 98%;
							margin: 30px auto;
							min-height: 90px;
							background-color: #259e73;
							color: #fff;
							border-radius: 15px;
						"
					>
						<div
							style="
								padding-left: 0px;
								padding-top: 0px;
								font-size: 12px;
								font-weight: bold;
								color: #fff;
							"
						>
							Cashier Summary
						</div>
					</div>
				</div>

				<div
					class="tab-content"
					id="keuangankasir"
					style="width: 95%; margin: 0px auto"
				>
					<div id="resume" style="min-height: 15px; padding: 20px"></div>
				</div>

				<div style="min-height: 5px"></div>
			</div>

			<div
				id="menubar"
				style="
					display: none;
					width: 100%;
					position: fixed !important;
					bottom: 0px !important;
					background-color: #fff;
					border-top: 1px #ccc solid;
					padding-top: 5px;
				"
			>
				<div style="margin-top: 20px">
					<div
						style="
							position: absolute;
							left: 50%;
							margin-left: -25px;
							top: -22px !important;
							width: 50px;
							height: 50px;
							border-radius: 25px;
							background-color: #259e73;
							color: #fff;
						"
					>
						<i
							class="material-icons"
							style="font-size: 26px; margin: 12px 12px"
							onclick=""
							>filter_center_focus</i
						>
					</div>
					<div
						class="icon ion-ios-home"
						style="
							display: inline-block;
							text-align: center;
							width: 23%;
							font-size: 24px;
							color: #333;
							margin-left: 10px;
							margin-top: -3px;
						"
					></div>
					<div
						style="
							display: inline-block;
							text-align: center;
							width: 18%;
							color: #333;
						"
					>
						<i
							class="material-icons"
							style="font-size: 22px; margin-top: -3px"
							onclick="openPage('tiket');"
							>confirmation_number</i
						>
					</div>
					<div
						style="display: inline-block; text-align: center; width: 10%"
					></div>
					<div
						style="
							display: inline-block;
							text-align: center;
							width: 18%;
							color: #333;
						"
					>
						<img
							src="<?= base_url() ?>assets/img/walet.png"
							width="22"
							style="padding-bottom: 5px; margin-top: -13px"
							onclick="openPage('topup');"
						/>
					</div>
					<div
						style="
							display: inline-block;
							text-align: center;
							width: 23%;
							font-size: 24px;
							color: #333;
						"
					>
						<i
							class="material-icons"
							style="font-size: 22px; margin-top: -3px"
							onclick="openPage('refund');"
							>undo</i
						>
					</div>
				</div>
			</div>
		</div>
		<div style="display: none"></div>
	</div>
</div>
<?= view('layout/footer');?>
