<!DOCTYPE html>
<html>
<head>
    <title>Agenda</title>
</head>
<body>

<form method="post">
    Nome: <input type="text" name="nome"><br>
    Compromisso: <input type="text" name="compromisso"><br>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_POST) {
    $nome = $_POST["nome"];
    $compromisso = $_POST["compromisso"];

    echo "<br>$nome, seu compromisso é: $compromisso";
}
?>

</body>
</html>