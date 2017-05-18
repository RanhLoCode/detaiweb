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
        return  $this->db->query("select * from lichsuthaydoitt");
    }

    function  lichsuthaydoi_page($from,$rowEachPage){
      RETURN $this->db->query("select * from lichsuthaydoitt limit $from,$rowEachPage");

    }

}

?>