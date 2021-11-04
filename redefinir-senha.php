<?php

    // Página responsável por reenviar a senha para o usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';


    $mensagem = "";


    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-recuperar-senha.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>