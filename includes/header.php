<?php

  // Dependências necessárias:
  use \App\Session\Login;

  // Dados do usuário logado:
  $usuarioLogado = Login::getUsuarioLogado();

  // Criando as informações do campo do usuário:
  $usuario = ($usuarioLogado) ? 
      '<div class="h4">'.$usuarioLogado['username'].'</div>'.'<a href="logout.php" class="text-decoration-none text-dark font-weight-bold">Sair</a>' : 
      '<div class="h4">Visitante</div>'.'<a href="login.php" class="text-decoration-none text-dark font-weight-bold">Entrar</a>';


?>

<!doctype html>
  <html lang="en">
    <head> 
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

      <!-- Breakpoints Implementation -->
      <link rel="stylesheet" href="./suporte/breakpoints.css">

      <!-- PAGE ICON -->
      <link rel="shortcut icon" href="https://img.icons8.com/plasticine/100/000000/find-matching-job.png">
      <!-- UNICONS -->
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

      <title>Vagas</title>
    </head>
    <body class="bg-dark text-light">

    <div class="container">
      <div class="jumbotron bg-danger text-center">
      <h1>Classificados Fatec</h1>
      <p>Gerencie suas ofertas de negócio.</p>

      <div>
        <i class="uil uil-user-circle text-dark h2"></i>
        <?=$usuario?>
      </div>
    </div>
