<?php 

    /* ARQUIVO RESPONSÁVEL PELA PÁGINA DE EDITAR A VAGA ESCOLHIDA */

    define('TITLE', 'Editar Vaga');
    require __DIR__.'/vendor/autoload.php';
    // PARA PODER USAR A CLASSE VAGA:
    use \App\Entity\Vaga;
    use \App\Session\Login;

    
    // OBRIGA O USUÁRIO ESTAR LOGADO:
    // Login::requireLogin();

    // Apenas para administradores:
    Login::requireAdminUser( true );

    // FAZENDO A VALIDAÇÃO DO ID:
    if ( !isset($_GET['id']) || !is_numeric($_GET['id']) )
    {
        header('location: index.php?status=error');
        exit;
    }

    // CONSULTA A VAGA:
    $objVaga = Vaga::getVaga($_GET['id']);
    // VALIDAÇÃO DA VAGA:
    if ( !$objVaga instanceof Vaga )
    {
        header('location: index.php?status=error');
        exit;
    }

    // FAZENDO A VALIDAÇÃO DOS DADOS CADASTRADOS:
    if ( isset( $_POST['titulo'], $_POST['descricao'], $_POST['ativo'] ) )
    {
        $objVaga->titulo = $_POST['titulo'];
        $objVaga->descricao = $_POST['descricao'];
        $objVaga->ativo = $_POST['ativo'];

        $objVaga->atualizar();

        header("location: index.php?status=success");
        exit;
    }


    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/formulario.php'; 
    include __DIR__.'/includes/applicationPage/footer.php';

?>