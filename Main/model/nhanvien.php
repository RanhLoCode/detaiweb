<?php

class nhanvien
{

    public $db;

    function nhanvien($db)
    {
        $this->db = $db;
    }

    function dsnhanvien()
    {
        return $this->db->query('select * from nhanvien');
    }

    function dsnhanvien_theopb($idpb,$from,$rowPage)
    {
        return $this->db->query("select nhanvien.*,phongban.Ten as TenPB 
            from nhanvien,phongban 
            where nhanvien.IDPhongBan = phongban.ID and nhanvien.IDPhongBan='$idpb'  
            limit $from,$rowPage
            ");
    }

    function tong_dsnhanvien_theopb($idpb)
    {
    
        return count(($this->db->query(
            "select 1
            from nhanvien
            where  nhanvien.IDPhongBan='$idpb'
            ")->fetchAll(PDO::FETCH_ASSOC)));
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
    }

    function getInfo($cols, $tdn)
    {
        $qj = $this->db->prepare("select $cols from nhanvien where TenDangNhap=:tdn");
        
        $qj->execute(array(
            ':tdn' => $tdn
        ));
        
        return $qj->fetch(PDO::FETCH_ASSOC);
    }
}
?>