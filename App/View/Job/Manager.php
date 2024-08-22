<main class="container">
    <section class="mt-5">
        <a href="/">
            <button class="btn btn-warning">Voltar</button>
        </a>
    </section>
    <h2 class="mt-3"><?= $data['header_title'] ?></h2>
    <?php if (isset($data['message'])) { ?>
        <div class='alert alert-<?= $data['message_type'] ?> mt-4 text-center' role='alert'>
            <?= $data['message'] ?>
        </div>
    <?php } ?>
    <form method="post">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= $data['input_title'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control" required><?= $data['input_description'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="status" value="1" <?= ($data['input_status'] == '1') ? 'checked' : '' ?>> Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="status" value="0" <?= ($data['input_status'] == '0') ? 'checked' : '' ?>> Inativo
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</main>