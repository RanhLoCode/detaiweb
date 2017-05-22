<?php
$ren['chooseManager'] = function () {
    ?>
    <script>

       // alert('work');
        app.directive('onFinishRender', function ($timeout) {
            return {
                restrict: 'A',
                link: function (scope, element, attr) {
                    if (scope.$last) {
                        $timeout(function () {
                            scope.$emit(attr.onFinishRender);
                        });
                    }
                }
            };
        });
        app.controller('chooseManager', function ($scope, $http) {

            $scope.xacnhan = function () {
                $('.er').html('');
                $http({
                    method: $('.frmChangeManager').attr('method'),
                    url: $('.frmChangeManager').attr('action'),
                    data: $('.frmChangeManager').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function (data) {
                    //alert(data);

                    if (data.er) {
                        for (i = 0; i < data.ms.length; i++)
                            $('.er').append("<p class='text-primary'>" + data.ms[i] + "</p>");
                    } else {
                        alert('Thành công');
                        $('.btn.close-hide').trigger('click');
                    }
                });
            };
            function GetDeps() {
                $http.get('controller/phongban/GetDeps.php').success(function (data) {
                    $scope.dspb = data;
                    $scope.txtPhongBan = data[0];
                });
            }

            GetDeps();
            function GetEmps(idpb) {

                $http.get('controller/nhanvien/DSNhanvien_PB.php', {params: {idpb: idpb}}).success(function (data) {
                    $scope.ListEmps = data;
                    //  alert(JSON.stringify(data));
                });
            }

            isFirst = true;
            GetEmps('KD');
            $scope.chooseDep = function () {
                isFirst = false;
                GetEmps($scope.txtPhongBan.ID);


            };
            $scope.$on('fn', function (fnEvent) {
                if (!isFirst)
                    supFc();
            });


        });
    </script>

    <?php
}
?>

<div ng-controller="chooseManager" class="modal fade" id="chooseManager" role="dialog" style="background-color:#313332;">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body">
                <form class="frmChangeManager" method="POST" action="controller/phongban/setManager.php">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="txtPhongBan"> Chọn phòng ban </label>
                                <select ng-change="chooseDep()" name="txtPhongBan" ng-model="txtPhongBan"
                                        ng-options="item.Ten for item in dspb track by item.ID"
                                        class="form-control" id="txtPhongBan"></select>
                            </div>


                            <div clas="form-group">
                                <button ng-click="xacnhan()" type="button" class="btn btn-primary">Lưu</button>
                                <button data-dismiss="modal" class="close-hide btn btn-danger">Đóng</button>
                            </div>
                            <div class="er" style="margin-top:10px"></div>

                        </div>
                        <div class="col-sm-6 ListEmps">

                            <div class="form-group" ng-repeat="Emps in ListEmps" on-finish-render="fn">
                                <label for="txtNhanVien"> Chọn nhân viên </label>
                                <div class="input-group">
                                    <span class="input-group-addon">

                                    <input value="" class="curList" type="radio" name="curList"/>

                                    </span>
                                    <select disabled="disabled" class="form-control txtNhanVien" id="txtNhanVien"
                                            name="txtNhanVien">
                                        <option ng-repeat="item in Emps" value="{{item.ID}}">{{item.Ten}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <script>

                            $(function () {
                                supFc = function () {
                                    $('.txtNhanVien').removeAttr('name');
                                    rd = $('.ListEmps > div:nth-child(1) .curList');
                                    rd.attr('checked', 'checked');
                                    rd.parent().next().removeAttr('disabled');
                                    rd.parent().next().attr('name', 'txtNhanVien');
                                    //  alert(rd.attr('class'));
                                };
                                $(document).on('click', '.notthis', function () {

                                    supFc();
                                });
                                /*
                                 $('#txtPhongBan').on('change',function(){
                                 supFc();
                                 });*/

                                $(document).on('change', '.curList', function () {
                                    $('.txtNhanVien').attr('disabled', 'disabled');
                                    $('.txtNhanVien').removeAttr('name');
                                    /* alert(
                                     $(this).is(':checked')
                                     );*/
                                    if ($(this).is(":checked")) {
                                        $(this).parent().next().removeAttr('disabled');
                                        $(this).parent().next().attr('name', 'txtNhanVien');
                                    }
                                });
                            });
                        </script>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>