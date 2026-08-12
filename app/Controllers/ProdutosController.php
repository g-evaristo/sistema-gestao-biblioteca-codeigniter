<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProdutosModel;
use App\Models\EstoquesModel;

class ProdutosController extends BaseController
{
    public function index()
    {
        // Instancia o model
        $model = new ProdutosModel();

        // Se o usuário utilizar o botão de pesquisar
        if ($this->request->getPost('botao_pesquisar')) {
            // Recupera o texto digitado no campo de pesquisa.
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os produtos com a filtragem por nome ou estoque mínimo
            $dados['produtos'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_ESTOQUE_MINIMO', $pesquisar)
                ->findAll();
        }
        else {
            // Caso nenhuma pesquisa tenha sido realizada, busca tudo
            $dados['produtos'] = $model->findAll();
        }

        // Carrega a view e envia os dados
        return view('/sistema/produtos/index', $dados);
    }

    public function novo()
    {
        // Apenas carrega o formulário
        return view('/sistema/produtos/novo_produto');
    }

    public function inserir()
    {
        // Instancia o model de produtos
        $produtosModel = new ProdutosModel();

        // Instancia o model de estoques
        $estoquesModel = new EstoquesModel();

        // Pega os dados enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_ESTOQUE_MINIMO' => $this->request->getPost('estoque_minimo')
        ];

        // Insere o produto e guarda o ID gerado pelo banco
        $produtoId = $produtosModel->insert($dados);

        // Cria automaticamente o estoque do novo produto
        $estoquesModel->insert([
            'EST_QUANTIDADE' => 0,
            'FK_PRO_ID' => $produtoId
        ]);

        // Redireciona para a listagem de produtos
        return redirect()
            ->to(base_url('produtos'))
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function editar($id)
    {
        // Instancia o model
        $model = new ProdutosModel();

        // Busca o produto pelo ID
        $dados['produto'] = $model->find($id);

        // Carrega o formulário de edição
        return view('sistema/produtos/editar_produto', $dados);
    }

    public function atualizar($id)
    {
        // Instancia o model
        $model = new ProdutosModel();

        // Pega os dados do formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_ESTOQUE_MINIMO' => $this->request->getPost('estoque_minimo'),
        ];

        // Atualiza no banco
        $model->update($id, $dados);

        // Redireciona
        return redirect()->to('/produtos');
    }

    public function excluir($id)
    {
        // Instancia o model
        $model = new ProdutosModel();

        // Exclui o produto pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()->to('/produtos');
    }

}