<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class EstoquesModel extends Model
{
    protected $table = 'ESTOQUES'; // nome da tabela
    protected $primaryKey = 'EST_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela ESTOQUES do banco
        'EST_QUANTIDADE',
        'FK_PRO_ID'
    ];
}