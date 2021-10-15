<?php 

    /* ARQUIVO RESPONSÁVEL POR EXIBIR A PÁGINA DE CADASTRO DE VAGAS */

    define('TITLE', 'Cadastrar Vaga'); /* ATUALIZANDO O TÍTULO DA PÁGINA */
    require __DIR__.'/vendor/autoload.php';
    // PARA PODER USAR A CLASSE VAGA:
    use \App\Entity\Vaga;
    $objVaga = new Vaga;

    // FAZENDO A VALIDAÇÃO DOS DADOS CADASTRADOS:
    if ( isset( $_POST['titulo'], $_POST['descricao'], $_POST['ativo'] ) )
    {
        $objVaga->titulo = $_POST['titulo'];
        $objVaga->descricao = $_POST['descricao'];
        $objVaga->ativo = $_POST['ativo'];

        $objVaga->cadastrar();

        header("location: index.php?status=success");
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/formulario.php'; /* CARREGANDO O FORMULÁRIO RESPONSÁVEL POR REGISTRAR AS INFORMAÇÕES DA NOVA VAGA */
    include __DIR__.'/includes/footer.php';

    function Debugar($obj)
    {
        echo "<pre>";
        print_r($obj);
        echo "</pre>";
        exit;
    }

?>