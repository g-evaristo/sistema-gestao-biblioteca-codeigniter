<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Gestão do Acervo</title>
    </head>
    <body>
        <h1>Gestão do Acervo</h1>

        <form method="POST" action="<?= base_url('estoques') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <!-- Mensagem de alerta retornada do Controller -->
        <?php if(session()->getFlashdata('mensagem')): ?>
            <h3>
                <?= session()->getFlashdata('mensagem') ?>
            </h3>
        <?php endif; ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Estoque Mínimo</th>
                <th>Quantidade em Estoque</th>
                <th>Ação</th>
                <th>Quantidade</th>
                <th>Atualizar Estoque</th>
            </tr>

            <?php foreach($estoques as $estoque): ?>

                <form method="POST" action="<?= base_url('estoque/atualizar') ?>">
                    <tr>
                        <td><input type="number" name="pro_id" value="<?= $estoque['PRO_ID'] ?>" readonly></td>
                        <td><input type="text" name="pro_nome" value="<?= $estoque['PRO_NOME'] ?>" readonly></td>
                        <td><input type="number" name="pro_estoque_minimo" value="<?= $estoque['PRO_ESTOQUE_MINIMO'] ?>" readonly></td>
                        <td><input type="number" name="estoque_quantidade" value="<?= $estoque['EST_QUANTIDADE'] ?>" readonly></td>
                        <td>
                            <select id="acao_estoque" name="acao_estoque" required>
                                <option value="">Selecione...</option>
                                <option value="ENTRADA">Entrada no Estoque</option>
                                <option value="SAIDA">Saída do Estoque</option>
                            </select>
                        </td>
                        <td><input type="number" id="quantidade" name="quantidade" min="1" required></td> 
                        <td><input type="submit" id="botao_atualizar" name="botao_atualizar" value="Atualizar Estoque"></td>
                    </tr>
                </form>

            <?php endforeach; ?>

        </table>

        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>