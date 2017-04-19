<?php

class phongban
{
    public $db;
    function phongban($db)
    {
        $this->db = $db;
    }
    function dsphongban($strCol){
       return $this->db->query("select $strCol from phongban");
    }
    /*
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
    FUNCTION validatePB($id){
        $qj = $this->db->prepare("select 1 from phongban where ID=:id");
        
         
        $qj ->execute(
            array(
                ':id'=>$id
            )
            );
        
        return count($qj->fetchAll(PDO::FETCH_ASSOC))>0?true:false;
    }
    function checkManager($id,$idnv){
        $qj = $this->db->prepare('select 1 from phongban where ID = :id and IDTruongPhong = :idnv');
        $qj->execute(array(
            ':id'=>$id,
            ':idnv'=>$idnv
        ));
        return count( $qj->fetchAll(PDO::FETCH_ASSOC))>0?true:false;
    }
 
}
?>