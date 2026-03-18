<?php
class Carro {
    public $marca;
    public $modelo;

    function mostrar() {
        echo "Carro: $this->marca - $this->modelo";
    }
}

$carro1 = new Carro();
$carro1->marca = "Toyota";
$carro1->modelo = "Corolla";

$carro1->mostrar();
?>