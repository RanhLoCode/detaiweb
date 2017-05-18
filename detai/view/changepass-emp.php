<div class="">

    <h3>Thông tin</h3>
    <div>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="#"> Trang
                    chủ </a></li>
            <li><a href="?kind=le"> Nhân viên</a></li>
            <li><a href="">Đổi mật khẩu</a></li>
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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = $_SESSION['id'];
        }
           $info = $nvs->getInfo("Ten","ID = $id");
        ?>

        <div class="panel-body ">
            <?php
            if ($_SESSION['id'] == $id) {
                ?>
                <h3><?php echo $info['Ten'] . ' - ' .$id ?> </h3>
                <FORM class="frmChangePass" action="../controller/nhanvien/changepass.php" method="post">
                    <input value="<?php echo $id; ?>" name="id" type="hidden">
                    <div class="form-group">
                        <label for="txtOldPass">Mật khẩu cũ :</label>
                        <input name="txtOldPass" id="txtOldPass" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtNewPass">Mật khẩu mới :</label>
                        <input name="txtNewPass" id="txtNewPass" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtConfirmNewPass">Xác nhận mật khẩu :</label>
                        <input name="txtConfirmNewPass" id="txtConfirmNewPass" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtCaptcha">
                            Nhập mã xác nhận
                            <img src="../image/captcha.php" width="100px" class="img-rounded"/>
                        </label>
                        <input id="txtCaptcha" type="text" name="txtCaptcha" class="form-control"
                               style="margin-top:20px"/>
                    </div>
                    <div class="errors">

                    </div>
                    <button type="submit" class="btn btn-danger">
                        Xác nhận
                    </button>
                </FORM>
                <script>
                    $(function () {
                        $('.frmChangePass').submit(function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url:this.action,
                                    type:this.method,
                                    data:$(this).serialize(),
                                    cache:false,
                                    success:function(res){
                                     ///   alert(res);
                                        res = $.parseJSON(res);
                                        if(res.er){
                                              $('.errors').html('');
                                              for(i=0;i<res.ms.length;i++){
                                                  $('.errors').append('<p class="text-danger">'+res.ms[i]+'</p>');
                                              }
                                        }else {
                                            alert('Thành công');
                                            location.href="index.php?kind=profile-employ&id=<?php echo $_SESSION['id']?>";
                                        }
                                        $('.frmChangePass label img').attr('src',"<?php echo '../image/captcha.php'?>");
                                    }
                                });
                        });
                    });
                </script>
            <?php } else {
                $href = 'index.php?kind=changepass-employ&id=' . $_SESSION['id'];
                echo "<script>
                        location.href='$href';
                </script>";

            }
            ?>
        </div>


    </div>


</div>