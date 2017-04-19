<div class="">

    <h3>Nhân viên</h3>
    <div>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="#"> Home
                </a></li>
            <li><a href="#"> Nhân viên</a></li>
        </ul>
    </div>
    <?php if ($_SESSION['idpb'] == 'NS') { ?>
        <div CLASS="row">
            <div class="col-md-12">
                <a data-toggle="modal" data-target="#addEmp" href="#"
                   class="btn btn-success " style="border-radius: 0"> Thêm nhân viên <span
                            class="glyphicon glyphicon-plus"> </span>
                </a>
            </div>
            <div id="addEmp" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 80%">
                    <form action="../controller/nhanvien/addEmploy.php" method="post">
                        <div class="modal-content">

                            <div class="modal-body">
                                <button class="close" data-dismiss="modal">&times;</button>
                                <div class="form-group">
                                    <label for="txtName">Tên</label> <input id="txtName"
                                                                            name="txtName" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="txtBirthday">Ngày sinh</label>
                                    <div class='input-group date' id='txtBirthday'>
                                        <input name="txtBirthday" value="1992-01-01" type='text'
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
                                    <label for="txtMail">Mail</label> <input id="txtMail"
                                                                             name="txtMail" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="txtPhongban">Phòng ban</label> <select
                                            class="form-control" name="txtPhongban" id="txtPhongban">
                                        <?php
                                        $listPb = $pbs->dsphongban("ID,Ten");
                                        while ($item = $listPb->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <option value="<?php echo $item["ID"] ?>"><?php echo $item['Ten'] ?></option>
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

                                            <option value="<?php echo $i ?>"><?php echo $i ?>$</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtMsThue">Mã số thuế</label> <input
                                            type="number" class="form-control" name="txtMsThue"
                                            id="txtMsThue"/>
                                </div>
                                <div class="form-group">
                                    <label for="txtMk">Mật khẩu</label> <input type="password"
                                                                                 class="form-control" name="txtMk"
                                                                                 id="txtMk"/>
                                </div>
                                <div class="form-group">
                                    <label for="txtMk_r">Xác nhận Mật khẩu</label> <input
                                            type="password" class="form-control" name="txtMk_r"
                                            id="txtMk_r"/>
                                </div>
                                <div class="form-group">
                                    <label for="txtCaptcha">
                                    Nhập mã xác nhận
                                    <img src="../image/captcha.php"  width="100px" class="img-rounded"/>
                                    </label>
                                        <input id="txtCaptcha" type="text" name="txtCaptcha" class="form-control" style="margin-top:20px"/>
                                </div>
                                <div class="err">
                                    <script>
                                        $('#addEmp form').submit(function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                url: this.action,
                                                type: this.method,
                                                data: $(this).serialize(),
                                                success: function (dt) {

                                                    dt = $.parseJSON(dt);

                                                    if (dt.er) {
                                                        $('.err').html('');
                                                        ers = dt.dt;
                                                        for (i = 0; i < ers.length; i++)
                                                            $('.err').append('<p class="text-primary">' + ers[i] + '</p>');
                                                    } else {
                                                        alert(dt.dt);
                                                        location.reload();

                                                    }
                                                    $('#addEmp form label img').attr('src',"<?php echo '../image/captcha.php'?>");

                                                },

                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Xác nhận</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <hr>
    <div class="panel panel-primary" style="border-radius: 0" ng-app="dsnv">
        <div class="panel-heading">
            <div class="panel-title">
                <span class="glyphicon glyphicon-bullhorn"></span> Danh sách
            </div>

        </div>
        <div class="panel-body " ng-controller="dsnv">

            <form class="form-horizontal">


                <div class="col-md-6 col-sm-6">
                    <div class="form-group ">
                        <div class="col-xs-4 col-sm-4">
                            <select ng-model="selRecord"
                                    ng-change="getDataFllowRc(selRecord)"
                                    ng-options="item for item in nRecord" class="form-control"
                                    style="border-radius: 0">

                            </select>
                        </div>

                        <label class="col-xs-5 col-sm-3 "
                               style="padding-top: 5px; font-weight: normal"> số dòng </label>

                    </div>
                </div>
                <div class="col-md-6 col-sm-6">

                    <input type="text" placeholder="Search" class="form-control"
                           style="border-radius: 0"/>

                </div>
            </form>


            <div class="table table-responsive">
                <div class=" pull-right">
                    <ul class="employ pagination">
                        <li ng-repeat="item in pages" ng-click="nextPage(item.text)"><a
                                    style="cursor: pointer; color: {{item.cl}}">{{item.text}}</a></li>
                    </ul>
                </div>
                <table class="table table-bordered">
                    <thead class="text-danger text-center">
                    <tr>
                        <th><span ng-click="order('ID')"
                                  style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                  class="glyphicon glyphicon-glass"></span>ID
                        </th>
                        <th>Hình đai diện</th>
                        <th><span ng-click="order('Ten')"
                                  style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                  class="glyphicon glyphicon-glass"></span>Tên
                        </th>
                        <th>Ngày sinh</th>
                        <th>Email</th>
                        <th>Phòng ban</th>
                        <?php if ($_SESSION['idpb'] == 'NS' || $_SESSION['idpb'] == 'KT') { ?>
                            <th><span ng-click="order('Luong')"
                                      style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                      class="glyphicon glyphicon-glass"></span>Lương
                            </th>

                            <th>Mã số thuế</th>
                        <?php } ?>
                        <?php if ($_SESSION['idpb'] == 'NS') { ?>
                            <th></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr CLASS="text-center"
                        ng-repeat="item in items | orderBy:myorder">
                        <td>{{item.ID}}</td>
                        <td><img class="img-rounded"
                                 src="../image/avatar/default-avatar.png" height="50"
                                 alt="dit"></td>
                        <td>{{item.Ten}}</td>
                        <td>{{item.NgaySinh}}</td>
                        <td>{{item.Mail}}</td>
                        <td>{{item.TenPB}}</td>
                        <?php if ($_SESSION['idpb'] == 'NS' || $_SESSION['idpb'] == 'KT') { ?>
                            <td>{{item.Luong}}</td>

                            <td>{{item.MaSoThue}}</td>
                        <?php } ?>
                        <?php if ($_SESSION['idpb'] == 'NS') { ?>
                            <td>
                                <a href="index.php?kind=profile-employ&id={{item.ID}}"><span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                <a class="delEmploy" href="../controller/nhanvien/delEmploy.php?id={{item.ID}}"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        <?php } ?>
                    </tr>

                </table>
                <?php if ($_SESSION['idpb'] == 'NS') { ?>
                    <script>
                        $('body').on('click', '.delEmploy', function (e) {
                            e.preventDefault();
                            r = $(this).parents('tr');
                            if (confirm('Chắc muốn xóa ?')) {
                                $.ajax({
                                    url: $(this).attr('href'),
                                    type: 'get',
                                    success: function (rs) {
                                        rs = $.parseJSON(rs);
                                        if (rs.er) {
                                            ms = "";
                                            for (i = 0; i < rs.ms.length; i++) {
                                                ms += rs.ms[i] + "\n";
                                            }
                                            alert(ms);
                                        } else {
                                            alert('Thàng công');
                                            r.remove();
                                        }
                                    }
                                })
                                ;

                            }
                        });
                    </script>

                <?php } ?>
                <SPAN class="pull-left">Bạn đang xem {{selRecord}} trong {{total}}
					nhân viên</SPAN>
                <ul class="employ pagination  pull-right">
                    <li ng-repeat="item in pages" ng-click="nextPage(item.text)"><a
                                style='cursor: pointer; color: {{item.cl}}'>{{item.text}}</a></li>
                </ul>


                <script>
                    function getPageContent(sv, sc, pageIndex, rowPage) {
                        sv.get('../controller/nhanvien/dsnhanvien_theopb.php', {
                            params: {
                                pageIndex: pageIndex,
                                rowPage: rowPage
                            }
                        }).then(function (res) {

                            sc.total = res.data.total;
                            sc.items = res.data.data;
                            sc.pages = [];
                            n = res.data.rowEachPage;
                            var pI = res.data.pageIndex;
                            for (i = 1; i <= n; i++) {
                                cl = '';
                                if (pI == i) {
                                    cl = 'red';
                                }
                                sc.pages.push({'text': i, 'cl': cl});

                            }
                            sc.nRecord = [10, 20, 30, sc.total];
                        });
                    }
                    app = angular.module('dsnv', []);
                    app.controller('dsnv', function ($scope, $http) {

                        getPageContent($http, $scope, 1, 10);
                        $scope.selRecord = 10;
                        $scope.nextPage = function (index) {
                            getPageContent($http, $scope, index, $scope.selRecord);
                        };
                        $scope.getDataFllowRc = function (rc) {
                            getPageContent($http, $scope, 1, rc);
                        };
                        $scope.order = function (field) {

                            $scope.myorder = field;
                        };
                    });


                </script>

            </div>


        </div>
        <div class="panel-footer"></div>

    </div>


</div>