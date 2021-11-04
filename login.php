<?php

    // Página inicial da aplicação e responsável pelo login do usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Session\Login;
    use \App\Entity\Usuario;

    // OBRIGA O USUÁRIO A NÃO ESTAR LOGADO:
    Login::requireLogout();

    $mensagem = "";

    // Validando os dados de login:
    if ( isset($_POST['email'], $_POST['password']) )
    {
        // Pesquisando um usuário que use o email passado:
        $objUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
        
        // Verificando se o usuário existe na base de dados:
        if ( !$objUsuario instanceof Usuario || !password_verify($_POST['password'], $objUsuario->senha) )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! Dados incorretos.
                        </div>';
        }
    }


    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-login.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>