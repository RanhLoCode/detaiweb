<?php

include '../../database/cnt.php';
include '../../model/phongban.php';
$pbs = new phongban($db);

$tb = $pbs->GetDeps();
echo json_encode($tb);
