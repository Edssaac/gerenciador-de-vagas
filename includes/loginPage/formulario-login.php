<!-- FORMULÁRIO DE LOGIN PARA USUÁRIOS JÁ REGISTRADOS -->

<main class="login-form">
    <div class="cotainer">

        <div class="mt-5"></div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Entrar</div>

                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email_address" class="form-control" name="email_address" required autofocus maxlength="25">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required minlength="5" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Lembrar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                                <a href="redefinir-senha.php" class="btn btn-link">
                                    Esqueceu sua senha?
                                </a>
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