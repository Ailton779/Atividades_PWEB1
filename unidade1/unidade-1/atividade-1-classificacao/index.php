<?php
// ATIVIDADE 1 — Sistema de Classificação Acadêmica
// Requisitos atendidos:
// - Variáveis + if/else
// - Loop (for)
// - Pelo menos 1 função
// - Saída formatada em HTML

/**
 * Classifica uma nota conforme o enunciado.
 * @param float $nota
 * @return string
 */
function classificar_nota($nota)
{
    if ($nota >= 7) {
        return 'Aprovado';
    } elseif ($nota >= 5) {
        return 'Recuperação';
    }
    return 'Reprovado';
}

$nota_informada = null;
$erros = [];
$resultado = null;
$lista_notas = [];

// Se o formulário foi enviado, processa.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe a nota como string, pois o navegador pode enviar com vírgula em alguns casos.
    $nota_raw = trim((string)($_POST['nota'] ?? ''));
    $nota_raw = str_replace(',', '.', $nota_raw);

    if ($nota_raw === '') {
        $erros[] = 'Informe uma nota.';
    } elseif (!is_numeric($nota_raw)) {
        $erros[] = 'A nota precisa ser numérica.';
    } else {
        $nota_informada = (float)$nota_raw;

        if ($nota_informada < 0 || $nota_informada > 10) {
            $erros[] = 'A nota deve estar entre 0 e 10.';
        }
    }

    if (!$erros) {
        $resultado = classificar_nota($nota_informada);

        // Exibe todas as notas de 0 até a nota informada.
        // Usamos passos inteiros (0, 1, 2...) e, se a nota tiver parte decimal,
        // também exibimos o valor final informado.
        $limite = (int)floor($nota_informada);
        for ($i = 0; $i <= $limite; $i++) {
            $lista_notas[] = $i;
        }
        if (abs($nota_informada - $limite) > 0.00001) {
            $lista_notas[] = $nota_informada;
        }
    }
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Atividade 1 — Classificação</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Atividade 1 — Sistema de Classificação Acadêmica</h1>
      <p style="margin:6px 0 0;opacity:.9;">
        <a href="../index.php" style="color:#fff;">Voltar ao menu</a>
      </p>
    </header>

    <main>
      <div class="card">
        <form method="post" action="">
          <div class="row">
            <div>
              <label for="nota">Informe a nota (0 a 10)</label>
              <input
                id="nota"
                name="nota"
                type="number"
                min="0"
                max="10"
                step="0.01"
                value="<?php echo htmlspecialchars($nota_informada !== null ? (string)$nota_informada : ''); ?>"
                required
              />
              <div class="muted" style="margin-top:6px;">Ex.: 7,5 (pode usar vírgula ou ponto)</div>
            </div>
          </div>
          <div style="margin-top:12px;">
            <button class="btn" type="submit">Classificar</button>
          </div>
        </form>
      </div>

      <?php if ($erros): ?>
        <div class="card error">
          <strong>Erros:</strong>
          <ul>
            <?php foreach ($erros as $e): ?>
              <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ($resultado !== null): ?>
        <div class="card ok">
          <p style="margin:0;">
            Nota informada: <strong><?php echo htmlspecialchars(number_format($nota_informada, 2, ',', '.')); ?></strong><br />
            Situação: <strong><?php echo htmlspecialchars($resultado); ?></strong>
          </p>
        </div>

        <div class="card">
          <h2 style="margin:0 0 10px;font-size:16px;">Notas de 0 até a nota informada</h2>
          <?php if (!$lista_notas): ?>
            <p class="muted" style="margin:0;">Nenhuma nota para listar.</p>
          <?php else: ?>
            <ul>
              <?php foreach ($lista_notas as $n): ?>
                <li>
                  <?php
                  // Mostra inteiros como inteiro; decimais com 2 casas.
                  $num = (float)$n;
                  if (abs($num - (int)$num) < 0.00001) {
                      echo (int)$num;
                  } else {
                      echo htmlspecialchars(number_format($num, 2, ',', '.'));
                  }
                  ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </main>
  </body>
</html>

