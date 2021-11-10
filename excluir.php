<?php 

    /* ARQUIVO RESPONSÁVEL PELA PÁGINA DE EXCLUIR A VAGA ESCOLHIDA */

    require __DIR__.'/vendor/autoload.php';
    // PARA PODER USAR A CLASSE VAGA:
    use \App\Entity\Vaga;
    use \App\Session\Login;

    
    // OBRIGA O USUÁRIO ESTAR LOGADO:
    Login::requireLogin();

    // Obrigando a ser um administrador:
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
    if ( isset( $_POST['excluir'] ) )
    {
        $objVaga->excluir();

        header("location: index.php?status=success");
        exit;
    }


    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/confirmar-exclusao.php'; 
    include __DIR__.'/includes/applicationPage/footer.php';

?>