
<div class="">

	<h3>Thông tin</h3>
	<div>
		<ul class="breadcrumb">
			<li><span class="glyphicon glyphicon-home"></span> <a href="#"> Trang
					chủ </a></li>
			<li><a href="#"> Thông tin cá nhân</a></li>
		</ul>
	</div>

	<hr>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
				<span class="glyphicon glyphicon-bullhorn"></span> Thông tin
			</div>

		</div>
		<div class="panel-body ">
			<div class="media">
				<div class="media-left">
					<img class="img-rounded" src="default-avatar-plaid-shirt-guy.png"
						width="150" />
				</div>
				<div CLASS="media-body">
					<h1 class="media-heading">Phúc Sáng</h1>
					<p>
						<span>ID</span>: 12222
					</p>
					<p>
						<span>Tên</span>: 12222
					</p>
					<p>
						<span>Ngày sinh</span>: 12222
					</p>
					<p>
						<span>Mail</span>: 12222
					</p>
					<p>
						<span>Phòng ban</span>:222 - 12222
					</p>
					<p>
						<span>Lương</span>: 12222
					</p>
					<p>
						<span>Mã số thuế</span>: 12222
					</p>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<span class="glyphicon glyphicon-pencil"></span>Chỉnh sửa
		</div>

	</div>
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Sửa - 12</h3>
		</div>
		<div class="panel-body">
			<form action="" method="post">
				<div class="form-group">
					<label for="txtName">Tên</label> <input id="txtName" name="txtName"
						class="form-control" />
				</div>
				<div class="form-group">
					<label for="txtBirthday">Ngày sinh</label>
					<div class='input-group date' id='txtBirthday'>
						<input name="txtBirthday" value="01/01/1992" type='text' class="form-control" /> <span
							class="input-group-addon"> <span
							class="glyphicon glyphicon-calendar"> </span>
						</span>
					</div>
					<script
						src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
					<script src="moment.min.js"></script>
					<script src="bootstrap-datetimepicker.min.js"></script>

					<script type="text/javascript">
				
								
            $(function () {
                $('#txtBirthday').datetimepicker({
               	 format: "DD-mm-YYYY"
                    });
            });
        </script>
				</div>
				<div class="form-group">
					<label for="txtMail">Mail</label> <input id="txtMail" name=""
						txtMail""
						class="form-control" />
				</div>
				<div class="form-group">
					<label for="txtPhongban">Phòng ban</label> <select
						class="form-control" name="txtPhongban" id="txtPhongban">
						<option>BN</option>
						<option>BN</option>
						<option>BN</option>
						<option>BN</option>
						<option>BN</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtLuong">Lương</label> <select class="form-control"
						name="txtLuong" id="txtLuong">
						<?php
    for ($i = 10; $i <= 100; $i ++) {
        
        ?>
						
						<option><?php echo $i?>$</option>
						<?php
    }
    ?>
					</select>
				</div>
				<div class="form-group">
					<label for="txtMsThue">Mã số thuế</label> <select
						class="form-control" name="txtMsThue" id="txtMsThue">


						<option>44444</option>

					</select>
				</div>
				<button type="submit" class="btn btn-success">
					<span class="glyphicon glyphicon-ok"></span>Xác nhận
				</button>
			</form>
		</div>
	</div>











</div>