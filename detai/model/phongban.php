<?php

class phongban
{
    public $db;

    function phongban($db)
    {
        $this->db = $db;
    }

    function GetDeps()
    {
        $qj = $this->db->query("select * from phongban");
        return $qj->fetchAll(PDO::FETCH_ASSOC);
    }


    function GetDep($id)
    {

        $qj = $this->db->prepare("select * from phongban where ID=:id");


        $qj->execute(
            array(
                ':id' => $id
            )
        );

        return $qj->fetch(PDO::FETCH_ASSOC);
    }

    FUNCTION validatePB($id)
    {
        $qj = $this->db->prepare("select 1 from phongban where ID=:id");


        $qj->execute(
            array(
                ':id' => $id
            )
        );

        return count($qj->fetchAll(PDO::FETCH_ASSOC)) > 0 ? true : false;
    }

    function checkManager($id   , $idnv)
    {
        if ($id == null) {
            $qj = $this->db->prepare('select 1 from phongban where IDTruongPhong = :idnv');
            $qj->execute(array(
                ':idnv' => $idnv
            ));
        } else {
            $qj = $this->db->prepare('select 1 from phongban where ID = :id and IDTruongPhong = :idnv');
            $qj->execute(array(
                ':id' => $id,
                ':idnv' => $idnv
            ));
        }
        return $qj->rowCount();
    }
    function Remove($where){
        try {
            $qj = $this->db->prepare('delete from phongbsn where ' . $where);
            $qj->execute(array());
            return 1;
        }catch (PDOException $e){
            return 0;
        }
    }
    function setManager($id, $idnv)
    {
        try {
            $qj = $this->db->prepare('update phongban set IDTruongPhong = :idnv,Action_User = :au where ID =:id');
            $qj->execute(array(
                ':id' => $id,
                ':idnv' => $idnv,
                ':au'=>$_SESSION['id']
            ));
           return 1;
        }catch(PDOException $e)
        {
            return 0;
        }
    }

}

?>