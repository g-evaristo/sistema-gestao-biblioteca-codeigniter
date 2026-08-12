<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ProdutosModel extends Model
{
    protected $table = 'PRODUTOS'; // nome da tabela
    protected $primaryKey = 'PRO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela PRODUTOS do banco
        'PRO_NOME',
        'PRO_ESTOQUE_MINIMO'
    ];
}