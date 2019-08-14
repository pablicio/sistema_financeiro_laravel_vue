<?php namespace App\Projeto\Arquivos;

use Barryvdh\DomPDF\Facade as PDF;

class GeraDocumento
{
    public static function generateDoc($entity, $tipo)
    {
        $pdf = self::renderPrdf($entity, $tipo);

        $file_name = date('Y-m-d') . '_' . $tipo . '_' . $entity->id . '.pdf';

        $file =
            str_random(20) .
            DIRECTORY_SEPARATOR .
            $file_name;


        $factory = new ArquivoFactory();

        $arquivo = $factory->createArquivo($tipo);

        $url = $arquivo->saveFileToStorage($file, $pdf->output());

        $arquivo->createArquivo($url, $file_name, $entity->id);

        return $pdf;
    }

    public static function renderPrdf($entity, $tipo)
    {
        return PDF::loadView('pdfs.' . $tipo, compact('entity'))
            ->setPaper('A4', 'portrait');
    }

}


