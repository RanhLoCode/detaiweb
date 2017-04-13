<?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=ql_nhanvien','root','');
    
}catch(PDOException $e){
    
 echo $e->getMessage();
 exit();
}
?>