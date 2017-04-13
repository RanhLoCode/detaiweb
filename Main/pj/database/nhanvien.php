<?php

class nhanvien
{

    function nhanvien()
    {}

    function dangnhap($db, $tk, $mk)
    {
        $errors = array();
        try {
            if (empty($tk))
                $errors[] = 'Tên đăng nhập rỗng';
            $pttTk = '#^([a-zA-Z]|_)([a-zA-Z0-9]|_){4,19}#';
            if (! preg_match($pttTk, $tk)) {
                $errors[] = 'Tên đăng nhập không đúng định dạng : a-zA-Z0-9,_ , 5-20 kí tự';
            }
            
            if (empty($mk))
                $errors[] = 'Mật khẩu rỗng';
            $pttMk = '#([a-zA-Z0-9]|_){5,20}#';
            if (! preg_match($pttMk, $mk)) {
                $errors[] = 'Mật khẩu không đúng định dạng : a-zA-Z0-9,_ , 5-20 kí tự';
            }
            
            if (empty($errors)) {
                $mk = md5($mk);
                $qj = $db->prepare("select * from nhanvien where TenDangNhap = :tk and MatKhau = :mk");
                
                $qj->execute(array(
                    ':tk' => $tk,
                    ':mk' => $mk
                ));
               if(count($qj->fetchAll(PDO::FETCH_ASSOC))){
                   $errors =null;
               }else {
                   $errors[] ='Tên đăng nhập hoặt mật khẩu sai';
               }
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
        return $errors;
    }
}
?>