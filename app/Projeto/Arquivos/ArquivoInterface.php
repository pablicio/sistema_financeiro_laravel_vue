<?php namespace App\Projeto\Arquivos;

interface ArquivoInterface
{
    public function upload($request);

    public function saveFileToStorage($file_name, $file);


}