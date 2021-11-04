<?php

    // Página responsável por realizar o cadastro de novos usuários.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Session\Login;
    use \App\Entity\Usuario;

    // OBRIGA O USUÁRIO A NÃO ESTAR LOGADO:
    Login::requireLogout();

    $mensagem = "";
    
    // Validando os campos obrigatórios:
    if ( isset($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirm_password']) )
    {
        // Validando a senha inserida pelo usuário:
        if ( $_POST['password'] == $_POST['confirm_password'] )
        {
            // Criando uma instância da classe Usuário e passando os valores:
            $objUsuario = new Usuario();
            $objUsuario->nome = $_POST['name'];
            $objUsuario->email = $_POST['email'];
            $objUsuario->username = $_POST['username'];
            $objUsuario->senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Transformando a senha do usuário em uma hash;

            // Cadastrando o novo usuário:
            $objUsuario->cadastrar();
        }
        else
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! Confirme sua senha corretamente.
                        </div>';
        }
    }
    

    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-cadastro.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>