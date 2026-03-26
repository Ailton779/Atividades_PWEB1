# Unidade 1 — Atividades (Programação Web I)

Projeto acadêmico em **PHP procedural** com **HTML**, abordando:

- Estruturas condicionais e laços
- Formulários e validação via `POST`
- **Sessões** (`session_start()`, `$_SESSION`)
- **Cookies** (`setcookie()`, `$_COOKIE`)

## Como executar

Você pode rodar em um servidor local (XAMPP/WAMP/Laragon) ou com o servidor embutido do PHP.

### Opção A) XAMPP/WAMP

1. Copie a pasta `unidade-1/` para a pasta pública do servidor (ex.: `htdocs` no XAMPP).
2. Acesse no navegador: `http://localhost/unidade-1/`

### Opção B) PHP Built-in Server

No terminal, a partir da pasta que contém `unidade-1/`:

```bash
php -S localhost:8000 -t unidade-1
```

Depois acesse: `http://localhost:8000/`

## Estrutura de pastas

```
unidade-1/
├── index.php
├── atividade-1-classificacao/
│   ├── index.php
│   └── style.css
├── atividade-2-formulario/
│   ├── index.php
│   └── style.css
├── atividade-3-login/
│   ├── index.php
│   ├── painel.php
│   ├── logout.php
│   └── style.css
├── atividade-4-cookies/
│   ├── index.php
│   ├── reset.php
│   └── style.css
└── atividade-5-desafio-integrador/
    ├── login.php
    ├── painel.php
    ├── logout.php
    ├── auth.php
    └── style.css
```

## Tecnologias usadas

- PHP (procedural)
- HTML5
- CSS básico

## Observações

- As credenciais das atividades com login são **fixas** (conforme enunciado).
- Os dados do “desafio integrador” ficam **temporariamente em memória** via `$_SESSION` (não há banco de dados).

