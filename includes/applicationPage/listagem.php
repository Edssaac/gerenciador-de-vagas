<?php

    /* ARQUIVO RESPONSÁVEL POR EXIBIR TODAS AS VAGAS CONTIDAS NO ARRAY PEGO NO INDEX.PHP */
    use \App\Entity\Vaga;
    

    $mensagem = '';
    if ( isset($_GET['status']) )
    {
        switch ( $_GET['status'] ) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            
            case 'error':
                $mensagem = '<div class="alert alert-success">Ação não executada!</div>';
                break;

            case 'clear':
                //Vaga::clsDB();
                break;
        }
    }

    if ( $acesso ) // Interface Adminstrativa:
    {
        $resultados = ''; /* VARIÁVEL QUE ARMAZENARA TODAS AS VAGAS DENTRO DE NOSSO ARRAY */
        foreach ( $vagas as $vaga ) /* CRIANDO UMA LINHA NA TABELA PARA CADA VAGA DISPONÍVEL */
        {
            $desc = ( strlen($vaga->descricao)>20 ) ? substr( $vaga->descricao, 0, 11 )."..." : $vaga->descricao;
    
            $resultados .= '<tr>
                                <td>'.$vaga->id.'</td>
                                <td><a href="visualizar.php?id='.$vaga->id.'" class="text-decoration-none">'.$vaga->titulo.'</td>
                                <td>'.$desc.'</td>
                                <td>'.(($vaga->ativo=='s') ? 'Ativo':'Inativo').'</td>
                                <td>'.(date('d/m/Y á\s H:i:s', strtotime($vaga->data))).'</td>
                                <td class="btns">
                                    <a href="editar.php?id='.$vaga->id.'"><button type="button" class="btn btn-primary">Editar</button></a>
                                    <a href="excluir.php?id='.$vaga->id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
                                </td>
                            </tr>';
        }
    
        $ths = '
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data</th>
            <th>Ações</th>
        ';
    
        // Avisa se não houver nenhuma vaga cadastrada:
        if ( $resultados == '' )
            $resultados = '<tr><td colspan="6" class="text-center">Nenhuma vaga cadastrada no momento.</td></tr>';  
    }
    else // Interface Usuário Comum
    {
        $resultados = ''; /* VARIÁVEL QUE ARMAZENARA TODAS AS VAGAS DENTRO DE NOSSO ARRAY */
        foreach ( $vagas as $vaga ) /* CRIANDO UMA LINHA NA TABELA PARA CADA VAGA DISPONÍVEL */
        {
            $desc = ( strlen($vaga->descricao)>40 ) ? substr( $vaga->descricao, 0, 40 )."..." : $vaga->descricao;
    
            $resultados .= '<tr>
                                <td><a href="visualizar.php?id='.$vaga->id.'" class="text-decoration-none">'.$vaga->titulo.'</td>
                                <td>'.$desc.'</td>
                                <td>'.(($vaga->ativo=='s') ? 'Ativo':'Inativo').'</td>
                                <td>'.(date('d/m/Y á\s H:i:s', strtotime($vaga->data))).'</td>
                            </tr>';
        }
    
        $ths = '
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data</th>
        ';
    
        // Avisa se não houver nenhuma vaga cadastrada:
        if ( $resultados == '' )
            $resultados = '<tr><td colspan="4" class="text-center">Nenhuma vaga cadastrada no momento.</td></tr>';  
    }


    // Limpar alguns campos do GET:
    unset($_GET['status']);
    unset($_GET['pagina']);
    $gets = http_build_query($_GET);

    // Criando a paginação:
    $paginas = $objPagination->getpages();
    $paginacao = '';

    $hasFields = isset( $_GET['busca'], $_GET['filtroStatus'] ) ? '&' : '';

    foreach ( $paginas as $key=>$pagina )
    {
        $class = ($pagina['atual'] ? 'btn-primary' : 'btn-light');
        $paginacao .= '<a href="?pagina='.$pagina['pagina'].$hasFields.$gets.'">
                        <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                       </a>';
    }

?>


<main> <!-- SEÇÃO QUE CONSTROI A TABELA COM AS VAGAS -->

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova Vaga</button>
        </a>
    </section>

    <section>

        <form method="get">
            
            <div class="row my-4 align-items-end">

                <div class="col busca">
                    <label>Buscar por título de vaga</label>
                    <input type="text" name="busca" class="form-control" value="<?=$busca?>">
                </div>

                <div class="col status">
                    <label>Status</label>
                    <select name="filtroStatus" class="form-control">
                        <option value="">Ativa/Inativa</option>
                        <option value="s" <?=($filtroStatus=='s')?'selected':''?>>Ativa</option>
                        <option value="n" <?=($filtroStatus=='n')?'selected':''?>>Inativa</option>
                    </select>
                </div>

                <div class="col buttons d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <button class="btn btn-danger mx-4"><a href="index.php" class="text-decoration-none text-light">Limpar</a></button>
                </div>

            </div>

        </form>

    </section>

    <section>

        <div class="table-responsive mb-1">
            <table class="table bg-light mt-3">
                <thead>
                    <tr>
                        <?=$ths?>
                    </tr>
                </thead>
                
                <tbody>
                    <?=$resultados?> <!-- PREENCHENDO AS LINHAS DA TABELA DE FORMA DINÂMICA -->
                </tbody>
            </table>
        </div>

    </section>

    <section>
        <div class="mb-3">
            <?=$paginacao?> <!-- CRIANDO A PAGINAÇÃO DE FORMA DINÂMICA -->
        </div>
    </section>

</main>