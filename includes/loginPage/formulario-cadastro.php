<!-- FORMULÁRIO DE CADASTRO PARA NOVOS USUÁRIOS -->


<main class="my-form">
    <div class="cotainer">

        <div class="mt-5"></div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Cadastro</div>

                    <div class="card-body">
                        <form name="my-form" action="" method="POST">
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">Nome Completo</label>
                                <div class="col-md-6">
                                    <input type="text" id="full_name" class="form-control" name="full_name" required autofocus maxlength="50">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email_address" class="form-control" name="email_address" required maxlength="25">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">Nome de Usuário</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_name" class="form-control" name="username" required maxlength="15">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" minlength="5" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirmar Senha</label>
                                <div class="col-md-6">
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" minlength="5" maxlength="10">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
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