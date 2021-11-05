<?php

    // Página responsável por redefinir a senha do usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Session\Login;

    // Permitindo apenas usuarios deslogados:
    Login::requireLogout();

    
    // Verificando se o token está correto:
    $ativo = false;
    $mensagem = '';
    if ( isset($_GET['token'], $_SESSION['email']) ) 
    {
        $objUsuario = Usuario::getUsuarioPorEmail( $_SESSION['email'] );
        $token = $_GET['token'];

        if ( $token == $objUsuario->token )
        {
            $ativo = true;
        }
    }
 
    // Verificando se o usuário já passou o pedido de nova senha (caso o token estiver certo):
    if ( isset( $_POST['password'], $_POST['confirm_password'] ) )
    {
        // Validando a senha inserida pelo usuário:
        if ( $_POST['password'] != $_POST['confirm_password'] )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! Confirme sua senha corretamente.
                        </div>';
        }
        else
        {
            // Atualizando a senha do usuário:
            $objUsuario->senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Transformando a senha do usuário em uma hash;
            $objUsuario->atualizar();
            
            // Realizando o login após atualização:
            Login::login($objUsuario);
        }


    }
    
    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/redefinir.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>