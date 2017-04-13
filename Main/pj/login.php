<?php $title ="Đăng nhập vào quản trị";?>
<?php include 'topPage.php'?>
<style>
body {
	background: #313332;
}
</style>
<div class="text-center">
	<h1 style="margin-top: 100px; color: #39C">SPT</h1>
</div>
<br />
<form method="post" action="login.php" class="col-sm-6 col-sm-offset-3 "
	style="background-color: rgba(255, 255, 255, 0.07); padding: 10px; BORDER-radius: 10px;">
	<h3 class="text-center" style="color: white">
		<b> ĐĂNG NHẬP </b>
	</h3>
	<div class="input-group" style="margin-top: 10px">
		<span class="input-group-addon"
			style="background-color: #FF4040; COLOR: #ced8e6"><span
			class="glyphicon glyphicon-user pull-left"></span></span> <input
			type="text" name="txtTk" class="form-control length-text"
			placeholder="Nhập tài khoản..."> <span class="input-group-addon"
			style="background-color: #39c; color: white">0/20</span>

	</div>
	<div class="input-group" style="margin-top: 10px">
		<span class="input-group-addon"
			style="background-color: #FF4040; COLOR: #ced8e6"><span
			class="glyphicon glyphicon-lock pull-left"></span></span>
			 <input
			name="txtMk" class="form-control length-text" type="password"
			placeholder="Nhập mật khẩu..." /> 
			<span class="input-group-addon"
			style="background-color: #39c; color: white">0/20</span>

	</div>
	<script type="text/javascript">
$(function(){

	$('.length-text').on('input',function(){
		var str=$(this).val();
	
		if(str.length > 20){
			str = str.substring(0,20);
				$(this).val(str);
				
		}
		$(this).next().text(str.length+'/20');
	
		
	});
});
	</script>
            	
			    <?php
    if (isset($_POST["btnLogin"])) {
         include 'database/nhanvien.php';
        $nvs = new nhanvien();
        $tk = $_POST['txtTk'];
        $mk = $_POST['txtMk'];
        $errors = $nvs->dangnhap($db, $tk, $mk);
       
        if (!empty($errors)) {
            echo '<p></p>';
            foreach ($errors as $value) {
                echo '<p class="text-danger">' . $value . '</p>';
            }
            
            echo "<script>
            $('input[name=\"txtTk\"]').val( '$tk');
            $('input[name=\"txtMk\"]').val( '$mk');
            </script>";
        } else {
            header('Location:index.php');
        }
    }
    ?>
			
            <hr>
	<button name="btnLogin" class="btn btn-info form-group pull-right "
		style="border-radius: 0; margin-top: 10px" type="submit">
		Login <span class="glyphicon glyphicon-circle-arrow-right"></span>
	</button>
	<a href="#" class="btn btn-link form-group"  data-toggle="popover" data-trigger="focus" data-content="Vui lòng liên hệ phòng nhân sự"
		style="border-radius: 0; color: white; margin-top: 10px">Quên mật
		khẩu?</a>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

</form>


<?php include 'bottomPage.html';?>