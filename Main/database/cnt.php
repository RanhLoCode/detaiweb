<?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=ql_nhanvien','root','');
    $db->exec("set names utf8");
}catch(PDOException $e){
    
 echo $e->getMessage();
 exit();
}
?>