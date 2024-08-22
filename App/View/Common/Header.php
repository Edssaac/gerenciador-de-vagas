<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="/public/css/main.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <?php foreach ($data['scripts'] as $script) { ?>
        <script src="/public/js/<?= $script ?>.js" defer></script>
    <?php } ?>

    <link rel="shortcut icon" href="/public/images/vacancy-manager.png" type="image/png">

    <title><?= $data['title'] ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/">
            <img src="/public/images/vacancy-manager.png" width="30" height="30" alt="vacancy-manager">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="headerNav">
            <div class="navbar-nav text-right">
                <a class="nav-link text-dark" href="/">Vagas</a>
                <?php if ($data['logged']) { ?>
                    <a class="nav-link text-dark" href="/job/new">Cadastrar Vaga</a>
                    <a class="nav-link text-dark" href="/user/logout">Sair</a>
                <?php } else { ?>
                    <a class="nav-link text-dark" href="/user/login">Acessar Conta</a>
                    <a class="nav-link text-dark" href="/user/register">Cadastrar</a>
                <?php } ?>
            </div>
        </div>
    </nav>