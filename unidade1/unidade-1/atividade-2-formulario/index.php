<?php
// ATIVIDADE 2 — Cadastro via Formulário (POST + validação)

/**
 * Retorna um campo do POST de forma segura (string).
 */
function post_field($key)
{
    return trim((string)($_POST[$key] ?? ''));
}

/**
 * Valida se todos os campos obrigatórios foram preenchidos.
 * Retorna um array com mensagens de erro (vazio se estiver tudo ok).
 */
function validar_campos($dados, $obrigatorios)
{
    $erros = [];
    foreach ($obrigatorios as $campo => $rotulo) {
        if (!isset($dados[$campo]) || $dados[$campo] === '') {
            $erros[] = "O campo \"$rotulo\" é obrigatório.";
        }
    }
    return $erros;
}

$dados = [
    'nome' => '',
    'email' => '',
    'curso' => '',
    'turno' => '',
];

$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados via POST
    $dados['nome'] = post_field('nome');
    $dados['email'] = post_field('email');
    $dados['curso'] = post_field('curso');
    $dados['turno'] = post_field('turno');

    // Valida (nenhum vazio)
    $erros = validar_campos($dados, [
        'nome' => 'Nome',
        'email' => 'E-mail',
        'curso' => 'Curso',
        'turno' => 'Turno',
    ]);

    // Validação extra simples do e-mail
    if (!$erros && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }

    $sucesso = !$erros;
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 2 — Formulário</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Atividade 2 — Cadastro via Formulário</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        <a href="../index.php" style="color:#fff;">Voltar ao menu</a>
      </p>
    </header>

    <main>
      <div class="card">
        <form method="post" action="">
          <div class="row">
            <div>
              <label for="nome">Nome</label>
              <input id="nome" name="nome" type="text" value="<?php echo htmlspecialchars($dados['nome']); ?>" />
            </div>
            <div>
              <label for="email">E-mail</label>
              <input id="email" name="email" type="email" value="<?php echo htmlspecialchars($dados['email']); ?>" />
            </div>
            <div>
              <label for="curso">Curso</label>
              <input id="curso" name="curso" type="text" value="<?php echo htmlspecialchars($dados['curso']); ?>" />
            </div>
            <div>
              <label for="turno">Turno</label>
              <select id="turno" name="turno">
                <option value="">Selecione...</option>
                <?php
                $opcoes = ['Manhã', 'Tarde', 'Noite'];
                foreach ($opcoes as $op) {
                    $selected = ($dados['turno'] === $op) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($op) . "\" $selected>" . htmlspecialchars($op) . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <div style="margin-top:12px;">
            <button class="btn" type="submit">Enviar</button>
          </div>
        </form>
      </div>

      <?php if ($erros): ?>
        <div class="card error">
          <strong>Corrija os campos abaixo:</strong>
          <ul>
            <?php foreach ($erros as $e): ?>
              <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ($sucesso): ?>
        <div class="card ok">
          <strong>Cadastro recebido com sucesso!</strong>
          <div class="muted" style="margin-top:6px;">
            Olá, <?php echo htmlspecialchars($dados['nome']); ?>! Seu cadastro foi registrado para apresentação.
          </div>
        </div>

        <div class="card">
          <h2 style="margin:0 0 10px;font-size:16px;">Dados informados</h2>
          <table class="table">
            <tr>
              <th>Nome</th>
              <td><?php echo htmlspecialchars($dados['nome']); ?></td>
            </tr>
            <tr>
              <th>E-mail</th>
              <td><?php echo htmlspecialchars($dados['email']); ?></td>
            </tr>
            <tr>
              <th>Curso</th>
              <td><?php echo htmlspecialchars($dados['curso']); ?></td>
            </tr>
            <tr>
              <th>Turno</th>
              <td><?php echo htmlspecialchars($dados['turno']); ?></td>
            </tr>
          </table>
        </div>
      <?php endif; ?>
    </main>
  </body>
</html>

