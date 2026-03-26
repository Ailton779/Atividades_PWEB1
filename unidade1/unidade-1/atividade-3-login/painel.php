<?php
// Página protegida: só pode acessar se houver sessão válida.
session_start();

if (empty($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: index.php');
    exit;
}

$usuario = (string)($_SESSION['usuario'] ?? 'usuário');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 3 — Painel</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Painel</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        <a href="../index.php" style="color:#fff;">Voltar ao menu</a>
      </p>
    </header>

    <main>
      <div class="card ok">
        <strong>Acesso autorizado!</strong>
        <div class="muted" style="margin-top:6px;">
          Bem-vindo, <?php echo htmlspecialchars($usuario); ?>. Esta página está protegida por sessão.
        </div>
      </div>

      <div class="card">
        <a class="btn btn-secondary" href="logout.php">Sair (logout)</a>
      </div>
    </main>
  </body>
</html>

