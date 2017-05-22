<?php

class lichsuthaydoi
{

    public $db;


    function lichsuthaydoi($db)
    {
        $this->db = $db;
    }

    function lichsuthaydois()
    {
        return $this->db->query("select * from lichsuthaydoitt");
    }

    function DanhSachChuaXem()
    {
        return $this->db->query("SELECT * FROM `lichsuthaydoitt` WHERE daxem=0");//nghi code di
    }

    function lichsuthaydoi_page($from, $rowEachPage)
    {
        RETURN $this->db->query("select * from lichsuthaydoitt  ORDER by NgayThucThi DESC limit $from,$rowEachPage");


    }

    function SetRead($id)
    {
        $qj = $this->db->prepare("update lichsuthaydoitt set DaXem = 1 where  ID = :id");
        $qj->execute(array(
            ':id' => $id
        ));
        return $qj->rowCount();
    }

    function Add($ten, $idbixoa)
    {
        $qj = $this->db->prepare("INSERT into lichsuthaydoitt VALUES(null,:au,concat('Nhân viên ',:ten,' đã xóa ',:idbx,' khỏi danh sách nhân viên'),now(),0)");
        $qj->execute(array(
            ':ten' => $ten,
            ':idbx' => $idbixoa,
            ':au' => $_SESSION['id']
        ));
        return $qj->rowCount();
    }

}

?>