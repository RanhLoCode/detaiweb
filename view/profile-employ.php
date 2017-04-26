<div class="">

    <h3>Thông tin</h3>
    <div>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="#"> Trang
                    chủ </a></li>
            <li><a href="?kind=le"> Nhân viên</a></li>
            <li><a href="?kind=profile-employ"> Thông tin cá nhân</a></li>
        </ul>
    </div>

    <hr>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                <span class="glyphicon glyphicon-bullhorn"></span> Thông tin
            </div>

        </div>
        <?PHP

        if (isset($_GET['tdn'])) {
            $tdn = $_GET['tdn'];
        } else {
            $tdn = $_SESSION['tdn'];
        }
        $row = $nvs->getInfo('*', $tdn);
        $pb = $pbs->getInfo('Ten', $row['IDPhongBan'])['Ten'];

        ?>
        <?PHP

        if ($nvs->isExist($tdn)){
        IF ($_SESSION['idpb'] == 'NS' || $_SESSION['idpb'] == $row['IDPhongBan']){
        ?>
        <div class="panel-body ">
            <div class="media">
                <div class="media-left media-middle">
                    <?php
                    if ($_SESSION['tdn'] == $row['TenDangNhap']) {
                   ?>
                    <P class="text-success">
                        <span data-toggle="modal" data-target="#changeAvatar" class="glyphicon glyphicon-pencil"
                              STYLE="cursor: pointer"></span>
                    </P>
                    <div id="changeAvatar" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form action="../controller/nhanvien/changeAvatar.php" method="post"
                                  enctype="multipart/form-data" class="frmChangeAvatar">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <p class="modal-title">Đổi hình đại diện</p>
                                    </div>
                                    <DIV CLASS="modal-body">
                                        <div class="container-fluid text-center">
                                            <img CLASS="img-rounded avatar"
                                                 src="../image/avatar/<?php echo $row['Hinh'] ?>" width="50%"/>
                                        </div>
                                        <input type="hidden" value="<?php echo $row['ID'] ?>" name="ID">

                                        <input class="txtAvatar" STYLE="margin-top:10px;" CLASS="form-control"
                                               type="file" name="txtAvatar" accept="image/x-png, image/gif, image/jpeg">
                                        <button STYLE="margin-top:10px;" CLASS="btn btn-success" type="submit">
                                            Lưu lại
                                        </button>
                                    </DIV>
                                </div>
                            </form>
                            <script>
                                $('.txtAvatar').change(function (event) {
                                    var tmppath = URL.createObjectURL(event.target.files[0]);
                                    $(".avatar").attr('src', tmppath);
                                });
                                $('.frmChangeAvatar').submit(function (e) {
                                    e.preventDefault();
                                    $.ajax({
                                        url: this.action,
                                        type: this.method,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        data: new FormData(this),
                                        success: function (dt) {
                                        //     alert(dt);
                                            dt = $.parseJSON(dt);
                                            if (dt.er) {
                                                for (i = 0; i < dt.ms.length; i++) {
                                                    alert(dt.ms[i] + '\n');
                                                }
                                            } else {
                                                alert('Thành công');
                                                location.reload();
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <?php }?>
                    <img class="img-rounded" src="../image/avatar/<?php echo $row['Hinh'] ?>"
                         width="150"/>

                </div>
                <div CLASS="media-body">
                    <h1 class="media-heading"><?php echo $row['Ten'] ?></h1>
                    <p>
                        <span>ID</span>: <?php echo $row['ID'] ?>
                    </p>
                    <?php
                    if ($_SESSION['tdn'] == $row['TenDangNhap']) {
                        ?>
                        <p>
                            <span>Tên đăng nhập </span>: <?php echo $row['TenDangNhap'] ?>
                        </p>
                    <?php } ?>
                    <p>
                        <span>Ngày sinh</span>: <?php echo $row['NgaySinh'] ?>
                    </p>
                    <p>
                        <span>Mail</span>: <?php echo $row['Mail'] ?>
                    </p>
                    <p>
                        <span>Phòng ban</span>:<?php echo $pb ?>
                    </p>
                    <p>
                        <span>Lương</span>: <?php echo $row['Luong'] ?>
                    </p>
                    <p>
                        <span>Mã số thuế</span>: <?php echo $row['MaSoThue'] ?>
                    </p>
                </div>
            </div>
        </div>
        <?php if ($_SESSION['idpb'] == 'NS'){
        if ($row['IDPhongBan'] != 'NS' || ($row['IDPhongBan'] == 'NS' && $_SESSION['isMn'])){
        ?>
        <div class="panel-footer edit-pen" style="cursor:pointer">
            <span class="glyphicon glyphicon-pencil"></span>Chỉnh sửa
            <script>
                $(function () {
                    $('.edit-pen').click(function () {
                        $('.edit-info').slideToggle();

                    });

                });
            </script>
        </div>

    </div>

    <div style="display: none" class="edit-info panel panel-danger">
        <form action="../controller/nhanvien/editEmploy.php" method="post">
            <div class="panel-heading">
                <h3 class="panel-title">Sửa - <?php echo $row['ID'] ?></h3>
            </div>
            <div class="panel-body">
                <input name="txtID"
                       class="form-control" VALUE=" <?php echo $row['ID'] ?>"/>
                <div class="form-group">
                    <label for="txtName">Tên</label> <input id="txtName" name="txtName"
                                                            class="form-control" VALUE=" <?php echo $row['Ten'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="txtBirthday">Ngày sinh</label>
                    <div class='input-group date' id='txtBirthday'>
                        <input name="txtBirthday" value="01/01/1992" type='text' value=" <?php echo $row['NgaySinh'] ?>"
                               class="form-control"/> <span class="input-group-addon"> <span
                                    class="glyphicon glyphicon-calendar"> </span>
						</span>
                    </div>
                    <script
                            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                    <script src="../js/moment.min.js"></script>
                    <script src="../bootstrap/bootstrap-datetimepicker.min.js"></script>

                    <script type="text/javascript">


                        $(function () {
                            $('#txtBirthday').datetimepicker({
                                format: "YYYY-mm-DD"
                            });
                        });
                    </script>
                </div>
                <div class="form-group">
                    <label for="txtMail">Mail</label> <input id="txtMail" value="<?php echo $row['Mail'] ?>"
                                                             name="txtMail" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtPhongban">Phòng ban</label>
                    <select
                            class="form-control" name="txtPhongban" id="txtPhongban">
                        <?php
                        $listPb = $pbs->dsphongban("ID,Ten");
                        while ($item = $listPb->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option <?php if ($item["ID"] == $row['IDPhongBan']) echo 'selected="selected"'; ?>
                                    value="<?php echo $item["ID"] ?>"><?php echo $item['Ten'] ?></option>
                            <?php
                        }

                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="txtLuong">Lương</label> <select class="form-control"
                                                                name="txtLuong" id="txtLuong">
                        <?php
                        for ($i = 10; $i <= 100; $i++) {

                            ?>

                            <option <?php if ($row['Luong'] == $i) echo 'selected="selected"'; ?>
                                    value="<?php echo $i ?>"><?php echo $i ?>$
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtMsThue">Mã số thuế</label>
                    <input value=" <?php echo $row['MaSoThue'] ?>"
                           class="form-control" name="txtMsThue" id="txtMsThue">


                    </input>
                </div>
                <div class="er">

                    <script>
                        $(function () {
                            $('.edit-info form').submit(function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url: this.action,
                                    type: this.method,
                                    data: $(this).serialize(),
                                    success: function (dt) {
                                        dt = $.parseJSON(dt);
                                        if (dt.er) {
                                            $('.er').html('');
                                            for (i = 0; i < dt.ms.length; i++) {
                                                $('.er').append("<p class='text-warning'>" + dt.ms[i] + "</p>");
                                            }
                                        } else {
                                            alert('Thành công');
                                            location.reload();
                                        }


                                    }

                                });

                            });
                        });

                    </script>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span>Xác nhận
                </button>
            </div>
        </form>
    </div>


    <?php }
    }
    }
    } else {
        echo '<p class="text-warning" style="padding: 10px">Nhân viên không tồn tại</p>';
    } ?>


</div>