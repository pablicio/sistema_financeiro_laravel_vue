<?php namespace App\Projeto\Arquivos;

use App\Projeto\Financeiro\OrcamentoArquivo;
use Illuminate\Support\Facades\Storage;

class ArquivoOrcamento implements ArquivoInterface
{
    public function upload($request)
    {
        $file = file_get_contents($request->arquivo->path());

        $file_name ='orcamentos' . DIRECTORY_SEPARATOR .
            str_random(20) . DIRECTORY_SEPARATOR .
            $request->arquivo->getClientOriginalName();

        $url = self::saveFileToStorage($file_name, $file);

        self::createOcamentoArquivo($url,  $request->arquivo->getClientOriginalName(), $request->orcamento_id);
    }

    public function createArquivo($link, $file_name, $orcamento_id)
    {
        OrcamentoArquivo::create([
            'orcamento_id' => $orcamento_id,
            'nome' => $file_name,
            'link' => $link
        ]);
    }

    public function saveFileToStorage($file_name, $file)
    {
        Storage::put($file_name, $file);

        return Storage::url($file_name);
    }
}