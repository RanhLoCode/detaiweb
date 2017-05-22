<?php


?>

<html>
<body >






</body>



<script>
var conn = new WebSocket('ws://localhost:8081');
conn.onopen = function(e) {
    //alert("fuck");

    //console.log("Connection established!");
};

conn.onmessage = function(e) {



    console.log(e.data);
};
</script>



</html>