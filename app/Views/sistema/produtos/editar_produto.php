<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Livro</title>
    </head>
    <body>
        <h1>Editar Livro</h1>

        <form action="<?= base_url('produtos/atualizar/'.$produto['PRO_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $produto['PRO_NOME'] ?>" required>
            <br><br>
            <label>Estoque Mínimo:</label><br>
            <input type="text" id="estoque_minimo" name="estoque_minimo" value="<?= $produto['PRO_ESTOQUE_MINIMO'] ?>" required>
            <br><br>
            <input type="submit" id="editar_produto" name="editar_produto" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('produtos') ?>"><button>Voltar</button></a>
    </body>
</html>