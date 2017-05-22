<div class="">

    <h3>Nhân viên</h3>
    <div>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="nhan-vien/xem-danh-sach.html"> Trang chủ
                </a></li>
            <li><a href=""> Nhân viên</a></li>
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
                    <form action="controller/nhanvien/addEmploy.php" method="POST">
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
                                    <script src="js/moment.min.js"></script>
                                    <script src="bootstrap/bootstrap-datetimepicker.min.js"></script>

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
                                       $listPb = $pbs->GetDeps();
                                        foreach ($listPb as $item) {
                                            ?>
                                            <option value="<?php echo $item["ID"] ?>"><?php echo $item['Ten'] ?></option>
                                            <?php
                                       }

                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtLuong">Lương</label>
                                    <input type="number" class="form-control"
                                           value="10" name="txtLuong" id="txtLuong"/>

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
                                        <img src="image/captcha.php" width="100px" class="img-rounded"/>
                                    </label>
                                    <input id="txtCaptcha" type="text" name="txtCaptcha" class="form-control"
                                           style="margin-top:20px"/>
                                </div>
                                <div class="err">
                                    <script>
                                        $('#addEmp form').submit(function (e) {
                                            $('.err').html('');

                                            e.preventDefault();
                                            $.ajax({
                                                url: this.action,
                                                type: this.method,
                                                data: $(this).serialize(),
                                                success: function (dt) {
                                                   //  alert(dt);
                                                    dt = $.parseJSON(dt);

                                                    if (dt.er) {
                                                        $('#txtCaptcha').val('');
                                                        ers = dt.dt;
                                                        for (i = 0; i < ers.length; i++)
                                                            $('.err').append('<p class="text-primary">' + ers[i] + '</p>');
                                                    } else {
                                                        alert(dt.dt);
                                                     //   $('#addEmp form input').val('');
                                                        location.reload();

                                                    }
                                                    $('#addEmp form label img').attr('src', "<?php echo 'image/captcha.php'?>");

                                                },

                                            });

                                        });
                                    </script>
                                </div>
                           </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Xác nhận</button>
                                <button  type="button" data-dismiss="modal" class="btn btn-danger">
                                    Đóng
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php } ?>
    <hr>

    <div class="panel panel-primary" style="border-radius: 0">
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
                                    ng-options="item as item.s for item in nRecord track by item.id"
                                    class="form-control"
                                    style="border-radius: 0">

                            </select>
                        </div>

                        <label class="col-xs-5 col-sm-3 "
                               style="padding-top: 5px; font-weight: normal"> số dòng </label>

                    </div>
                </div>
                <div class="col-md-6 col-sm-6">

                    <input type="text" placeholder="Search tên nhân viên" ng-model="it" class="form-control"
                           style="border-radius: 0"/>
                    <?php
                    if ($_SESSION['idpb'] == 'NS') {
                        ?>
                        <select style="margin-top:10px" class="form-control" ng-change="chooseDep()" ng-model="it_pb">
                            <option value="" selected="selected">--Tìm theo phòng ban--</option>
                            <option ng-repeat="item in dspb" VALUE='{{item.Ten}}'>{{item.Ten}}</option>
                        </select>

                    <?php } ?>
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
                        ng-repeat="item in items | orderBy:myorder | filter:{'Ten':it,'TenPB':tenpb}">
                        <td>{{item.ID}}</td>
                        <td>
                            <a href="nhan-vien/thong-tin-nhan-vien-{{item.ID}}.html">
                                <img class="img-rounded"
                                     src="image/avatar/{{item.Hinh}}" height="50"
                                     alt="Lỗi">
                            </a>
                        </td>
                        <td>{{item.Ten}}</td>

                        <td>{{item.Mail}}</td>
                        <td>{{item.TenPB + item.isMn}}</td>
                        <?php if ($_SESSION['idpb'] == 'NS' || $_SESSION['idpb'] == 'KT') { ?>
                            <td>{{item.Luong}}</td>

                            <td>{{item.MaSoThue}}</td>
                        <?php } ?>
                        <?php if ($_SESSION['idpb'] == 'NS') { ?>
                            <td>
                                <a href="nhan-vien/thong-tin-nhan-vien-{{item.ID}}.html"><span
                                            class="glyphicon glyphicon-pencil"></span></a>
                                <a class="delEmploy" href="controller/nhanvien/delEmploy.php?id={{item.ID}}"><span
                                            class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        <?php } ?>
                    </tr>

                </table>
                <?php if ($_SESSION['idpb'] == 'NS') { ?>
                    <script>
                        function requestDel(a, fc) {
                            r = a.parents('tr');
                            cf = fc == 0 ? confirm('Chắc muốn xóa ?') : true;
                            if (cf) {
                                $.ajax({
                                    url: a.attr('href'),
                                    type: 'get',
                                    data: {focus: fc},
                                    success: function (rs) {
                                        //alert(rs); //check error
                                        rs = $.parseJSON(rs);
                                        if (rs.er) {
                                            ms = rs.ms;
                                            if (ms.length > 1) {
                                                s = "";
                                                for (i = 0; i < ms.length; i++) {
                                                    s += ms[i] + "\n";
                                                }
                                                alert(s);
                                            } else {
                                                if (ms[0] == "MN") {
                                                    if (confirm('Người này là trưởng phòng bạn có chắc xóa?')) {
                                                        requestDel(a, 1);
                                                    }
                                                } else {
                                                    alert(ms[0]);
                                                }
                                            }
                                        } else {
                                            alert('Thàng công');
                                            r.remove();
                                        }
                                    }
                                })
                                ;

                            }
                        }
                        $('body').on('click', '.delEmploy', function (e) {
                            e.preventDefault();
                            requestDel($(this), 0);
                        });
                    </script>

                <?php } ?>
                <SPAN class="pull-left">Bạn đang xem {{selRecord.vl}} trong {{total}}
					nhân viên</SPAN>
                <ul class="employ pagination  pull-right">
                    <li ng-repeat="item in pages" ng-click="nextPage(item.text)"><a
                                style='cursor: pointer; color: {{item.cl}}'>{{item.text}}</a></li>
                </ul>


            </div>


        </div>
        <div class="panel-footer"></div>

    </div>


</div>
<?php
$ren['dsnv'] = function () {
    ?>
    <script>
        app.controller('dsnv', function ($scope, $http) {

            function GetDeps() {
                $http.get('controller/phongban/GetDeps.php').success(function (data) {
                    $scope.dspb = data;
                });
            }

            GetDeps();

            $scope.chooseDep = function () {
                $scope.tenpb = ($scope.it_pb).toLowerCase();
                //alert($scope.tenpb);
            };

            function getPageContent(pageIndex, rowPage) {
                r = rowPage.vl;
                $http.get('controller/nhanvien/dsnhanvien_theopb.php', {
                    params: {
                        pageIndex: pageIndex,
                        rowPage: r
                    }
                }).then(function (res) {

                    $scope.total = res.data.total;
                    $scope.items = res.data.data;
                    $scope.pages = [];
                    n = res.data.rowEachPage;
                    var pI = res.data.pageIndex;
                    for (i = 1; i <= n; i++) {
                        cl = '';
                        if (pI == i) {
                            cl = 'red';
                        }
                        $scope.pages.push({'text': i, 'cl': cl});

                    }
                    $scope.nRecord = [{id: 1, s: '10', vl: 10}, {id: 2, s: '20', vl: 20}
                        , {id: 4, s: 'Tất cả', vl: $scope.total}];


                    $scope.selRecord = rowPage;
                });
            }

            getPageContent(1, {id: 1, s: '10', vl: 10});

            $scope.nextPage = function (index) {
                getPageContent(index, $scope.selRecord);
            };
            $scope.getDataFllowRc = function (rc) {
                getPageContent(1, rc);
            };
            $scope.order = function (field) {
                $scope.myorder = field;
            };
        });
    </script>
    <?php
}
?>