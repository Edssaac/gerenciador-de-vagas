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
        
                <!-- PAGE ICON -->
                <link rel="shortcut icon" href="https://img.icons8.com/plasticine/100/000000/find-matching-job.png">
        
                <title>Vaga</title>

                <style>
                    
                    * {
                        margin: 0;
                        padding: 0;
                        background-color: #343a40;
                        color: white;
                    }

                    .container {
                        width: 100%;
                        margin-top: 50px;
                        margin-right: 50px;
                        margin-left: 50px;
                        background-color:
                    }

                    .form-control {
                        display: block;
                        width: 100%;
                        height: auto;
                        text-align: justify;
                        padding: 10px;
                    }

                    .form-group {
                        margin-bottom: 30px;
                        display: block;
                    }

                    .form-check {
                        border: 1px solid #ced4da;
                        border-radius: 0.25rem;
                    }

                    div.form-check-inline {
                        display: inline-block;
                        margin-bottom: 10px;
                        margin-right: 10px;
                    }

                    div.form-check label input {
                        margin-top: 3px;
                    }

                    div.form-check.form-check-inline {
                        padding-right: 3px;
                        padding-left: 3px;
                        width: 130px;
                    }
                    
                    label {
                        display: inline-block;
                        margin-bottom: 0.5rem;
                    }

                    input, textarea {
                        margin: 0;
                        border-radius: 0.25rem;
                        font-family: inherit;
                        font-size: inherit;
                    }                   

                </style>

            </head>

            <div class="container">
                <main>
                    <div>
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

                    <div>
                        Disponível em: <b>https://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"].' </b>                   </div>
                </main>
            <div>
            ';

            // Carrega o html para dentro da classe:
            $dompdf->loadHtml($pagina);

            // Renderiza o html em pdf:
            $dompdf->render();

            // Cabeçalho de impressão:
            header('Content-type: application/pdf');
            // Imprimir o conteúdo do pdf na tela:
            //echo $dompdf->output();
            $dompdf->stream( 'Vaga_'.$objVaga->titulo );
        }

    }

?>