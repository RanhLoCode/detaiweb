<?php
session_start();
if(isset($_SESSION['id'])) {
    include '../../database/cnt.php';
    include '../../model/luong.php';
    include '../../model/nhanvien.php';
    $ls = new luong($db);
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


    $totalRow = ($ls->luongs())->rowCount();
    $totalPage = ceil($totalRow/$rowEachPage);
   $dsl = $ls->luongs_page(($pageIndex-1)*$rowEachPage,$rowEachPage);

    while ($row = $dsl->fetch(PDO::FETCH_ASSOC)) {
        $itemTb = array();
        $itemTb['idnv'] = $row['IDNhanVien'];
        $info_nv = $nvs->getEmploy( $row['IDNhanVien']);
        $itemTb['tennv'] = $info_nv['Ten'];
        $itemTb['luong'] = $info_nv['Luong'];
        $itemTb['msthue'] = $info_nv['MaSoThue'];
        $itemTb['ncnhanluong'] = $row['NgayCuoiNhanLuong'];
        $dt = DateTime::createFromFormat('Y-m-d', $row['NgayCuoiNhanLuong']);
        $times = $dt->getTimestamp() + 30 * 24 * 60 * 60;
        $curTime = time();
        if ($curTime > $times) {
            $itemTb['dknhanluong'] = true;
        } else
            $itemTb['dknhanluong'] = false;
        $tb[] = $itemTb;

    }
    $data = array(
        'totalRow'=>$totalRow,
        'totalPage'=>$totalPage,
        'pageIndex'=>$pageIndex,
        'rowEachPage'=>$rowEachPage,
        'tb'=>$tb
    );
    echo json_encode($data, JSON_NUMERIC_CHECK);
}