
<div class="">

	<h3>Nhân viên</h3>
	<div>
		<ul class="breadcrumb">
			<li><span class="glyphicon glyphicon-home"></span> <a href="#"> Home
			</a></li>
			<li><a href="#"> Nhân viên</a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="#" class="btn btn-success " style="border-radius: 0"> Thêm
				nhân viên <span class="glyphicon glyphicon-plus"> </span>
			</a>
		</div>
	</div>
	<hr>
	<div class="panel panel-primary" style="border-radius: 0">
		<div class="panel-heading">
			<div class="panel-title">
				<span class="glyphicon glyphicon-bullhorn"></span> Danh sách
			</div>

		</div>
		<div class="panel-body ">

			<form class="form-horizontal">


				<div class="col-md-6 col-sm-6">
					<div class="form-group ">
						<div class="col-xs-4 col-sm-4">
							<select class="form-control" style="border-radius: 0">
								<option value="">5</option>
								<option value="">6</option>
								<option value="">7</option>
							</select>
						</div>

						<label class="col-xs-5 col-sm-3 "
							style="padding-top: 5px; font-weight: normal"> số dòng </label>

					</div>
				</div>
				<div class="col-md-6 col-sm-6">

					<input type="text" placeholder="Search" class="form-control"
						style="border-radius: 0" />

				</div>
			</form>



			<div class="table table-responsive" ng-app="dsnv"
				ng-controller="dsnv">
				<div class=" pull-right">
					<ul class="employ pagination">
						<li ng-repeat="item in pages" ng-click="nextPage(item.text)"><a
							style="cursor:pointer;color: {{item.cl}}">{{item.text}}</a></li>
					</ul>
				</div>
				<table class="table table-bordered">
					<thead class="text-danger text-center">
						<tr>
							<th>ID</th>
							<th>Hình đai diện</th>
							<th>Tên</th>
							<th>Ngày sinh</th>
							<th>Email</th>
							<th>Phòng ban</th>
							<th>Lương</th>
							<th>Mã số thuế</th>
						</tr>
					</thead>
					<tbody>
						<tr CLASS="text-center" ng-repeat="item in items">
							<td>{{item.ID}}</td>
							<td><img class="img-rounded"
								src="../image/default-avatar-plaid-shirt-guy.png" height="50"
								alt="dit"></td>
							<td>{{item.Ten}}</td>
							<td>{{item.NgaySinh}}</td>
							<td>{{item.Mail}}</td>
							<td>{{item.TenPB}}</td>
							<td>{{item.Luong}}</td>
							<td>{{item.MaSoThue}}</td>

						</tr>
				
				</table>

				<div class=" pull-right">
					<ul class="employ pagination">
						<li ng-repeat="item in pages" ng-click="nextPage(item.text)"><a
							style="cursor:pointer;color: {{item.cl}}">{{item.text}}</a></li>
					</ul>
				</div>

				<script>
				app =	angular.module('dsnv',[]);
				app.controller('dsnv',function($scope,$http){
							$http.get('../controller/nhanvien/dsnhanvien_theopb.php').then(function(res){
								
								  $scope.items = res.data.data;
									$scope.pages=[];
									n = res.data.rowCount;
									var pI =res.data.pageIndex;
									for(i=1;i<=n;i++){
										cl='';
										if(pI == i){
											cl  = 'red';										
										}
										$scope.pages.push({'text':i,'cl':cl});
									
									}
									
								
								  
							});
							$scope.nextPage= function(index){
								$http.get('../controller/nhanvien/dsnhanvien_theopb.php',{params:{pageIndex:index}}).then(function(res){
									  $scope.items = res.data.data;
										$scope.pages=[];
								     	n = res.data.rowCount;
									var pI =res.data.pageIndex;
										for(i=1;i<=n;i++){
											cl='';
											if(pI == i){
												cl  = 'red';										
											}
											$scope.pages.push({'text':i,'cl':cl});
										} 
										
								});
							};
					});
					
				</script>

			</div>

			Đang xem 1 - 5 trong 100 nhân viên



		</div>
		<div class="panel-footer"></div>

	</div>











</div>