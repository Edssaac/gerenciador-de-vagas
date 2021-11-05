<?php 

    /* ARQUIVO RESPONSÁVEL POR EXIBIR A PÁGINA DE CADASTRO DE VAGAS */

    define('TITLE', 'Cadastrar Vaga'); /* ATUALIZANDO O TÍTULO DA PÁGINA */
    require __DIR__.'/vendor/autoload.php';
    // PARA PODER USAR A CLASSE VAGA:
    use \App\Entity\Vaga;
    use \App\Session\Login;
    $objVaga = new Vaga;

    
    // OBRIGA O USUÁRIO ESTAR LOGADO:
    Login::requireLogin();
    

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

    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/formulario.php'; /* CARREGANDO O FORMULÁRIO RESPONSÁVEL POR REGISTRAR AS INFORMAÇÕES DA NOVA VAGA */
    include __DIR__.'/includes/applicationPage/footer.php';

?>