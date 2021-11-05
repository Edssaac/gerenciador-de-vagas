<?php 

    /* ARQUIVO RESPONSÁVEL PELA PÁGINA DE EDITAR A VAGA ESCOLHIDA */

    define('TITLE', 'Visualizar Vaga');
    require __DIR__.'/vendor/autoload.php';
    // PARA PODER USAR A CLASSE VAGA:
    use \App\Entity\Vaga;
    use \App\Session\Login;

    
    // OBRIGA O USUÁRIO ESTAR LOGADO:
    Login::requireLogin();
    

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

    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/formulario-visualizar.php'; 
    include __DIR__.'/includes/applicationPage/footer.php';

?>