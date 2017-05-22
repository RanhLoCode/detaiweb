<?php
    $ren['luong'] = function () {
        ?>
        <script>

            app.controller('Sluong', function ($scope, $http) {
                function pageActive(pageIndex, curIndex) {
                    return pageIndex == curIndex ? "red" : '#39c';
                }
              //  alert('dd');
                function showData(pageIndex, rowPage) {
                    $http.get('controller/luong/thongtinluongs.php', {
                        params: {
                            pageIndex: pageIndex,
                            rowEachPage: rowPage.vl
                        }
                    }).success(function (res) {
                        // alert(res.length);
                        // alert(res);

                        $scope.pages = [];
                        for (i = 1; i <= res.totalPage; i++) {
                            $scope.pages.push(i);
                        }
                        $scope.luongs = res.tb;
                        $scope.pageActive = function (pi) {
                            return pageActive(pi, res.pageIndex);
                        }
                        $scope.nRecord = [{id: 1, s: 10, vl: 10}
                            , {id: 2, s: 20, vl: 20}
                            , {id: 3, s: 'Tất cả', vl: res.totalRow}];
                        $scope.selRecord = rowPage;
                    });
                }

                $scope.getDataFllowRc = function (selRecord) {
                    showData(1, selRecord);
                }
                $scope.selPage = function (pageIndex) {
                    showData(pageIndex,{id: 1, s: 10, vl: 10} );
                };
                $scope.order = function (field) {
                    $scope.order_ = field;
                };
                showData(1, {id: 1, s: 10, vl: 10});

                $scope.createActive = function (is) {
                    if (is == true) {

                        return 'text-success';
                    }
                    return 'text-danger';
                };
                $scope.phatluong = function (dk, id) {
                    if (dk) {
                        $http({
                            url:'controller/luong/phatluong.php',
                            method:'POST',
                            data : 'ID='+id,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (rs) {
                            // alert(rs);
                            if (rs.er) {
                                ms = "";
                                for (i = 0; i < rs.ms.length; i++) {
                                    ms += rs.ms[i] + "\n";
                                }
                                alert(ms);
                            } else {
                                alert('Thàng công');
                                showData(1, {id: 1, s: 10, vl: 10});
                            }
                        });

                    } else {
                        alert('Mới nhận tiền mà thím :v');
                    }


                };
            });
        </script>
        <?php
    }
?>
<?php if($_SESSION['idpb']=='KT'){?>
<div class="">

    <h3>Kế toán</h3>
    <div>
        <ul class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="quan-tri"> Trang
                    chủ </a></li>
            <li><a href=""> Kế toán</a></li>
        </ul>
    </div>

    <hr>
        <p STYLE="COLOr:#39c"><span class="glyphicon glyphicon-ok text-success"></span> : Đáp ứng </p>
        <p STYLE="COLOr:#39c"><span class="glyphicon glyphicon-ok text-danger"></span> : Không đáp ứng </p>
    <div class="panel panel-primary" style="border-radius: 0">
        <div class="panel-heading">
            <div class="panel-title">
                <span class="glyphicon glyphicon-bullhorn"></span> Bảng lương
            </div>

        </div>
        <div class="panel-body"  ng-controller="Sluong">

            <form class="form-horizontal">


                <div class="col-md-6 col-sm-6">
                    <div class="form-group ">
                        <div class="col-xs-4 col-sm-4">
                            <select ng-model="selRecord"
                                    ng-change="getDataFllowRc(selRecord)"
                                    ng-options="item as item.s for item in nRecord track by item.id" class="form-control"
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


                </div>
            </form>
            <div class="table table-responsive"  >
                <table class="table table-bordered">
                    <thead class="text-danger ">
                    <tr class="text-center">
                        <th><span ng-click="order('idnv')"
                                  style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                  class="glyphicon glyphicon-glass"></span>ID nhân viên</th>
                        <th><span ng-click="order('tennv')"
                                  style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                  class="glyphicon glyphicon-glass"></span>Tên nhân viên</th>
                        <th><span ng-click="order('luong')"
                                  style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                  class="glyphicon glyphicon-glass"></span>TLương</th>
                        <th>Mã số thuế</th>
                        <th>Ngày nhận lương lần cuối</th>
                        <th>Đủ ngày nhận lương</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="text-center" ng-repeat="item in luongs | orderBy : order_ | filter : {'tennv':it}">
                        <td>{{item.idnv}}</td>

                        <td>{{item.tennv}}</td>
                        <td>{{item.luong}}</td>

                        <td>{{item.msthue}}</td>

                        <td>{{item.ncnhanluong}}</td>

                        <td CLASS="{{createActive(item.dknhanluong)}}">
                            <span  class="glyphicon glyphicon-ok"> </span>
                        </td>
                        <td>
                            <button ng-click="phatluong(item.dknhanluong,item.idnv)" type="button"  class="btn btn-primary">Phát Lương</button>
                        </td>

                    </tr>


                </table>
                <div class=" pull-right">
                    <ul class="pagination">
                        <li  ng-repeat="item in pages" ng-click="selPage(item)"><a href="#" STYLE="color:{{pageActive(item)}};" ">{{item}}</a></li>
                    </ul>
                </div>
            </div>




        </div>
        <div class="panel-footer"></div>

    </div>


</div>
<?php }else {?>
<h1 class="text-danger">Bạn không có phận sự ở trang này</h1>
<?php }?>
