<?php

    // Página responsável pelo logout do usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Session\Login;

    // OBRIGA O USUÁRIO A NÃO ESTAR LOGADO:
    Login::logout();

?>