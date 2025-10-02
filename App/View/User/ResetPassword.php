<main class="container">
    <div class="card mt-5">
        <div class="card-header font-weight-bold">Redefinir Senha</div>
        <div class="card-body bg-light">
            <form method="post">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-6">
                        <input type="email" id="email" name="email" class="form-control" required maxlength="100" autofocus>
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
    <?php if (isset($data["message"])) { ?>
        <div class="alert alert-<?= $data["message_type"] ?> mt-4 text-center" role="alert">
            <?= $data["message"] ?>
        </div>
    <?php } ?>
</main>