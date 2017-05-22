<?php

class nhanvien
{

    public $db;


    function nhanvien($db)
    {
        $this->db = $db;
    }

    function DelEmp($id)
    {
        $qj = $this->db->prepare("delete from nhanvien where ID = :id");
        return $qj->execute(array(
            ':id' => $id
        ));
    }


    function doimatkhau($id, $mkm)
    {
        $qj = $this->db->prepare('update nhanvien set MatKhau=:mk where ID =:id');
        $qj->execute(array(
            ':mk' => $mkm,
            ':id' => $id
        ));
        return $qj->rowCount();
    }

    function suanhanvien($ten, $ngaysinh, $mail, $phongban, $luong, $masothue, $id)
    {
        $qj = $this->db->prepare("update `nhanvien` set `Ten` = :ten , `NgaySinh` = :ngaysinh,Action_User = :ac,
           `Mail` = :mail ,`IDPhongBan` = :phongban,`Luong` = :luong,`MaSoThue` = :masothue where `ID` = :id
        ");
        return $qj->execute(array(
            ':ten' => $ten,
            ':ngaysinh' => $ngaysinh,
            ':mail' => $mail,
            ':phongban' => $phongban,
            ':luong' => $luong,
            ':masothue' => $masothue,
            ':ac' => $_SESSION['id'],
            ':id' => $id
        ));
    }

    function suahinh($hinh, $id)
    {
        $qj = $this->db->prepare('update `nhanvien` set `Hinh` = :hinh where ID=:id');
        return $qj->execute(array(
            ':hinh' => $hinh,
            ':id' => $id
        ));
    }

    function AddEmp($ten, $ngaysinh, $mail, $phongban, $luong, $masothue, $mk, $avatar)
    {
        $qj = $this->db->prepare("INSERT INTO `nhanvien`(`ID`, `Ten`, `NgaySinh`, `Mail`, `IDPhongBan`, `Luong`, `MaSoThue`,`MatKhau`,`Hinh`,`Action_User`)
            VALUES (null,:ten,:ngaysinh,:mail,:phongban,:luong,:masothue,:mk,:av,:au)");
        return $qj->execute(array(
            ':ten' => $ten,
            ':ngaysinh' => $ngaysinh,
            ':mail' => $mail,
            ':phongban' => $phongban,
            ':luong' => $luong,
            ':masothue' => $masothue,
            ':mk' => $mk,
            ':av' => $avatar,
            ':au'=>$_SESSION['id']
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

    function dsnhanvien_theopb_($idpb, $from, $rowPage)
    {
        return $this->db->query("select nhanvien.*,phongban.Ten as TenPB 
            from nhanvien,phongban 
            where nhanvien.IDPhongBan = phongban.ID and nhanvien.IDPhongBan='$idpb'  
            limit $from,$rowPage
            ");

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

    function tong_dsnhanvien_theopb_($idpb)
    {

        return count(($this->db->query("select 1
            from nhanvien
            where  nhanvien.IDPhongBan='$idpb'
            ")->fetchAll(PDO::FETCH_ASSOC)));

    }

    function dangnhap($tdn, $mk)
    {
        $mk = md5($mk);
        $qj = $this->db->prepare("select * from nhanvien where Mail = :tdn and MatKhau = :mk");

        $qj->execute(array(
            ':tdn' => $tdn,
            ':mk' => $mk
        ));

        return $qj->rowCount() >0 ? true:false;
    }

    function getInfo($cols,$where)
    {
        $qj = $this->db->query("select $cols from nhanvien where $where");


        return $qj->fetch(PDO::FETCH_ASSOC);
    }

    function getEmploy($id)
    {
        $qj = $this->db->prepare("select * from nhanvien where ID=:id");

        $qj->execute(array(
            ':id' => $id
        ));

        return $qj->fetch(PDO::FETCH_ASSOC);
    }

    function isExist($tdn)
    {
        $qj = $this->db->prepare("select 1 from nhanvien where Mail=:tdn");

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