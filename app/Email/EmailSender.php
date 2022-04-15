<?php

    /*
        CLASSE RESPONSÁVEL PELO ENVIO DE EMAILS PARA O USUÁRIO.
    */

    namespace App\Email;    

    // Para podermos usar o PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class EmailSender
    {
        // Dados necessários para conectar com o gmail:
        const HOST = 'smtp.gmail.com';
        const USER = 'classificadosfatec@gmail.com';
        const PASS = 'e-J:LF5p:VevGfz';
        const SECURE = 'TLS';
        const PORT = '587';
        const CHARSET = 'UTF-8';

        // Dados do remetente:
        const FROM_EMAIL = 'classificadosfatec@gmail.com';
        const FROM_NAME = 'Classificados Fatec';

        // Responsável por armazenar a mensagem de erro caso exista:
        private $error;


        // Método responsável por retornar um erro obtido ao tentar enviar o e-mail:
        public function getError()
        {
            return $this->error;
        }


        // Método responsável por enviar o e-mail:
        public function sendEmail( $addresses, $subject, $body, $altBody="", $attachments=[], $ccs=[], $bccs=[] )
        {
            // Limpando a mensagem de erro:
            $this->error = '';
            
            // Intânciando a class PHPMailer:
            $mail = new PHPMailer(true);

            if ( empty($altBody) )
                $altBody = "Erro ao carregar HTML!";

            try 
            {
                // Credencias de acesso ao SMTP:
                $mail->isSMTP();
                $mail->Host = self::HOST;
                $mail->SMTPAuth = true;
                $mail->Username = self::USER;
                $mail->Password = self::PASS;
                $mail->SMTPSecure = self::SECURE;
                $mail->Port = self::PORT;
                $mail->Charset = self::CHARSET;


                // Remetente:
                $mail->setFrom( self::FROM_EMAIL, self::FROM_NAME );


                // Destinatários:
                $addresses = is_array($addresses) ? $addresses : [$addresses];
                foreach ( $addresses as $address )
                {
                    $mail->addAddress($address);
                }

                // Anexos:
                $attachments = is_array($attachments) ? $attachments : [$attachments];
                foreach ( $attachments as $attachment )
                {
                    $mail->addAttachment($attachment);
                }

                // Cópias:
                $ccs = is_array($ccs) ? $ccs : [$ccs];
                foreach ( $ccs as $cc )
                {
                    $mail->addCC($cc);
                }

                // Cópias Ocultas:
                $bccs = is_array($bccs) ? $bccs : [$bccs];
                foreach ( $bccs as $bcc )
                {
                    $mail->addBCC($bcc);
                }


                // Conteúdo do e-mail:
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AltBody = $altBody;
                $mail->addReplyTo(self::USER, 'Suporte');

                
                // Enviando o e-mail:
                return $mail->send();

            } catch (Exception $e) 
            {
                $this->error = $e->getMessage();
                var_dump($this->error = $e->getMessage());
                return false;
            }
        }

        // Método responsável por retornar a base do corpo do email:
        public static function getBaseBody($objUsuario)
        {
            $body = 
            '            
            <div style="border-radius: 5px; box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22); padding: 30px; margin: 20px; width: 400px; border-left: 3px solid #3bb54a;">
                <p> Olá <b>'.$objUsuario->username.'</b>, tudo bem?<br>Nós da equipe <b>Classificados Fatec</b> desejamos que sim!</p>

                <p>
                    Recebemos uma solicitação para que sua senha seja redefinida. <br>
                    Clique no botão abaixo para que possa continuar com essa operação:
                    <br><br>
                    <button type="button" style="border:none; border-radius:8px; background-color: #4CAF50; padding: 15px 32px; text-align:center; text-decoration:none; display:inline-block; font-size:16px; margin: 4px 2px; cursor:pointer;">
                        <a href="https://classfatec.herokuapp.com/redefinir.php?token='.$objUsuario->token.'" style="text-decoration:none; color:black;">Recuperar Senha</a>
                    </button>
                    <br><br>
                    Por favor ignore este e-mail caso não o tenha solicitado.
                    <br><br>
                    Atenciosamente, <b>Classificados Fatec</b>.
                </p>
            </div>';

            return $body;
        }

        // Método responsável por retornar a base do corpo alternativo do email:
        public static function getBaseAltBody()
        {
            return "Para conseguir acessar esse e-mail corretamente, use um visualizador de e-mail com suporte a HTML.";
        }

    }
?>