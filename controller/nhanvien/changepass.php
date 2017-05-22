<?php
$er = null;
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id'])) {

    include '../../database/cnt.php';
    include '../../model/nhanvien.php';
    $nvs = new nhanvien($db);
    $id = $_POST['id'];
    $pass = $_POST['txtOldPass'];
    $newpass = $_POST['txtNewPass'];
    $cfnewpass = $_POST['txtConfirmNewPass'];
    $captcha = $_POST['txtCaptcha'];
    if ($id == null) {
        $er[] = 'ID tào lao';
    }
    if ($pass == null) {
        $er[] = 'Mật khẩu cũ trống';
    }
    if ($newpass == null) {
        $er[] = 'Mật khẩu mới trống';
    }
    if ($cfnewpass == null) {
        $er[] = 'Chưa xác nhận mật khẩu';
    }
    if ($cfnewpass != $newpass) {
        $er[] = 'Không khớp xác nhận';
    }
    IF ($captcha == null || md5(strtolower($captcha)) != $_SESSION['captcha']) {
        $er[] = 'Mã xác nhận không đúng';
    }
    if ($er == null) {

        $nv = $nvs->getInfo('MatKhau', "ID = $id");
        if (empty($nv)) {
            $er[] = 'Nhân viên không tồn tại';
        } else {
            $pass = md5($pass);
            if ($pass == $nv['MatKhau']) {
                $rs = $nvs->doimatkhau($id, md5($newpass));
                if ($rs) {

                } else {
                    $er[] = 'Thất bại';
                }
            } else {
                $er[] = 'Mật khẩu cũ không đúng';
            }
        }
    }

} else {
    $er[] = 'Lỗi';
}


if ($er == null) {
    $res = array(
        'er' => false,
        'ms' => ''
    );
} else {
    $res = array(
        'er' => true,
        'ms' => $er
    );
}
echo json_encode($res);