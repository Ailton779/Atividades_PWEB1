<?php
// ATIVIDADE 5 — Desafio Integrador
// Login com sessão (credenciais fixas) e acesso ao painel.

require_once __DIR__ . '/auth.php';
iniciar_sessao();

$USUARIO_FIXO = 'admin';
$SENHA_FIXA = '1234';

// Se já estiver logado, manda para o painel.
if (esta_logado()) {
    header('Location: painel.php');
    exit;
}

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = post_field('usuario');
    $senha = post_field('senha');

    if ($usuario === '' || $senha === '') {
        $erro = 'Preencha usuário e senha.';
    } elseif ($usuario === $USUARIO_FIXO && $senha === $SENHA_FIXA) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;

        // Inicializa o "banco" temporário em array na sessão.
        if (!isset($_SESSION['registros']) || !is_array($_SESSION['registros'])) {
            $_SESSION['registros'] = [];
        }

        header('Location: painel.php');
        exit;
    } else {
        $erro = 'Credenciais inválidas.';
    }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 5 — Login</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Atividade 5 — Desafio integrador</h1>
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
          <div class="row">
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

