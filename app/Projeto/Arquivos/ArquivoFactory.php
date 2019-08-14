<?php namespace App\Projeto\Arquivos;

use App\Projeto\Financeiro\OrcamentoArquivo;

class ArquivoFactory
{
    protected $listaDeTipos;

    protected $listaDeEntities;


    public function __construct()
    {
        $this->listaDeTipos = [
            'orcamentos' => ArquivoOrcamento::class,
        ];
    }

    public function createArquivo($tipo)
    {
        if (!array_key_exists($tipo, $this->listaDeTipos)) {
            throw new \InvalidArgumentException("$tipo Não é um arquivo válido");
        }

        $className = $this->listaDeTipos[$tipo];
        return new $className();
    }

}