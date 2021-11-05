<?php

    // Página responsável por reenviar a senha para o usuário.

    // Utilizando o composer:
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Email\EmailSender;

    $mensagem = "";
    if ( isset( $_POST['email'] ) )
    {
        // Verificando se o email inserido realmente está vinculado a um usuário:
        $objUsuario = Usuario::getUsuarioPorEmail( $_POST['email'] );
        if ( !$objUsuario instanceof Usuario )
        {
            $mensagem = '<div class="alert alert-danger" role="alert">
                            Atenção! E-mail não pertence a nenhum usuário cadastrado.
                        </div>';
        }
        else
        {
            // Criando uma instância da nossa classe que envia os emails:
            $mail = new EmailSender();

            // Coletando os dados necessários para enviar o email:
            $address = $_POST['email'];
            $subject = "Redefinir Senha";
            $body = EmailSender::getBaseBody( $objUsuario->username );
            $altBody = EmailSender::getBaseAltBody();

            // Tentando enviar o email:
            if ( $mail->sendEmail( $address, $subject, $body, $altBody ) )
            {
                $mensagem = '<div class="alert alert-primary" role="alert">
                                Sucesso! Verifique seu e-mail.
                            </div>';
            }
            else
            {
                $mensagem = '<div class="alert alert-danger" role="alert">
                                Erro ao enviar e-mail, entre em contato com um administrador.
                            </div>';
            }
        }
    }
    
    include __DIR__.'/includes/loginPage/header.php';
    include __DIR__.'/includes/loginPage/formulario-recuperar-senha.php';
    include __DIR__.'/includes/loginPage/footer.php';

?>