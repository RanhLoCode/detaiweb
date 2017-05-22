<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['isMn'] && $_SESSION['idpb'] == 'NS') {
    include '../../database/cnt.php';
    include '../../model/lichsuthaydoi.php';

    $his = new lichsuthaydoi($db);

    $count = $his->DanhSachChuaXem()->rowCount();
    echo $count;
}