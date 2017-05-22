<?php
session_start();
$er = null;
if (isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        include '../../database/cnt.php';
        include '../../model/luong.php';
        $luongs = new luong($db);
        $id = $_POST['ID'];
        if ($id == null)
            $er[] = 'Nhân viên không tồn tại';

        if ($er == null) {
            $rs = $luongs->capnhap_luong($id);
            if ($rs > 0) {
            } else {
                $er[] = 'Thất bại';
            }
        }
    }catch(Exception $e){
        $er[]='Lỗi : '+$e->getMessage();
    }
} else {
    $er[] = 'Truy cập không hợp lệ';

}
if ($er == null) {
    $er = array('er' => false, 'ms' => '');
} else {
    $er = array('er' => true, 'ms' => $er);
}
echo json_encode($er);