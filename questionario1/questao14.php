<?php
function contador() {
    static $num = 0;
    $num++;
    echo $num . "<br>";
}

contador();
contador();
contador();
?>