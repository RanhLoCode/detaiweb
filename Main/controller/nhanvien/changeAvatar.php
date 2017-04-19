<?php
function randString()
{
    $s = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
    $s = implode($s, '');
    $a = str_shuffle($s);
    $b = str_shuffle($a);
    $c = array($a, $b);
    return $c[rand(0, count($c) - 1)];
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $st = null;
    $newname = '';
    session_start();
    IF (isset($_SESSION['tdn'])) {
        $file = $_FILES['txtAvatar'];
        if ($file['name'] != null) {
            include '../../database/cnt.php';
            include '../../model/nhanvien.php';
            $nvs = new nhanvien($db);
            $id = $_POST['ID'];
            if($nvs->isExist_id($id)) {
                $check = getimagesize($file['tmp_name']);

                if ($check !== FALse) {

                    $newname = $id.randString() . $file['name'];
                    $des = '../../image/avatar/' . $newname;
                    if (copy($file['tmp_name'], $des)) {


                        $path = '../../image/avatar/' . $nvs->getInfo_id('Hinh', $id)['Hinh'];
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $c = $nvs->suahinh($newname, $id);
                        if ($c) {

                        } else {
                            $st[] = 'Xảy ra lỗi !';
                        }
                    } else {
                        $st[] = 'Lỗi';
                    }
                } else {
                    $st[] = 'File hình không hợp lệ';
                }
            }else {
                $st[]='Nhân viên không tồn tại';
            }
        } else {
            $st[] = 'Chưa chọn file';
        }
    } else {
        $st[] = 'Bạn chưa đăng nhập';
    }
    if ($st == null) {
        $st = array('er' => false, 'ms' => $newname);
    } else {
        $st = array('er' => true, 'ms' => $st);
    }
    echo json_encode($st);
}
?>