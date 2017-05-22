<?php

class luong
{

    public $db;



    function luong($db)
    {
        $this->db = $db;
    }

    function luongs()
    {
        return $qj = $this->db->query("select * from luongnhanvien");
    }
    function  luongs_page($from,$rowEachPage){
      RETURN $this->db->query("select * from luongnhanvien limit $from,$rowEachPage");
;
    }
    function capnhap_luong($id){
        $qj = $this->db->prepare('update luongnhanvien set NgayCuoiNhanLuong =:nc where IDNhanVien = :id');
        $qj->execute(array(
            ':nc'=>date('Y-m-d',time()),
            ':id'=>$id
        ));
        return $qj->rowCount();
    }
    function them($idnv){
        $qj = $this->db->prepare('INSERT INTO `luongnhanvien`(`ID`, `IDNhanVien`, `NgayCuoiNhanLuong`) VALUES (null,:idnv,:ncnl)');
        $qj->execute(array(
            ':idnv'=>$idnv,
            ':ncnl'=>date('Y-m-d',time())
        ));
        return $qj->rowCount();
    }
    function Delete($idnv){
        try {
            $qj = $this->db->prepare('delete from luongnhanvien where IDNhanVien = :idnv');
            $qj->execute(array(
                ':idnv' => $idnv
            ));
            return 1;
        }catch (PDOException $e){
            return 0;
        }
    }

}

?>