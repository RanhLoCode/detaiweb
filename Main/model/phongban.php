<?php

class phongban
{
    public $db;
    function phongban($db)
    {
        $this->db = $db;
    }
 /*    function dsnhanvien(){
       return $this->db->query('select * from nhanvien');
    }
    function dsnhanvien_theopb($idpb){
        return $this->db->query("select * from nhanvien ");
    }
    function dangnhap($tk, $mk)
    {
        $mk = md5($mk);
        $qj = $this->db->prepare("select * from nhanvien where TenDangNhap = :tk and MatKhau = :mk");
        
        $qj->execute(array(
            ':tk' => $tk,
            ':mk' => $mk
        ));
        
        return count($qj->fetchAll(PDO::FETCH_ASSOC));
    } */
    function getInfo($cols,$id)
    {
       
        $qj = $this->db->prepare("select $cols from phongban where ID=:id");
        
       
        $qj ->execute(
            array(
                ':id'=>$id
            )    
        );
        
        return $qj->fetch(PDO::FETCH_ASSOC);
    }
}
?>