<?php
session_start();
if(isset($_SESSION['id'])) {
    include '../../database/cnt.php';
    include '../../model/lichsuthaydoi.php';
    include '../../model/nhanvien.php';
    $lss = new lichsuthaydoi($db);
    $nvs = new nhanvien($db);
    if(isset($_GET['pageIndex'])){
        $pageIndex=$_GET['pageIndex'];
    }else{
        $pageIndex=1;
    }
    if(isset($_GET['rowEachPage'])){
        $rowEachPage=$_GET['rowEachPage'];
    }else{
        $rowEachPage=10;
    }


    $totalRow = ($lss->lichsuthaydois())->rowCount();
    $totalPage = ceil($totalRow/$rowEachPage);
   $dsl = $lss->lichsuthaydoi_page(($pageIndex-1)*$rowEachPage,$rowEachPage);

    while ($row = $dsl->fetch(PDO::FETCH_ASSOC)) {
        $itemTb = array();
        $info_nv = $nvs->getInfo("Ten","ID = ".$row['IDNhanVienTHTD']);

       // $itemTb['id'] = $row['ID'];
        $itemTb['idnv'] = $row['IDNhanVienTHTD'];
        $itemTb['tennv'] = !isset($info_nv['Ten']) || $info_nv['Ten'] == null ? 'Nhân viên này đã bị xóa':$info_nv['Ten'];
        $itemTb['date'] = $row['NgayThucThi'];
        $itemTb['note'] = $row['ChuThich'];
        $tb[] = $itemTb;

    }
    $data = array(
        'totalRow'=>$totalRow,
        'totalPage'=>$totalPage,
        'pageIndex'=>$pageIndex,
        'rowEachPage'=>$rowEachPage,
        'tb'=>$tb,
    );
    echo json_encode($data, JSON_NUMERIC_CHECK);
}