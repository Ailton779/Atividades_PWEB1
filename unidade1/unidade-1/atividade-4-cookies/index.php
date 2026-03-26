<?php
// ATIVIDADE 4 — Cookies
// - Solicita nome no primeiro acesso
// - Salva em cookie por 7 dias
// - Em acessos seguintes, exibe mensagem personalizada

$COOKIE_NOME = 'pweb1_nome';

$erro = null;

// Se enviou o formulário, salva o cookie e redireciona.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim((string)($_POST['nome'] ?? ''));

    if ($nome === '') {
        $erro = 'Informe seu nome.';
    } else {
        // 7 dias em segundos.
        $expira_em = time() + (7 * 24 * 60 * 60);

        // Define cookie para o site inteiro (path "/").
        setcookie($COOKIE_NOME, $nome, $expira_em, '/');

        // Redireciona para evitar reenvio do POST.
        header('Location: index.php');
        exit;
    }
}

$nome_salvo = (string)($_COOKIE[$COOKIE_NOME] ?? '');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 4 — Cookies</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Atividade 4 — Cookies</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        <a href="../index.php" style="color:#fff;">Voltar ao menu</a>
      </p>
    </header>

    <main>
      <?php if ($nome_salvo !== ''): ?>
        <div class="card ok">
          <strong>Olá, <?php echo htmlspecialchars($nome_salvo); ?>!</strong>
          <div class="muted" style="margin-top:6px;">
            Seu nome foi recuperado de um cookie válido por 7 dias.
          </div>
        </div>
        <div class="card">
          <a class="btn btn-secondary" href="reset.php">Apagar cookie</a>
        </div>
      <?php else: ?>
        <div class="card">
          <p class="muted" style="margin-top:0;">
            Primeiro acesso: informe seu nome para salvar em cookie por 7 dias.
          </p>
          <form method="post" action="">
            <div style="display:grid;gap:12px;">
              <div>
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" />
              </div>
            </div>
            <div style="margin-top:12px;">
              <button class="btn" type="submit">Salvar cookie</button>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <?php if ($erro !== null): ?>
        <div class="card error">
          <?php echo htmlspecialchars($erro); ?>
        </div>
      <?php endif; ?>
    </main>
  </body>
</html>

