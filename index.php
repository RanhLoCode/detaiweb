<!DOCTYPE html>

<html lang="vi" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="reset.css" rel="stylesheet" />
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap-datetimepicker.min.css">
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title></title>
<style>
button.empty {
	background: none !important;
	border: none !important;
	outline: none !important;
}

.hide {
	display: none;
}

.none-dec {
	text-decoration: none !important;
}

body {
	padding-top: 50px;
}

@media only screen and (max-width:425px) {
	body {
		padding-top: 100px;
	}
}

@media only screen and (orientation: landscape) and (min-width:600px)
	and (max-width:740px) {
	body {
		padding-top: 100px;
	}
}

.menu {
	padding: 0;
	padding-top: 20px;
}

.list-feat>li {
	background: none;
	border-bottom: 1px solid rgba(128, 128, 128, 0.21);
	font-size: 16px;
	cursor: pointer;
	color:#39c;
}

.list-feat>li>div {
	padding: 10px;
}

.list-feat li a:hover {
	text-decoration: none;
	color: #39c;
}

.list-feat>li>ul {
	display: none;
}

.list-feat>li>ul>li {
	padding: 10px;
	padding-left: 40px;
}

.list-feat>li>ul>li a {
	font-size: 14px;
	color: white;
}

.list-feat>li.active>div {
	background: #313339;
}

.list-feat>li>div>.plus {
	position: relative;
}

.list-feat>li>div>.plus:after {
	content: "";
	width: 0;
	height: 0;
	border: 2px solid #ff4040;
	border-top-width: 7px;
	border-bottom-width: 7px;
	position: absolute;
	top: .4px;
	right: 0px;
	opacity: 0;
	transition: opacity 1s ease;
	-webkit-transition: opacity 1s ease;
	-moz-transition: opacity 1s ease;
	-o-transition: opacity 1s ease;
}

.list-feat>li.active>div>.plus:after {
	opacity: 1;
}

@media only screen and (min-width:1024px) {
	.content {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
}
</style>
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-header">
			<div class="navbar-brand">
				<a class="none-dec" href="#">Admin</a> <span
					class="btn-list-feat glyphicon glyphicon-menu-hamburger pull-right hidden-md hidden-lg"
					style="margin-left: 10px; color: white; font-size: 20px; cursor: pointer"></span>
				<style>
.navbar-brand a {
	font-size: 24px;
}

.navbar-brand a:hover {
	color: #ff4040;
}
</style>
			</div>

		</div>
		<div style="margin-right: 10px;">
			<ul class="nav navbar-nav pull-right feat"
				style="position: relative; top: 10px;">
				<li>

					<div class="dropdown">
						<a href="#"
							style="position: relative; top: -10px; left: 0; background: none">
							<span class="badge"
							style="background: #39c; color: white; position: relative; top: -12px; left: 10px; font-size: 9px;">5</span>
							<span class="glyphicon glyphicon-bell"
							style="font-size: 18px; color: #ff4040"></span>
						</a>
						<button class="empty" style="background: none;" type="button"
							id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="true">
							<div class="media" style="width: 160px">
								<div class="media-left media-middle">
									<img src="default-avatar-plaid-shirt-guy.png"
										class="media-object" style="width: 30px; border-radius: 100%">
								</div>
								<div class="media-body">
									<h4 class="media-heading"></h4>
									<p style="color: white;">
										Ly Phuc Sang <span class="caret"></span>
									</p>

								</div>

							</div>
							<style>
@media only screen and (max-width:426px) {
	.feat {
		width: 100%;
	}
}
</style>

						</button>
						<ul class="dropdown-menu" style="width: 1"
							aria-labelledby="dropdownMenu1">
							<li><a href="index.php?kind=profile-employ">Thông tin cá nhân</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Thoát</a></li>
						</ul>
					</div>
				</li>
			</ul>

		</div>
	</nav>
	<script>
        $(function () {
            $('.btn-list-feat').click(function () {
                $('.content .menu').toggleClass('visible-md-block');
                $('.content .menu').toggleClass('visible-lg-block');
            });
        });
    </script>
	<div class="content ">
		<div
			class="col-md-3 col-sm-12 col-xs-12 menu visible-md-block visible-lg-block"
			style="background: #313332;">
			<script>
                $(function () {
                    $('.list-feat > li').click(function () {
                        $(this).toggleClass('active');
                        $(this).children('ul').slideToggle();
                        //if ($(this).hasClass('active')) {
                        //    $(this).children('ul').slideDown;
                        //}
                    });
                });
            </script>
			<ul class="list-feat">
				<li>
					<div>
						<span class="glyphicon  glyphicon-user" style="color: white;"></span>
						Nhân viên <span
							class="pull-right glyphicon glyphicon-minus plus"
							style="color: #ff4040"></span>
					</div>

					<ul>
						<li><a href="index.php?kind=le">Danh sách</a></li>
						<li><a href="index.php?kind=profile-employ">Thông tin cá nhân</a></li>

					</ul>
				</li>
				<li>
					<div>
						<span class="glyphicon  glyphicon-home" style="color: white;"></span>
						Phòng ban<span
							class="pull-right glyphicon glyphicon-minus plus"
							style="color: #ff4040"></span>
					</div>

					<ul>
						<li><a href="index.php?kind=ld">Danh sách</a></li>

					</ul>
				</li>
				<li>
					<div>
						<span class="glyphicon  glyphicon-usd" style="color: white;"></span>
						Kế toán<span
							class="pull-right glyphicon glyphicon-minus plus"
							style="color: #ff4040"></span>
					</div>

					<ul>
						<li><a href="index.php?kind=lp">Xem thông tin</a></li>


					</ul>
				</li>
			</ul>
		</div>
		<div class="col-md-9 col-sm-12 col-xs-12" style="background: #ced8e6;">
<?php
if (isset($_GET["kind"])) {
    $kind = $_GET["kind"];
    switch ($kind) {
        case "le":
            include 'list-employ.php';
            break;
        case "ld":
            include 'list-dep.php';
            break;
        case "profile-employ":
            include 'profile-employ.php';
            break;
        case "lp":
            include "list-payment.php";
            break;
    }
}
?>
        </div>
	</div>

</body>
</html>