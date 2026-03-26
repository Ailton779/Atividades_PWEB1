<?php
// Página inicial (menu) da Unidade 1.
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Unidade 1 — Menu</title>
    <style>
      :root { color-scheme: light; }
      body { font-family: Arial, sans-serif; margin: 0; background: #f6f7fb; color: #111; }
      header { background: #111827; color: #fff; padding: 18px 16px; }
      main { max-width: 900px; margin: 0 auto; padding: 16px; }
      .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; }
      ul { padding-left: 18px; }
      a { color: #2563eb; text-decoration: none; }
      a:hover { text-decoration: underline; }
      .grid { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); margin-top: 12px; }
      .item { border: 1px solid #e5e7eb; border-radius: 12px; padding: 14px; background: #fff; }
      .item h2 { margin: 0 0 8px; font-size: 16px; }
      .item p { margin: 0 0 10px; color: #374151; }
      .btn { display: inline-block; padding: 10px 12px; border-radius: 10px; background: #2563eb; color: #fff; }
      .btn:hover { background: #1d4ed8; text-decoration: none; }
    </style>
  </head>
  <body>
    <header>
      <h1 style="margin:0;font-size:18px;">Unidade 1 — Atividades (PWEB I)</h1>
      <p style="margin:6px 0 0;opacity:.9;">PHP procedural + HTML + Sessões + Cookies</p>
    </header>
    <main>
      <div class="card">
        <p style="margin:0;">
          Se você estiver usando XAMPP/WAMP/Laragon, acesse esta pasta via seu servidor local.
        </p>
      </div>

      <div class="grid">
        <div class="item">
          <h2>Atividade 1 — Classificação</h2>
          <p>Entrada de nota, classificação e loop de 0 até a nota.</p>
          <a class="btn" href="atividade-1-classificacao/index.php">Abrir</a>
        </div>
        <div class="item">
          <h2>Atividade 2 — Formulário</h2>
          <p>Cadastro via POST com validação e exibição dos dados.</p>
          <a class="btn" href="atividade-2-formulario/index.php">Abrir</a>
        </div>
        <div class="item">
          <h2>Atividade 3 — Login (Sessões)</h2>
          <p>Login fixo, sessão, página protegida e logout.</p>
          <a class="btn" href="atividade-3-login/index.php">Abrir</a>
        </div>
        <div class="item">
          <h2>Atividade 4 — Cookies</h2>
          <p>Nome salvo em cookie por 7 dias e saudação.</p>
          <a class="btn" href="atividade-4-cookies/index.php">Abrir</a>
        </div>
        <div class="item">
          <h2>Atividade 5 — Desafio integrador</h2>
          <p>Login + cadastro + validação + listagem em sessão.</p>
          <a class="btn" href="atividade-5-desafio-integrador/login.php">Abrir</a>
        </div>
      </div>
    </main>
  </body>
</html>

