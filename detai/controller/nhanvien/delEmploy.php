<?php
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    session_start();
    $errors = null;
    if (isset($_SESSION['idpb']) && $_SESSION['idpb'] == 'NS') {
        $id = $_GET['id'];

        include '../../database/cnt.php';
        include '../../model/nhanvien.php';
        $nvs = new nhanvien($db);
        if (!isset($id) || !is_numeric($id)) {
            $errors[] = 'ID không hợp lệ';
        }
        if ($errors == null) {
            try {
                $info = $nvs->getInfo('IDPhongBan', "ID = $id");//lấy id phòng ban của nv bị xóa
                if (count($info)) {//kiem tra có tồn tại nhân viên
                    if ($info['IDPhongBan'] == 'NS' && !$_SESSION['isMn']) {
                        $errors[] = 'Bạn không có quyền xóa nhân viên phòng nhân sự';
                    } else {
                        include '../../model/phongban.php';
                        $pbs = new phongban($db);
                        $isMn =$pbs->checkManager($info['IDPhongBan'], $id);
                        $isFocus =$_GET['focus'];

                        if ($isFocus == 0 && $isMn > 0) {//nếu là trưởng phòng
                            $errors[] = "MN";//first request

                        } else {

                            include '../../model/luong.php';
                            $ls = new luong($db);

                            $confirmDel = $isMn?$$pbs->setManager($info['IDPhongBan'],null):true;
                            if ($confirmDel) {//xóa mục trên bảng lương trước
                                if ($nvs->DelEmp($id)) {
                                } else {
                                    $errors[] = 'Thất bại';
                                }
                            } else {
                                $errors[] = 'Thất bại';
                            }
                        }
                    }
                } else {
                    $errors[] = 'Nhân viên không tồn tại';
                }
            } catch (PDOException $e) {
                $errors[] = 'Lỗi : ' . $e->getMessage();
            }
        }
    } else {
        $errors[] = 'Bạn không có quyền này';
    }
    if ($errors == null) {
        $errors = array(
            'er' => false,
            'ms' => ''
        );
    } else {
        $errors = array(
            'er' => true,
            'ms' => $errors
        );
    }
    echo json_encode($errors);
}