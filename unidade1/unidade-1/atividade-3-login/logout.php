<?php
// Encerra a sessão e volta para o login.
session_start();

// Remove as variáveis de sessão.
$_SESSION = [];

// Remove o cookie de sessão, se existir.
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

// Destrói a sessão.
session_destroy();

header('Location: index.php');
exit;

