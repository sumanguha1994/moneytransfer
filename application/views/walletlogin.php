<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>Money Transfer</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		<link href="<?= base_url('assets/css/pages/login/login-3.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/skins/header/base/light.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/skins/header/menu/light.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/skins/brand/dark.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?= base_url('assets/css/skins/aside/dark.css') ?>" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
	</head>
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?= base_url('assets/media/bg/bg-3.jpg')?> );">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="<?= base_url('assets/media/logos/logo-5.png') ?>">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign In To Admin</h3>
								</div>
								<?php if(!empty($this->session->flashdata('fail'))): ?>
								<div class="alert alert-warning">
									<?= $this->session->flashdata('fail')?>
								</div>
								<?php endif; ?>
								<form class="kt-form" method="post" action="<?= base_url('walletlogin')?>">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password">
									</div>
									<input type="hidden" name="loginfor" value="wallet">
									<div class="row kt-login__extra">
										<div class="col">
											<a href="<?= base_url('change-password')?>">Change Password</a>
										</div>
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign In</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
			setTimeout(() => {
				$('.alert-warning').hide();
			}, 4000);
			setTimeout(() => {
				$('.alert-danger').hide();
			}, 2000);
		</script>
		<script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>" type="text/javascript"></script>
		<script src="<?= base_url('assets/js/scripts.bundle.js') ?>" type="text/javascript"></script>
	</body>
</html>
