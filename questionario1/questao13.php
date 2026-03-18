<?php
$numero = 10;

function teste() {
    global $numero;
    echo "Dentro da função: $numero<br>";
}

teste();
echo "Fora da função: $numero";
?>