<!-- FORMULÁRIO DE LOGIN PARA USUÁRIOS JÁ REGISTRADOS -->

<main class="login-form">
    <div class="cotainer">

        <div class="mt-5"></div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card bg-danger">

                    <div class="card-header">Entrar</div>

                    <div class="card-body bg-secondary ">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" required autofocus maxlength="25">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
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
                                <a href="redefinir-senha.php" class="btn btn-link text-light">
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