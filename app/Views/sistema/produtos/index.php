<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Livros</title>
    </head>
    <body>
        <h1>Lista de Livros</h1>

        <form method="POST" action="<?= base_url('produtos') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Estoque Mínimo</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['PRO_NOME'] ?></td>
                    <td><?= $produto['PRO_ESTOQUE_MINIMO'] ?></td>
                    <td><a href="<?= base_url('produtos/editar/'.$produto['PRO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('produtos/excluir/'.$produto['PRO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('produtos/novo') ?>"><button>Cadastrar Livro</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>