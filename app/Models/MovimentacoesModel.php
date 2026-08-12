<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class MovimentacoesModel extends Model
{
    protected $table = 'MOVIMENTACOES'; // nome da tabela
    protected $primaryKey = 'MOV_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela MOVIMENTACOES do banco
        'MOV_TIPO',
        'MOV_QUANTIDADE',
        'MOV_DATA_HORA',
        'FK_PRO_ID',
        'FK_USU_ID'
    ];
}