<?php
if($_SERVER["REQUEST_METHOD"]=='GET'){
    session_start();
    $errors =null;
    if(isset($_SESSION['idpb']) && $_SESSION['idpb']=='NS') {
        $id = $_GET['id'];

        include '../../database/cnt.php';
        include '../../model/nhanvien.php';
        $nvs = new nhanvien($db);
        if(!isset($id) || !is_numeric($id)){
            $errors[] ='ID không hợp lệ';
        }
        if($errors==null) {
            try {
                $info =$nvs->getInfo_id('IDPhongBan', $id);//lấy id phòng ban của nv bị xóa
                if (count($info)) {//kiem tra có tồn tại nhân viên
                    if($info['IDPhongBan'] == 'NS' && !$_SESSION['isMn']){
                        $errors[]='Bạn không có quyền xóa nhân viên phòng nhân sự';
                    }else {
                        if ($nvs->xoanhanvien($id)) {
                        } else {
                            $errors[] = 'Thất bại';
                        }
                    }
                } else {
                    $errors[] = 'Nhân viên không tồn tại';
                }
            }catch(PDOException $e){
                $errors[] ='Lỗi : '.$e->getMessage();
            }
        }
    }else {
        $errors[] ='Bạn không có quyền này';
    }
    if($errors==null){
        $errors = array (
            'er'=>false,
            'ms'=>''
        );
    }else {
        $errors = array (
            'er'=>true,
            'ms'=>$errors
        );
    }
    echo json_encode($errors);
}