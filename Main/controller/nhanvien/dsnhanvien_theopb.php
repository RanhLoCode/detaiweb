<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include '../../database/cnt.php';
    include '../../model/nhanvien.php';
    include '../../model/phongban.php';
    session_start();
    
    $idpb = $_SESSION['idpb'];
    if (isset($_GET['pageIndex'])) {
        $pageIndex = $_GET['pageIndex'];
    } else {
        $pageIndex = 1;
    }
    $rowPage = 10;
    
    $nvs = new nhanvien($db);
    $pbs = new phongban($db);
    $countRows = $nvs->tong_dsnhanvien_theopb($idpb);
    $countRows = ceil($countRows / 10) ;
    $tb = $nvs->dsnhanvien_theopb($idpb, ($pageIndex - 1) * $rowPage, $rowPage)->fetchAll(PDO::FETCH_ASSOC);
    
    $data = array(
        'rowCount' => $countRows,
        'pageIndex' => $pageIndex,
        'data' => $tb
    );
    
    echo json_encode($data);
}
?>