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
        // Pesquisando se já existe um usuário que use o email passado:
        $objUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
        if ( $objUsuario instanceof Usuario )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! E-mail indisponível.
                        </div>';
        }
        // Validando a senha inserida pelo usuário:
        else if ( $_POST['password'] != $_POST['confirm_password'] )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! Confirme sua senha corretamente.
                        </div>';
        }
        // Coletando as informações validadas e cadastrando o novo usuário:
        else
        {
            // Criando uma instância da classe Usuário e passando os valores:
            $objUsuario = new Usuario();
            $objUsuario->nome = $_POST['name'];
            $objUsuario->email = $_POST['email'];
            $objUsuario->username = $_POST['username'];
            $objUsuario->senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Transformando a senha do usuário em uma hash;
            
            // Cadastrando o novo usuário:
            $objUsuario->cadastrar();

            // Realizando o login após ser cadastrado:
            Login::login($objUsuario);
        }
    }
    

    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-cadastro.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>