<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include '../../database/cnt.php';
    include '../../model/nhanvien.php';
    session_start();
    
    $idpb = $_GET['idpb'];
    $rowPage = 20;
    
    $nvs = new nhanvien($db);

    $countRows = $nvs->tong_dsnhanvien_theopb_($idpb);
    $countPage = ceil($countRows / $rowPage) ;


    for($i=1;$i<=$countPage;$i++) {
        $tb_temp = $nvs->dsnhanvien_theopb_($idpb, ($i - 1) * $rowPage, $rowPage);
        $tb = array();
        while($row= $tb_temp->fetch(PDO::FETCH_ASSOC)) {
            $item = array();
            $item['ID']=$row['ID'];
            $item['Ten']=$row['Ten'];

            $tb[] = $item;
        }
        $data[] = $tb;
    }

    
    echo json_encode($data);
}
?>