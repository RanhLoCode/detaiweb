<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $errors=null;
    $tdn='';
    if ($_SESSION['idpb'] == 'NS') {
        try {
            include '../../database/cnt.php';
            include '../../model/nhanvien.php';
            include '../../model/phongban.php';
            $nvs = new nhanvien($db);
            $pbs = new phongban($db);

            $ten = $_POST['txtName'];
            $ngaysinh = $_POST['txtBirthday'];
            $mail = $_POST['txtMail'];
            $phongban = $_POST['txtPhongban'];
            $luong = $_POST['txtLuong'];
            $thue = $_POST['txtMsThue'];


            $tdn = normalText_2($ten) . '_' . $mail;
            $mk = $_POST['txtMk'];
            $mk_r = $_POST['txtMk_r'];
            $captcha = $_POST['txtCaptcha'];

            // validate
            $tempTen  = normalText($ten);
            $sprTen = "#^[a-zA-Z]([a-zA-Z]|\\s){5,20}#";
            if (!preg_match($sprTen,$tempTen)) {
                $errors[] = 'Tên không hợp lệ : a-z,A-Z,6-20 kí tư '.$tempTen;
            }
            $date = DateTime::createFromFormat('Y-m-d', $ngaysinh);
            $date_errors = DateTime::getLastErrors();
            if ($date_errors['warning_count'] + $date_errors['error_count'] > 0) {
                $errors[] = 'Ngày sinh không hợp lệ : yyyy-mm-dd';
            }

            $sprMail = "#^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$#";
            if (!preg_match($sprMail, $mail)) {
                $errors[] = 'Mail không hợp lệ : vd : aaaaaa@xxxxxx.yyyyyy';
            }

            if (!isset($phongban) || !$pbs->validatePB($phongban)) {
                $errors[] = 'Phòng ban không tồn tại';
            } else {
                if ($phongban == 'NS' && !$_SESSION['isMn'])
                    $errors[] = 'Bạn không có quyền thêm nhân viên phòng nhân sự';
            }

            if (!isset($luong) || !is_numeric($luong)) {
                $errors[] = 'Lương không hợp lệ' . $luong;
            }
            if ($thue==null) {
                $errors[] = 'Thuế không hợp lệ';
            }
            $pttMk = '#([a-zA-Z0-9]|_){3,100}#';
            if (!preg_match($pttMk, $mk)) {
                $errors[] = 'Mật khẩu không đúng định dạng : a-zA-Z0-9,_ , 3-100 kí tự';
            } else
                if ($mk != $mk_r) {
                    $errors[] = 'Mật khẩu xác nhận không khớp';
                }
            if (!isset($captcha) || $captcha == null) {
                $errors[] = 'Captcha không hợp lệ !';
            } else {
                IF ($_SESSION['captcha'] != md5($captcha)) {
                    $errors[] = 'Captcha không đúng !';
                }
            }
            if (empty($errors)) {
                $mk = md5($mk);


                    $rs = $nvs->themnhanvien($ten, $ngaysinh, $mail, $phongban, $luong, $thue, $tdn, $mk, 'default-avatar.png');
                    if ($rs) {
                    } else {
                        $errors[] = 'loi';
                    }

            }
        }catch(Exception $e){
            $errors[] ='Loi : '. $e->getMessage();
        }
        } else {
            $errors[] = 'Bạn không có quyền này !';
        }

    if ($errors == null) {
        $errors = array(
            'er' => false,
            "dt" => "Tên đăng nhập của bạn là : $tdn"
        );
    } else {
        $errors = array(
            'er' => true,
            "dt" => $errors
        );
    }
    
    echo json_encode($errors);
}
/*include '../../database/cnt.php';
include '../../model/nhanvien.php';
include '../../model/phongban.php';
$nvs =new nhanvien($db);

ECHO $nvs->normalText("á á");*/
?>