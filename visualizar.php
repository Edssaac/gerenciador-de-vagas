<?php 

    /* ARQUIVO RESPONSÁVEL PELA PÁGINA DE EDITAR A VAGA ESCOLHIDA */

    define('TITLE', 'Visualizar Vaga');
    require __DIR__.'/vendor/autoload.php';
    
    // Dependências necessárias:
    use \App\Entity\Vaga;
    use \App\Session\Login;
    use \App\Utils\Util;
    
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

    // Verificando se foi requisitado a impressão da vaga:
    if ( isset( $_POST['imprimir'] ) )
    {
        Util::getVagaPDF( $objVaga );
    }


    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/formulario-visualizar.php'; 
    include __DIR__.'/includes/applicationPage/footer.php';

?>