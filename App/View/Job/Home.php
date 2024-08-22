<main class="container">
    <div class="jumbotron bg-info text-center mt-5">
        <h1>Banco de Vagas</h1>
        <p>Gerencie suas ofertas de negócio.</p>
        <div>
            <i class="fa-solid fa-circle-user"></i>
            <?php if ($data['user']) { ?>
                <div class="h4"><?= $data['user']['name'] ?></div>
                <a href="/user/logout" class="text-decoration-none text-dark font-weight-bold">Sair</a>
            <?php } else { ?>
                <div class="h4">Visitante</div>
                <a href="/user/login" class="text-decoration-none text-dark font-weight-bold">Entrar</a>
            <?php } ?>
        </div>
    </div>
    <?php if (isset($data['message'])) { ?>
        <div class='alert alert-<?= $data['message_type'] ?> mt-4 text-center' role='alert'>
            <?= $data['message'] ?>
        </div>
    <?php } ?>
    <section>
        <a href="/job/new">
            <button class="btn btn-success">Nova Vaga</button>
        </a>
    </section>
    <section>
        <form method="get">
            <div class="row align-items-end mt-5 filter-section">
                <div class="col-12 col-sm-7 col-md-5 col-lg-5">
                    <label for="filter_title">Buscar por título de vaga</label>
                    <input type="text" id="filter_title" name="filter_title" class="form-control" value="<?= $data['filter_title'] ?>">
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                    <label for="filter_status">Status</label>
                    <select id="filter_status" name="filter_status" class="form-control">
                        <option value="" <?= ($data['filter_status'] == '') ? 'selected' : '' ?>>Ativa/Inativa</option>
                        <option value="1" <?= ($data['filter_status'] == '1') ? 'selected' : '' ?>>Ativa</option>
                        <option value="0" <?= ($data['filter_status'] == '0') ? 'selected' : '' ?>>Inativa</option>
                    </select>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 d-md-flex justify-content-around">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="/" class="text-decoration-none text-light">
                        <button type="button" class="btn btn-danger">Limpar</button>
                    </a>
                </div>
            </div>
        </form>
    </section>
    <section>
        <div class="table-responsive my-2">
            <table class="table bg-white mt-3">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['jobs'])) { ?>
                        <?php foreach ($data['jobs'] as $job) { ?>
                            <tr class="job-<?= $job['id'] ?>">
                                <td><?= $job['title'] ?></td>
                                <td><?= $data['status_list'][$job['status']] ?></td>
                                <td><?= (date('d/m/Y á\s H:i:s', strtotime($job['date']))) ?></td>
                                <td class="text-center">
                                    <a href="/job/view?id=<?= $job['id'] ?>" class="text-decoration-none">
                                        <button class="btn btn-success m-1">
                                            <i class="fa-solid fa-eye text-light" title="Visualizar"></i>
                                        </button>
                                    </a>
                                    <?php if ($data['user'] && $data['user']['id'] == $job['user_id']) { ?>
                                        <a href="/job/edit?id=<?= $job['id'] ?>" class="text-decoration-none">
                                            <button class="btn btn-primary m-1">
                                                <i class="fa-solid fa-pen-to-square text-light" title="Editar"></i>
                                            </button>
                                        </a>
                                        <a class="text-decoration-none">
                                            <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#remove_job_modal" data-id="<?= $job['id'] ?>">
                                                <i class="fa-solid fa-trash text-light" title="Excluir"></i>
                                            </button>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma vaga cadastrada no momento.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <section>
        <div class="my-3">
            <?= $data['pagination'] ?>
        </div>
    </section>
</main>

<div class="modal fade" id="remove_job_modal" tabindex="-1" aria-labelledby="remove_job_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="remove_job_modal_label">
                    Tem certeza que deseja excluir esse registro?
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-none">
                <div class="alert alert-danger text-center" role="alert">
                    <div class="spinner-border d-none" role="status">
                        <span class="sr-only">...</span>
                    </div>
                    <p class="message d-none">Não foi possível excluir.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="remove_job">Excluir</button>
            </div>
        </div>
    </div>
</div>