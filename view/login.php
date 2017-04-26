﻿<?php $title ="Đăng nhập vào quản trị";?>
<?php $refs = array('../css/fantasy-bg.css')?>
<?php

session_start();
if (isset($_SESSION['tdn'])) {
    header('Location:index.php');
}

include 'topPage.php'?>

<style>
body {
	background: #313332;
}
</style>
<div class="abs">
	<div class="fantasy-bg"></div>
	<div class="fantasy-bg-black-blur"></div>
</div>

<div class="text-center">
	<h1 style="margin-top: 100px; color: #39C">SPT</h1>
</div>
<br />
<form method="post" action="../controller/nhanvien/checklogin.php"
	class="frmLogin col-sm-6 col-sm-offset-3 "
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
			class="glyphicon glyphicon-lock pull-left"></span></span> <input
			name="txtMk" class="form-control length-text" type="password"
			placeholder="Nhập mật khẩu..." /> <span class="input-group-addon"
			style="background-color: #39c; color: white">0/20</span>

	</div>
	<DIV CLASS="errors text-danger" STYLE="margin-top: 10px"></DIV>
	<script type="text/javascript">
$(function(){
	$('.frmLogin').submit(function(e){
		e.preventDefault();
	
		$.ajax({
			url:this.action,
			type:this.method,
			data:$(this).serialize(),
			cache:'false',
			success:function(data){
				data = $.parseJSON(data);	
    			if(data.er){
    				$('.errors').html('');
        			len = data.dt.length;
        			for(i=0;i<len;i++){
    				$('.errors').append('<p>'+data.dt[i]+'</p>');
        			}
    			
    		    }else {
        
    				window.location='index.php';
    		    }
			}
		});
	
	});


	
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


	<hr>
	<button class="btn btn-info form-group pull-right "
		style="border-radius: 0; margin-top: 10px" type="submit">
		Login <span class="glyphicon glyphicon-circle-arrow-right"></span>
	</button>
	<a href="#" class="btn btn-link form-group" data-toggle="popover"
		data-trigger="focus" data-content="Vui lòng liên hệ phòng nhân sự"
		style="border-radius: 0; color: white; margin-top: 10px">Quên mật
		khẩu?</a>
	<script>
        $(function(){
            $('[data-toggle="popover"]').popover();   
        });
</script>

</form>

<DIV CLASS="clearfix"></DIV>
<?php include 'bottomPage.html';?>