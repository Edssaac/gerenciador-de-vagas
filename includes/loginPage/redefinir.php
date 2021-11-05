<!-- 
    PÁGINA RESPONSÁVEL POR ALTERAR A SENHA DO USUÁRIO SE O TOKEN ESTIVER VÁLIDO, SE NÃO ESTIVER 
    ENTÃO MOSTRAR UMA MENSAGEM PARA TAL.
-->

<?php

    if ( $ativo )
    {
        $corpo =
        '
        <div class="container">
            <div class="card bg-danger">
                <div class="card-header">Atualizar Senha</div>

                <div class="card-body bg-secondary">
                    <form name="my-form" action="" method="POST">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nova Senha</label>
                            <div class="col-md-6">
                                <input type="password" id="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirmar Senha</label>
                            <div class="col-md-6">
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-3">
                '.$mensagem.'
            </div>

        </div>
        ';
    }
    else
    {
        $corpo =
        '
        <div class="container">
            <div class="jumbotron bg-danger">
                <h2>Atenção</h2>

                <p class="h6">Página inválida, por favor tente trocar a senha novamente.</p>
            </div>
        </div>
        ';
    }

?>

<main>

    <?=$corpo?>

</main>