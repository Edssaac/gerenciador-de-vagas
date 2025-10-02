<main class="container">
    <div class="card mt-5">
        <div class="card-header font-weight-bold">Acessar Conta</div>
        <div class="card-body bg-light">
            <form method="post">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-6">
                        <input type="email" id="email" name="email" class="form-control" required maxlength="100" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                    <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <!-- 
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Lembrar
                            </label>
                        </div>
                    </div>
                </div> 
                -->
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Entrar
                    </button>
                    <a href="/user/reset" class="btn btn-link text-light">
                        Esqueceu sua senha?
                    </a>
                </div>
            </form>
        </div>
    </div>
    <?php if (isset($data["message"])) { ?>
        <div class="alert alert-<?= $data["message_type"] ?> mt-4 text-center" role="alert">
            <?= $data["message"] ?>
        </div>
    <?php } ?>
</main>