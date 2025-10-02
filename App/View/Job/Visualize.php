<main class="container">
    <section class="mt-5">
        <a href="/">
            <button class="btn btn-warning">Voltar</button>
        </a>
    </section>
    <form method="post" target="_blank" class="mt-4">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control bg-white text-dark" value="<?= $data["job"]["title"] ?>" disabled>
        </div>
        <div class="form-group">
            <label>Status: <span class="badge badge-pill badge-secondary"><?= $data["status_list"][$data["job"]["status"]] ?></span></label>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control bg-white text-dark" disabled><?= $data["job"]["description"] ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" id="print" name="print" class="btn btn-primary">
                <i class="fa-solid fa-file-pdf"></i> Baixar
            </button>
        </div>
    </form>
</main>