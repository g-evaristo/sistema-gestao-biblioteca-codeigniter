<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Produto</title>
    </head>
    <body>
        <h1>Novo Produto</h1>

        <form action="<?= base_url('produtos/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>

            <label>Estoque Mínimo:</label><br>
            <input type="number" id="estoque_minimo" name="estoque_minimo" placeholder="Estoque mínimo..." required>

            <br><br>

            <input type="submit" id="cadastrar_produto" name="cadastrar_produto" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('produtos') ?>"><button>Voltar</button></a>
    </body>
</html>