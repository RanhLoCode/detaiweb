<?php

if($_SERVER['REQUEST_METHOD']=='POST') {
    $er=null;
    include '../../database/cnt.php';
    include '../../model/phongban.php';
    $pbs = new phongban($db);
    session_start();
    if (isset($_SESSION['idpb']) && $_SESSION['idpb'] == 'NS' && $_SESSION['isMn']) {
        if(!isset($_POST['txtPhongBan'])){
            $er[] ='Phong ban không hợp lệ';
        }
        if(!isset($_POST['txtNhanVien'])){
            $er[] ='Nhân viên không hợp lệ';
        }
        $check = $pbs->checkManager(null,$_POST['txtNhanVien']);

    } else {
        $er[]='Bạn không có quyền này';
    }

    if($er == null){
        $rs = $pbs->setManager($_POST['txtPhongBan'],$_POST['txtNhanVien']);
        if($rs){

        }else {
            $er[]='Thất bại !';
        }
    }
    if($er == null){
        $res = array(
            'er'=>false,
            'ms'=>'',
        );
    }else {
        $res = array(
            'er'=>true,
            'ms'=>$er,
        );
    }
    echo json_encode($res);

   /* echo '<pre>';
    print_r($_POST);
    echo '</pre>';*/
}