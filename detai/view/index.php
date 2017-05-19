<?php
include '../function/render.php';
$title = "Quản trị";
$refs = array(
    'css/index.css'
);
$refsJS = array(
    'js/angularjs_1_4_8.min.js'
);
include 'topPage.php';

session_start();
if (!isset($_SESSION['id'])) {

    header('Location:login.php');
    exit();
}
include '../model/nhanvien.php';
include '../model/phongban.php';

$nvs = new nhanvien($db);
$emp = $nvs->getEmploy($_SESSION['id']);


$pbs = new phongban($db);
$_SESSION['isMn'] = $pbs->checkManager($emp['IDPhongBan'], $emp['ID']);
$pb = $pbs->GetDep($emp['IDPhongBan']);
?>

    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-header">
            <div class="navbar-brand">
                <a class="none-dec" href="?">Admin</a> <span
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
                                    <img src="image/avatar/default-avatar.png"
                                         class="media-object" style="width: 30px; border-radius: 100%">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"></h4>
                                    <p style="color: white;">
                                        <?php
                                        $s = $emp['Ten'] . '/' . $pb['Ten'];

                                        if ($_SESSION['isMn'])
                                            $s .= '(TP)';
                                        ECHO $s;
                                        ?>
                                        <span class="caret"></span>
                                    </p>

                                </div>

                            </div>

                        </button>
                        <ul class="dropdown-menu"
                            aria-labelledby="dropdownMenu1">
                            <li><a href="nhan-vien/thong-tin-nhan-vien-<?php echo $_SESSION['id'] ?>.html">Thông tin cá
                                    nhân</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php?kind=changepass-employ&id=<?php echo $_SESSION['id'] ?>">Đổi mật
                                    khẩu</a></li>
                            <li><a href="dang-xuat">Thoát</a></li>
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
                    $('.list-feat > li:not(".notthis")').click(function () {
                        $(this).toggleClass('active');
                        $(this).children('ul').slideToggle();
                        //if ($(this).hasClass('active')) {
                        //    $(this).children('ul').slideDown;
                        //}
                    });
                    $('.list-feat > li > ul > li').click(function () {
                        location.href = $(this).children('a').attr('href');
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
                        <li><a href="nhan-vien/xem-danh-sach.html">Danh sách</a></li>
                        <li><a href="nhan-vien/thong-tin-nhan-vien-<?php echo $_SESSION['id'] ?>.html">Thông tin cá
                                nhân</a></li>

                    </ul>
                </li>
                <li>
                    <div>
                        <span class="glyphicon  glyphicon-home" style="color: white;"></span>
                        Quản lý sự thay đổi<span class="pull-right glyphicon glyphicon-minus plus"
                                                     style="color: #ff4040"></span>
                    </div>

                    <ul>
                        <li><a href="danh-sach-thay-doi">Danh sách</a></li>

                    </ul>
                </li>
                <li>
                    <div>
                        <span class="glyphicon  glyphicon-usd" style="color: white;"></span>
                        Kế toán<span class="pull-right glyphicon glyphicon-minus plus"
                                       style="color: #ff4040"></span>
                    </div>

                    <ul>
                        <li><a href="ke-toan">Xem thông tin</a></li>


                    </ul>
                </li>
                <?php
                if ($_SESSION['idpb'] == 'NS') {
                    ?>
                    <li class="notthis">


                        <div data-toggle="modal" data-target="#chooseManager">
                            <span class="glyphicon  glyphicon-apple" style="color: white;"></span>
                            Chọn trường phòng<span class="pull-right glyphicon glyphicon-minus plus"
                                                      style="color: #ff4040"></span>
                        </div>
                    </li>
                    <?php
                    include 'chooseManager.php';
                }

                ?>
            </ul>

        </div>
        <div class="col-md-9 col-sm-12 col-xs-12" style="background: #ced8e6;">
            <?php
            if (isset($_GET["kind"])) {
                $kind = $_GET["kind"];

            } else {
                $kind = 'le';
            }
            switch ($kind) {
                case "le":
                    include 'list-employ.php';
                    break;
                case "ld":
                    include 'manager.php';
                    break;
                case "profile-employ":
                    include 'profile-employ.php';
                    break;
                case "lp":
                    include "list-payment.php";
                    break;
                case "changepass-employ":
                    include "changepass-emp.php";
                    break;
            }

            ?>
        </div>
    </div>
    <script>

        app = angular.module('qlnv', []);


    </script>
<?php
InitPosRender("dsnv");
InitPosRender("manager");
InitPosRender('chooseManager');
InitPosRender("luong");
?>


<?php include 'bottomPage.html'; ?>