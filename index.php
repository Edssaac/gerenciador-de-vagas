<?php 

    /* ARQUIVO RESPONSÁVEL POR SER A PÁGINA INICIAL E PRINCIPAL DO SITE */

    require __DIR__.'/vendor/autoload.php';
    use \App\Entity\Vaga;
    use \App\Db\Pagination;
    use \App\Session\Login;

    
    // OBRIGA O USUÁRIO ESTAR LOGADO:
    //Login::requireLogin();

    // Tela inicial, podem acessar com ou sem login
    $acesso = Login::requireAdminUser( false );

    // BUSCA:
    $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

    // STATUS:
    $filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
    $filtroStatus = in_array($filtroStatus, ['s', 'n']) ? $filtroStatus : '';
    
    // CONDIÇÕES SQL:
    $condicoes = [
        strlen($busca) ? 'titulo LIKE "%'.str_replace(' ', '%', $busca).'%"' : null,
        strlen($filtroStatus) ? 'ativo = "'.$filtroStatus.'"' : null
    ];

    // REMOVE POSIÇÕES VAZIAS:
    $condicoes = array_filter($condicoes);

    // CLÁUSULA WHERE:
    $where = implode(' AND ', $condicoes);

    // QUANTIDADE TOTAL DE VAGAS:
    $quantidadeVagas = Vaga::getQuantidadeVagas($where);

    // PAGINAÇÃO:
    $objPagination = new Pagination( $quantidadeVagas, $_GET['pagina'] ?? 1, 6 );


    /* PEGANDO TODAS AS VAGAS PARA PODER PASSAR PARA O LISTAGEM.PHP */
    $vagas = Vaga::getVagas($where, null, $objPagination->getLimit()); 


    include __DIR__.'/includes/applicationPage/header.php';
    include __DIR__.'/includes/applicationPage/listagem.php'; /* RESPONSÁVEL POR LISTAR TODAS AS VAGAS CADASTRADAS */
    include __DIR__.'/includes/applicationPage/footer.php';

?>