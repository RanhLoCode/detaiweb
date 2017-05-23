<?php if ($_SESSION['idpb'] == 'NS' && $_SESSION['isMn']) { ?>
    <div class="">

        <h3>Quản lý thông tin</h3>
        <div>
            <ul class="breadcrumb">
                <li><span class="glyphicon glyphicon-home"></span> <a href="quan-tri"> Trang
                        chủ </a></li>
                <li><a href=""> Thông tin</a></li>
            </ul>
        </div>

        <hr>
        <div class="panel panel-primary" style="border-radius: 0">
            <div class="panel-heading">
                <div class="panel-title">
                    <span class="glyphicon glyphicon-bullhorn"></span> Lịch sử thay đổi
                </div>

            </div>
            <div class="panel-body" ng-controller="change-history">

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


                    </div>
                </form>
                <div class=" pull-right">
                    <ul class="pagination">
                        <li ng-repeat="item in pages" ng-click="selPage(item.vl)"><a href="#" onclick="return false"
                                                                                     STYLE="color:{{item.cl}};"
                            >{{item.vl}}</a></li>
                    </ul>
                </div>
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-danger ">
                        <tr>
                            <th  style="  vertical-align:middle;" class="text-center" rowspan="2">STT</th>
                            <th class="text-center" colspan="2">Nhân viên thực thi
                            </th>
                            <th style="  vertical-align:middle;" class="text-center" rowspan="2">Ngày thực thi
                            </th>


                            <th rowspan="2">

                            </th>
                        </tr>
                        <tr class="text-center">
                            <td ng-click="setOrder('idnv')"><span
                                        style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                        class="glyphicon glyphicon-glass"></span>ID</td>
                            <td ng-click="setOrder('tennv')">
                                <span
                                        style="CURSOR: pointer; FONT-size: 10px; position: relative; left: 0; top: -10px; COLOR: #39c;"
                                        class="glyphicon glyphicon-glass"></span>
                                Tên</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center" ng-repeat="item in his | orderBy : order | filter : {'tennv':it}" >
                            <td>{{$index}}</td>
                            <td>{{item.idnv}}</td>
                            <td>{{item.tennv}}</td>
                            <td>{{item.date}}</td>
                            <td>
                                <button style="color:{{item.isRead}};" ng-click="show(item.note,item.id)" data-toggle="modal" data-target="#detail-info" class="btn btn-success">Chi tiết</button>
                            </td>

                        </tr>


                    </table>
                    <?php include 'change-info-detail.html' ?>
                    <div class=" pull-right">
                        <ul class="pagination">
                            <li ng-repeat="item in pages" ng-click="selPage(item.vl)"><a href="#" onclick="return false"
                                                                                      STYLE="color:{{item.cl}};"
                                >{{item.vl}}</a></li>
                        </ul>
                    </div>
                    <?php
                    $ren['manager'] = function () {
                        ?>
                        <script>
                            //xử lý danh sách thay đổi
                                app.controller('change-history',function($scope,$http){
                                    $scope.show = function(note,id){//hiện chi tiết
                                        $scope.note = note; //hiện thông tin
                                        //xác nhận xem và hiện lại danh sách
                                        $http({
                                            url:'controller/lichsuthaydoi/XacNhanXem.php',
                                            method:'POST',
                                            data : 'id='+id,
                                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                        }).success(function(dt){
                                            //alert(dt);
                                            if(dt){
                                                //
                                                conn.send('d');
                                           //     GetData(1,{id:1,s:10,vl:10});

                                            }else {
                                                alert('Xảy ra lỗi');
                                            }
                                        });
                                    };
                                    $scope.setOrder = function(field){
                                            $scope.order  =field;
                                    };
                                    //hiện danh sách
                                    GetData = function(pageIndex,rowPage){
                                        $http.get('controller/lichsuthaydoi/lichsuthaydoi.php',{params:{
                                            pageIndex:pageIndex,
                                            rowEachPage :rowPage.vl
                                        }}).success(function(data){
                                         // alert(JSON.stringify(data));
                                            $scope.pages =[];

                                            for(i=1;i<=data.totalPage;i++){

                                                cl='';
                                                if(i==pageIndex)
                                                    cl = 'red';
                                                $scope.pages.push({vl:i,cl:cl});

                                            }
                                            $scope.his = data.tb;
                                          //  alert(JSON.stringify(data.tb));
                                            $scope.nRecord = [
                                                {id:1,s:10,vl:10},
                                                {id:2,s:20,vl:20},
                                                {id:3,s:'Tất cả',vl:data.totalRow}
                                            ];
                                            $scope.selRecord = rowPage;
                                            curPage = pageIndex;
                                            curRow = rowPage;

                                        });



                                    };

                                    GetData(1,{id:1,s:10,vl:10});

                                    //chọn số dòng hiện thị
                                    $scope.getDataFllowRc = function (selRecord) {
                                        GetData(1, selRecord);
                                    };
                                    //chọn trang
                                    $scope.selPage = function (pageIndex) {
                                        GetData(pageIndex,curRow );
                                    };




                                });
                        </script>
                    <?php } ?>
                </div>


            </div>
            <div class="panel-footer"></div>

        </div>


    </div>
<?php } else { ?>
    <h1 class="text-danger">Bạn không có phận sự ở trang này</h1>
<?php } ?>
