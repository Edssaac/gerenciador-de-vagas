<?php

    // Página responsável por reenviar a senha para o usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;

    $mensagem = "";
    if ( isset( $_POST['email'] ) )
    {
        $objUsuario = Usuario::getUsuarioPorEmail( $_POST['email'] );
        if ( !$objUsuario instanceof Usuario )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! E-mail não pertence a nenhum usuário cadastrado.
                        </div>';
        }
        else
        {
            $mensagem = '<div class="alert alert-primary" role="alert">
                            Sucesso! Verifique seu e-mail.
                        </div>';
        }
    }
    
    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-recuperar-senha.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>