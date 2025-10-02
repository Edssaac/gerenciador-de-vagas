<main class="container">
    <div class="card mt-5">
        <div class="card-header font-weight-bold">Atualizar Senha</div>
        <div class="card-body bg-light">
            <form method="post">
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Nova Senha</label>
                    <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirmar Senha</label>
                    <div class="col-md-6">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
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