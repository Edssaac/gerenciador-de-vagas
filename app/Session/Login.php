<?php

    /*
        CLASSE RESPONSÁVEL POR REALIZAR AS INTERAÇÕES DE CADASTRO E LOGIN
        DOS USUÁRIOS.
    */

    namespace App\Session;

    class Login
    {
        // Método responsável por iniciar a sessão:
        public static function init()
        {
            // Verifica o status atual da sessão:
            if ( session_status() !== PHP_SESSION_ACTIVE )
            {
                // Inicia a sessão:
                session_start();
            }
        }

        // Método responsável por retornar as informações do usuário logado:
        public static function getUsuarioLogado()
        {
            // Iniciando a sessão:
            self::init();

            // Retorna os dados do usuário se ele estiver logado:
            return (self::isLogged()) ? $_SESSION['usuario'] : NULL;
        }

        // Método responsável por realizar o login do Usuário:
        public static function login( $objUsuario )
        {
            // Inicia a sessão se já não estiver ativa:
            self::init();

            // Desalocando a referência ao email de reenvio se existir:
            if ( isset( $_SESSION['email'] ) )
                unset( $_SESSION['email'] );

            // Sessão do usuário:
            $_SESSION['usuario'] = 
            [
                'id' => $objUsuario->id,
                'nome' => $objUsuario->nome,
                'username' => $objUsuario->username,
                'email' => $objUsuario->email
            ];

            // Redirecionando para a página inicial:
            header('location: index.php');
            exit;
        }

        // Método responsável por salvar na SESSIOn o e-mail a qual foi pedido a troca de senha:
        public static function persistEmail($email)
        {
            // Iniciando a SESSION:
            self::init();

            // Persistindo o email:
            $_SESSION['email'] = $email;
        }

        // Método responsável por deslogar o usuário:
        public static function logout()
        {
            // Inicia a sessão:
            self::init();

            // Desalogando o usuário da sessão;
            unset( $_SESSION['usuario'] ); 

            // Redirecionando o usuário para a tela de login:
            header('location: login.php');
            exit;
        }

        // Método responsável por verificar se o usuário está logado:
        public static function isLogged() 
        {
            // Inicia a sessão:
            self::init();

            // Validando a sessão:
            return isset( $_SESSION['usuario']['id'] );
        }

        // Método responsável por obrigar o usuário estar logado para poder acessar a página:
        public static function requireLogin()
        {
            if ( !self::isLogged() )
            {
                header("location: login.php");
                exit;
            }
        }

        // Método responsável por obrigar o usuário estar deslogado para poder acessar a página:
        public static function requireLogout()
        {
            if ( self::isLogged() )
            {
                header("location: index.php");
                exit;
            }
        }

    }

?>