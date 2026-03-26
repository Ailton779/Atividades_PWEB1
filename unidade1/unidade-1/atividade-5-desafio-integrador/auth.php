<?php
// Arquivo de apoio (procedural) para o Desafio Integrador.
// Mantém funções reutilizáveis e verificação de acesso.

/**
 * Inicia a sessão caso ainda não tenha sido iniciada.
 */
function iniciar_sessao()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

/**
 * Verifica se o usuário está logado.
 */
function esta_logado()
{
    return !empty($_SESSION['logado']) && $_SESSION['logado'] === true;
}

/**
 * Protege uma página: se não estiver logado, redireciona para o login.
 */
function exigir_login()
{
    if (!esta_logado()) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Lê campo do POST de forma segura.
 */
function post_field($key)
{
    return trim((string)($_POST[$key] ?? ''));
}

/**
 * Função de validação dos dados do cadastro.
 * Retorna [array $erros, array $registro_validado]
 */
function validar_registro($entrada)
{
    $erros = [];

    $registro = [
        'nome' => trim((string)($entrada['nome'] ?? '')),
        'email' => trim((string)($entrada['email'] ?? '')),
        'curso' => trim((string)($entrada['curso'] ?? '')),
        'turno' => trim((string)($entrada['turno'] ?? '')),
        'criado_em' => date('Y-m-d H:i:s'),
    ];

    if ($registro['nome'] === '') $erros[] = 'Nome é obrigatório.';
    if ($registro['email'] === '') $erros[] = 'E-mail é obrigatório.';
    if ($registro['curso'] === '') $erros[] = 'Curso é obrigatório.';
    if ($registro['turno'] === '') $erros[] = 'Turno é obrigatório.';

    if ($registro['email'] !== '' && !filter_var($registro['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }

    $turnos_validos = ['Manhã', 'Tarde', 'Noite'];
    if ($registro['turno'] !== '' && !in_array($registro['turno'], $turnos_validos, true)) {
        $erros[] = 'Turno inválido.';
    }

    return [$erros, $registro];
}

