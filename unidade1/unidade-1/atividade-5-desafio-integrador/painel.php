<?php
// Painel protegido: cadastro + listagem dos registros guardados em array (sessão).

require_once __DIR__ . '/auth.php';
iniciar_sessao();
exigir_login();

// Garante estrutura do array temporário.
if (!isset($_SESSION['registros']) || !is_array($_SESSION['registros'])) {
    $_SESSION['registros'] = [];
}

$erros = [];
$sucesso = null;

// Valores para manter no formulário em caso de erro.
$form = [
    'nome' => '',
    'email' => '',
    'curso' => '',
    'turno' => '',
];

// Ação opcional para limpar registros (a pedido do usuário).
if (($_GET['acao'] ?? '') === 'limpar') {
    $_SESSION['registros'] = [];
    header('Location: painel.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['nome'] = post_field('nome');
    $form['email'] = post_field('email');
    $form['curso'] = post_field('curso');
    $form['turno'] = post_field('turno');

    [$erros, $registro] = validar_registro($form);

    if (!$erros) {
        // Armazenamento temporário em array (na sessão).
        $_SESSION['registros'][] = $registro;
        $sucesso = 'Registro cadastrado e armazenado temporariamente na sessão.';

        // Limpa formulário após sucesso.
        $form = ['nome' => '', 'email' => '', 'curso' => '', 'turno' => ''];
    }
}

$usuario = (string)($_SESSION['usuario'] ?? 'usuário');
$registros = $_SESSION['registros'];
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 5 — Painel</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Painel — Desafio integrador</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        Logado como: <?php echo htmlspecialchars($usuario); ?> —
        <a href="../index.php" style="color:#fff;">Menu</a>
      </p>
    </header>

    <main>
      <div class="card ok">
        <strong>Login ok.</strong>
        <div class="muted" style="margin-top:6px;">
          Aqui você cadastra dados via formulário, valida com função e lista os registros (array na sessão).
        </div>
      </div>

      <?php if ($sucesso !== null): ?>
        <div class="card ok">
          <?php echo htmlspecialchars($sucesso); ?>
        </div>
      <?php endif; ?>

      <?php if ($erros): ?>
        <div class="card error">
          <strong>Corrija os erros:</strong>
          <ul style="margin:8px 0 0;padding-left:18px;">
            <?php foreach ($erros as $e): ?>
              <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="card">
        <h2 style="margin:0 0 12px;font-size:16px;">Cadastro</h2>
        <form method="post" action="">
          <div class="row">
            <div>
              <label for="nome">Nome</label>
              <input id="nome" name="nome" type="text" value="<?php echo htmlspecialchars($form['nome']); ?>" />
            </div>
            <div>
              <label for="email">E-mail</label>
              <input id="email" name="email" type="email" value="<?php echo htmlspecialchars($form['email']); ?>" />
            </div>
            <div>
              <label for="curso">Curso</label>
              <input id="curso" name="curso" type="text" value="<?php echo htmlspecialchars($form['curso']); ?>" />
            </div>
            <div>
              <label for="turno">Turno</label>
              <select id="turno" name="turno">
                <option value="">Selecione...</option>
                <?php
                $opcoes = ['Manhã', 'Tarde', 'Noite'];
                foreach ($opcoes as $op) {
                    $selected = ($form['turno'] === $op) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($op) . "\" $selected>" . htmlspecialchars($op) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
            <button class="btn" type="submit">Cadastrar</button>
            <a class="btn btn-secondary" href="logout.php">Logout</a>
            <a class="btn btn-danger" href="painel.php?acao=limpar" onclick="return confirm('Limpar todos os registros?');">Limpar registros</a>
          </div>
        </form>
      </div>

      <div class="card">
        <h2 style="margin:0 0 12px;font-size:16px;">Registros cadastrados (<?php echo (int)count($registros); ?>)</h2>
        <?php if (!$registros): ?>
          <p class="muted" style="margin:0;">Nenhum registro cadastrado ainda.</p>
        <?php else: ?>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Curso</th>
                <th>Turno</th>
                <th>Criado em</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($registros as $i => $r): ?>
                <tr>
                  <td><?php echo (int)($i + 1); ?></td>
                  <td><?php echo htmlspecialchars((string)($r['nome'] ?? '')); ?></td>
                  <td><?php echo htmlspecialchars((string)($r['email'] ?? '')); ?></td>
                  <td><?php echo htmlspecialchars((string)($r['curso'] ?? '')); ?></td>
                  <td><?php echo htmlspecialchars((string)($r['turno'] ?? '')); ?></td>
                  <td><?php echo htmlspecialchars((string)($r['criado_em'] ?? '')); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </main>
  </body>
</html>

