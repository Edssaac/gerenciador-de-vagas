<?php

namespace Library;

use Dompdf\Dompdf;
use Dompdf\Options;

class Scanner
{
    public static function render(array $job): void
    {
        $options = new Options();
        $options->setChRoot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        $page = self::getHtmlPage($job);

        $dompdf->loadHtml($page);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        header('Content-type: application/pdf');
        // echo $dompdf->output();
        $dompdf->stream('Vaga - ' . $job['title']);
    }

    private static function getHtmlPage($job): string
    {
        $status_list = [
            0 => 'Inativa',
            1 => 'Ativa'
        ];

        $html = '
            <!DOCTYPE html>
            <html lang="pt-BR">

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <link rel="stylesheet" 
                    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
                    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
                    crossorigin="anonymous"
                >

                <title>Vaga</title>
            </head>

            <body>
                <main>
                    <h1 class="text-center">Banco de Vagas</h1>
                    <div class="mt-5">
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Título</label>
                            <input type="text" id="title" name="title" class="form-control" value="' . $job['title'] . '" disabled>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                Status: 
                                <span class="badge badge-pill badge-secondary">' . $status_list[$job['status']] . '</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Descrição</label>
                            <textarea id="description" name="description" class="form-control" rows="10" disabled>' . $job['description'] . '</textarea>
                        </div>
                    </div>
                </main>
            </body>
            </html>
        ';

        return $html;
    }
}
