<?php

    /*
        CLASSE RESPONSÁVEL POR CONTER FUNÇÕES DE DIVERSAS UTILIDADES.
    */

    namespace App\Utils;

    use Dompdf\Dompdf;
    use Dompdf\Options;


    class Util
    {

        // Método responsável por receber um objeto da classe vaga 
        // e retornar um corpo html com o conteúdo da vaga.
        public static function getVagaPDF( $objVaga )
        {
            // Instâncias do Dompdf:
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);

            $pagina = 
            '
            <head> 
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
        
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
                <!-- PAGE ICON -->
                <link rel="shortcut icon" href="https://img.icons8.com/plasticine/100/000000/find-matching-job.png">
        
                <title>Vaga</title>
            </head>

            <main>
                <div class="container">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" name="titulo" value="'.$objVaga->titulo.'" disabled>
                    </div>
            
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea style="resize:none;" class="form-control text-justify" name="descricao" rows="10" disabled>'.$objVaga->descricao.'</textarea>
                    </div>
            
                    <div class="form-group">
                        <label>Status</label>
                        
                        <div>
                            <div class="form-check form-check-inline">
                                <label class="form-control">
                                    <input type="radio" name="ativo" value="s" checked disabled> Ativo
                                </label>
                            </div>
            
                            <div class="form-check form-check-inline">
                                <label class="form-control">
                                    <input type="radio" name="ativo" value="n" '.(($objVaga->ativo=='n')?'checked':'').' disabled> Inativo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            ';

            // // Carrega o html para dentro da classe:
            $dompdf->loadHtml($pagina);

            // // Renderiza o html em pdf:
            $dompdf->render();

            // // Cabeçalho de impressão:
            header('Content-type: application/pdf');
            // // Imprimir o conteúdo do pdf na tela:
            echo $dompdf->output();
        }

    }

?>