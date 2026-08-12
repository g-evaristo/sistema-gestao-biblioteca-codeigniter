<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Página Inicial</title>
    </head>
    <body>
        <h1>Página Inicial</h1>
        <h2>Biblioteca Digital</h2>
        <h3>Bem vindo, <?= session()->get('usuario')['USU_NOME'] ?>!</h3>
        <a href="<?= base_url('produtos') ?>"><button>Cadastrar Livro</button></a>
        <a href="<?= base_url('estoque') ?>"><button>Gestão de Acervo</button></a>
        <a href="<?= base_url('logout') ?>"><button>Logout</button></a>
    </body>
</html>