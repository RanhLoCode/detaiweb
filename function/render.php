<?php
if (!isset($ren)) {
    $ren = array();
}
function InitPosRender($fcName)
{
    global $ren;
    if (isset($ren[$fcName]) && is_callable($ren[$fcName])) {
        $ren[$fcName]();
    }
}

?>