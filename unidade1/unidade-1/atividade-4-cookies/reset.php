<?php
// Apaga o cookie e volta para a tela inicial.
$COOKIE_NOME = 'pweb1_nome';

// Define cookie com expiração no passado para remover.
setcookie($COOKIE_NOME, '', time() - 3600, '/');

header('Location: index.php');
exit;

