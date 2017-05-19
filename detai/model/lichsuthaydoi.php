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

    function lichsuthaydoi_page($from, $rowEachPage)
    {
        RETURN $this->db->query("select * from lichsuthaydoitt limit $from,$rowEachPage");


    }

    function Add($ten, $idbixoa)
    {
            $qj = $this->db->prepare("INSERT into lichsuthaydoitt VALUES(null,:au,concat('Nhân viên ',:ten,' đã xóa ',:idbx,' khỏi danh sách nhân viên'),now())");
            $qj->execute(array(
                ':ten' => $ten,
                ':idbx' => $idbixoa,
                ':au'=>$_SESSION['id']
            ));
            return $qj->rowCount();
    }

}

?>