<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\EstoquesModel;
use App\Models\MovimentacoesModel;

class EstoqueController extends BaseController
{
    public function index()
    {
        // Instancia o model
        $model = new EstoquesModel();

        // Se o usuário utilizar o botão de pesquisar
        if($this->request->getPost('botao_pesquisar')){
            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os estoques juntamente com os dados dos produtos, com a filtragem
            $dados['estoques'] = $model
                ->select('ESTOQUES.*, PRODUTOS.PRO_ID, PRODUTOS.PRO_NOME, PRODUTOS.PRO_ESTOQUE_MINIMO')
                ->join('PRODUTOS', 'PRODUTOS.PRO_ID = ESTOQUES.FK_PRO_ID')
                ->like('PRODUTOS.PRO_NOME', $pesquisar)
                ->orderBy('PRODUTOS.PRO_NOME', 'ASC')
                ->findAll();
        }
        else{
            // Caso nenhuma pesquisa tenha sido realizada, busca tudo
            $dados['estoques'] = $model
                ->select('ESTOQUES.*, PRODUTOS.PRO_ID, PRODUTOS.PRO_NOME, PRODUTOS.PRO_ESTOQUE_MINIMO')
                ->join('PRODUTOS', 'PRODUTOS.PRO_ID = ESTOQUES.FK_PRO_ID')
                ->orderBy('PRODUTOS.PRO_NOME', 'ASC')
                ->findAll();
        }

        // Carrega a view da gestão de estoque
        // e envia os dados encontrados para a página
        return view('sistema/estoque/index', $dados);
    }

    public function atualizar()
    {
        // Instancia os models
        $estoquesModel = new EstoquesModel();
        $movimentacoesModel = new MovimentacoesModel();

        // Recupera os dados enviados pelo formulário
        $produtoId = $this->request->getPost('pro_id');
        $produtoNome = $this->request->getPost('pro_nome');
        $estoqueMinimo = $this->request->getPost('pro_estoque_minimo');
        $acao = $this->request->getPost('acao_estoque');
        $quantidade = $this->request->getPost('quantidade');
        
        // Busca no banco de dados o estoque correspondente ao produto selecionado
        $estoque = $estoquesModel
            ->where('FK_PRO_ID', $produtoId)
            ->first();

        // Verifica se a movimentação é uma entrada de estoque
        if($acao == 'ENTRADA'){
            // Soma a quantidade informada com a quantidade atual do estoque
            $novaQuantidade = $estoque['EST_QUANTIDADE'] + $quantidade;
        }
        else{
            // Caso seja uma saída, subtrai a quantidade informada da quantidade atual do estoque
            $novaQuantidade = $estoque['EST_QUANTIDADE'] - $quantidade;

            // Verifica se a saída deixaria o estoque com quantidade negativa
            if($novaQuantidade < 0){
                return redirect()
                    ->to(base_url('estoque'))
                    ->with('mensagem', '<span style="color:red"> Livro '.$produtoNome.': <br> Quantidade de saída maior que o estoque disponível!</span>');
            }
        }

        // Atualiza a quantidade do estoque no banco de dados
        $estoquesModel->update($estoque['EST_ID'], [
            'EST_QUANTIDADE' => $novaQuantidade
        ]);

        // Registra a movimentação realizada na tabela MOVIMENTACOES
        $movimentacoesModel->insert([
            'MOV_TIPO' => $acao, // Armazena se a movimentação foi ENTRADA ou SAIDA
            'MOV_QUANTIDADE' => $quantidade, // Armazena a quantidade movimentada
            'MOV_DATA_HORA' => date('Y-m-d H:i:s'), // Armazena a data e hora da movimentação
            'FK_PRO_ID' => $produtoId, // Relaciona a movimentação ao produto
            'FK_USU_ID' => session()->get('usuario')['USU_ID'] // Relaciona a movimentação ao usuário que está logado
        ]);

        // Verifica se a nova quantidade ficou abaixo do estoque mínimo
        if($novaQuantidade < $estoqueMinimo){
            return redirect()
                ->to(base_url('estoque'))
                ->with('mensagem', '<span style="color:red"> Livro '.$produtoNome.': <br> Atenção! O estoque está abaixo do estoque mínimo!</span>');
        }

        // Caso a movimentação seja realizada normalmente
        return redirect()
            ->to(base_url('estoque'))
            ->with('mensagem', '<span style="color:green"> Livro '.$produtoNome.': <br> Estoque atualizado com sucesso!</span>');
    }
}