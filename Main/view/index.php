
<?php
$title = "Quản trị";
$refs = array(
    '../css/index.css'
);
$refsJS = array(
    '../js/angularjs_1_4_8.min.js'
);
include 'topPage.php';

session_start();
if (! isset($_SESSION['tdn'])) {
    header('Location:login.php');
    exit();
}
include '../model/nhanvien.php';
include '../model/phongban.php';

$nvs = new nhanvien($db);
$row = $nvs->getInfo('IDPhongBan,Ten', $_SESSION['tdn']);

$_SESSION['idpb'] = $row['IDPhongBan'];
$_SESSION['ten'] = $row['Ten'];

$pbs = new phongban($db);

?>

<nav class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-header">
		<div class="navbar-brand">
			<a class="none-dec" href="#">Admin</a> <span
				class="btn-list-feat glyphicon glyphicon-menu-hamburger pull-right hidden-md hidden-lg"
				style="margin-left: 10px; color: white; font-size: 20px; cursor: pointer"></span>

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
						<div class="media" style="max-width: 200px;">
							<div class="media-left media-middle">
								<img src="../image/default-avatar-plaid-shirt-guy.png"
									class="media-object" style="width: 30px; border-radius: 100%">
							</div>
							<div class="media-body">
								<h4 class="media-heading"></h4>
								<p style="color: white;">
										<?php
        echo $_SESSION['ten'] . '/' . $pbs->getInfo('Ten', $row['IDPhongBan'])['Ten'];
        ;
        
        ?>
										  <span class="caret"></span>
								</p>

							</div>

						</div>

					</button>
					<ul class="dropdown-menu" style="width: 1"
						aria-labelledby="dropdownMenu1">
						<li><a href="index.php?kind=profile-employ">Thông tin cá nhân</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="exit.php">Thoát</a></li>
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
					Nhân viên <span class="pull-right glyphicon glyphicon-minus plus"
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
					Phòng ban<span class="pull-right glyphicon glyphicon-minus plus"
						style="color: #ff4040"></span>
				</div>

				<ul>
					<li><a href="index.php?kind=ld">Danh sách</a></li>

				</ul>
			</li>
			<li>
				<div>
					<span class="glyphicon  glyphicon-usd" style="color: white;"></span>
					Kế toán<span class="pull-right glyphicon glyphicon-minus plus"
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
}ELSE {
    $kind='le';
}
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

?>
        </div>
</div>

<?php include 'bottomPage.html';?>