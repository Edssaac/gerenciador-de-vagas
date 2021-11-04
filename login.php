<?php

    // Página inicial da aplicação e responsável pelo login do usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    
    $mensagem = "";


    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-login.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>