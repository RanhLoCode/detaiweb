<?php
if($_SERVER["REQUEST_METHOD"] == 'POST'){
       $errors=null;
       session_start();
        IF(isset($_SESSION['idpb']) && $_SESSION['idpb']=='NS'){
            include '../../database/cnt.php';
            include '../../model/nhanvien.php';
            include '../../model/phongban.php';
            $nvs = new nhanvien($db);
            $pbs = new phongban($db);

            $ten = trim($_POST['txtName']);
            $ngaysinh = trim($_POST['txtBirthday']);
            $mail = trim($_POST['txtMail']);
            $phongban = trim($_POST['txtPhongban']);
            $luong = trim($_POST['txtLuong']);
            $thue = trim($_POST['txtMsThue']);
            $id = trim($_POST['txtID']);

            // validate
            $tempTen = normalText($ten);
            $sprTen = "#^[a-zA-Z][a-zA-Z\s]{5,30}$#";
            if (!preg_match($sprTen, $tempTen)) {
                $errors[] = 'Tên không hợp lệ : a-z,A-Z,6-20 kí tự'.$tempTen;
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

            if (! isset($phongban) || ! $pbs->validatePB($phongban)) {
                $errors[] = 'Phòng ban không tồn tại';
            } else {
                if ($phongban == 'NS' && ! $_SESSION['isMn'])
                    $errors[] = 'Bạn không có quyền sửa nhân viên phòng nhân sự';
            }

            if (! isset($luong) || ! is_numeric($luong)) {
                $errors[] = 'Lương không hợp lệ' . $luong;
            }
            if ($thue==null) {
                $errors[] = 'Thuế không hợp lệ';
            }

            if (empty($errors)) {

                try {
                    $rs = $nvs->suanhanvien($ten, $ngaysinh, $mail, $phongban, $luong, $thue,$id);
                    if ($rs) {} else {
                        $errors[] = 'loi';
                    }
                } catch (Exception $e) {
                    $errors[] = 'loi : ' . $e->getMessage();
                }
            }
        }else {
            $errors[] ='Bạn không có quyền này ' ;
        }
    if ($errors == null) {
        $errors = array(
            'er' => false,
            "ms" => ''
        );
    } else {
        $errors = array(
            'er' => true,
            "ms" => $errors
        );
    }
    echo json_encode($errors);


}