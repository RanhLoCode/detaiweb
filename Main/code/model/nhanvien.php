<?php

class nhanvien
{

    public $db;



    function nhanvien($db)
    {
        $this->db = $db;
    }

    function xoanhanvien($id)
    {
        $qj = $this->db->prepare("delete from nhanvien where ID = :id");
        return $qj->execute(array(
            ':id' => $id
        ));
    }

    function suanhanvien($ten, $ngaysinh, $mail, $phongban, $luong, $masothue, $id)
    {
        $qj = $this->db->prepare("update `nhanvien` set `Ten` = :ten , `NgaySinh` = :ngaysinh,
           `Mail` = :mail ,`IDPhongBan` = :phongban,`Luong` = :luong,`MaSoThue` = :masothue where `ID` = :id
        ");
        return $qj->execute(array(
            ':ten' => $ten,
            ':ngaysinh' => $ngaysinh,
            ':mail' => $mail,
            ':phongban' => $phongban,
            ':luong' => $luong,
            ':masothue' => $masothue,

            ':id' => $id
        ));
    }
    function suahinh($hinh,$id){
        $qj = $this ->db->prepare('update `nhanvien` set `Hinh` = :hinh where ID=:id');
        return $qj->execute(array(
            ':hinh'=>$hinh,
            ':id'=>$id
        ));
    }

    function themnhanvien($ten, $ngaysinh, $mail, $phongban, $luong, $masothue, $tdn, $mk, $avatar)
    {
        $qj = $this->db->prepare("INSERT INTO `nhanvien`(`ID`, `Ten`, `NgaySinh`, `Mail`, `IDPhongBan`, `Luong`, `MaSoThue`, `TenDangNhap`, `MatKhau`,`Hinh`)
            VALUES (null,:ten,:ngaysinh,:mail,:phongban,:luong,:masothue,:tdn,:mk,:av)");
        return $qj->execute(array(
            ':ten' => $ten,
            ':ngaysinh' => $ngaysinh,
            ':mail' => $mail,
            ':phongban' => $phongban,
            ':luong' => $luong,
            ':masothue' => $masothue,
            ':tdn' => $tdn,
            ':mk' => $mk,
            ':av' => $avatar
        ));
    }

    function dsnhanvien()
    {
        return $this->db->query('select * from nhanvien');
    }

    function dsnhanvien_theopb($idpb, $from, $rowPage)
    {
        if ($idpb != 'NS') {
            return $this->db->query("select nhanvien.*,phongban.Ten as TenPB 
            from nhanvien,phongban 
            where nhanvien.IDPhongBan = phongban.ID and nhanvien.IDPhongBan='$idpb'  
            limit $from,$rowPage
            ");
        } else {
            return $this->db->query("select nhanvien.*,phongban.Ten as TenPB
            from nhanvien,phongban
            where nhanvien.IDPhongBan = phongban.ID 
            limit $from,$rowPage
            ");
        }
    }

    function tong_dsnhanvien_theopb($idpb)
    {
        if ($idpb != 'NS') {
            return count(($this->db->query("select 1
            from nhanvien
            where  nhanvien.IDPhongBan='$idpb'
            ")->fetchAll(PDO::FETCH_ASSOC)));
        } else {
            return count(($this->db->query("select 1
            from nhanvien
            ")->fetchAll(PDO::FETCH_ASSOC)));
        }
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

    function getInfo_id($cols, $id)
    {
        $qj = $this->db->prepare("select $cols from nhanvien where ID=:id");

        $qj->execute(array(
            ':id' => $id
        ));

        return $qj->fetch(PDO::FETCH_ASSOC);
    }

    function isExist($tdn)
    {
        $qj = $this->db->prepare("select 1 from nhanvien where TenDangNhap=:tdn");

        $qj->execute(array(
            ':tdn' => $tdn
        ));

        return count($qj->fetchAll(PDO::FETCH_ASSOC)) > 0 ? true : false;
    }
    function isExist_id($id)
    {
            $qj = $this->db->prepare("select 1 from nhanvien where ID=:id");

        $qj->execute(array(
            ':id' => $id
        ));

        return count($qj->fetchAll(PDO::FETCH_ASSOC)) > 0 ? true : false;
    }
}

?>