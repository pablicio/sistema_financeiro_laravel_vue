<?php namespace App\Projeto\Financeiro;

use App\Projeto\Entity;

class OrcamentoArquivo extends Entity
{
    protected $table = "orcamentos_arquivos";

    protected $fillable = [
        'orcamento_id',
        'nome',
        'link',
    ];
}
