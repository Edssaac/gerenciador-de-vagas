<!-- FORMULÁRIO RESPONSÁVEL POR ENVIAR NOVA SENHA PARA USUÁRIO -->


<main class="login-form">
    <div class="cotainer">

        <div class="mt-5"></div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card bg-danger">

                    <div class="card-header">Redefinir Senha</div>

                    <div class="card-body bg-secondary">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email_address" class="form-control" name="email_address" required autofocus maxlength="25">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    
                </div>

                <div class="mt-3">
                    <?=$mensagem?>
                </div>

            </div>
        </div>
    </div>
</main>