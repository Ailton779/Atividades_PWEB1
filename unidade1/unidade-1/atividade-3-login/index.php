<?php
// ATIVIDADE 3 — Sistema de Login com Sessões
// Requisitos atendidos:
// - session_start()
// - $_SESSION
// - Proteção de página (painel)
// - Redirecionamento com header()
// - Logout

session_start();

// Usuário e senha fixos (conforme enunciado).
$USUARIO_FIXO = 'admin';
$SENHA_FIXA = '1234';

// Se já estiver logado, manda direto ao painel.
if (!empty($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: painel.php');
    exit;
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim((string)($_POST['usuario'] ?? ''));
    $senha = trim((string)($_POST['senha'] ?? ''));

    if ($usuario === '' || $senha === '') {
        $erro = 'Preencha usuário e senha.';
    } elseif ($usuario === $USUARIO_FIXO && $senha === $SENHA_FIXA) {
        // Cria sessão de autenticação.
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;

        // Redireciona para a página protegida.
        header('Location: painel.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos.';
    }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 3 — Login</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Atividade 3 — Login (Sessões)</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        <a href="../index.php" style="color:#fff;">Voltar ao menu</a>
      </p>
    </header>

    <main>
      <div class="card">
        <p class="muted" style="margin-top:0;">
          Credenciais (fixas): <strong>admin</strong> / <strong>1234</strong>
        </p>
        <form method="post" action="">
          <div style="display:grid;gap:12px;">
            <div>
              <label for="usuario">Usuário</label>
              <input id="usuario" name="usuario" type="text" autocomplete="username" />
            </div>
            <div>
              <label for="senha">Senha</label>
              <input id="senha" name="senha" type="password" autocomplete="current-password" />
            </div>
          </div>
          <div style="margin-top:12px;">
            <button class="btn" type="submit">Entrar</button>
          </div>
        </form>
      </div>

      <?php if ($erro !== null): ?>
        <div class="card error">
          <?php echo htmlspecialchars($erro); ?>
        </div>
      <?php endif; ?>
    </main>
  </body>
</html>

