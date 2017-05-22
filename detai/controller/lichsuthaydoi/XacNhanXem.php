<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_SESSION['id'])  && $_SESSION['isMn'] && $_SESSION['idpb'] == 'NS') {
        include '../../database/cnt.php';
        include '../../model/lichsuthaydoi.php';
        $his = new lichsuthaydoi($db);

        IF(isset($_POST['id'])) {

            $id = $_POST['id'];

            $kq = $his->SetRead($id);


            echo $kq;
        }
    }
}