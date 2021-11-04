<?php

    /*
        CLASSE RESPONSÁVEL POR REALIZAR AS INTERAÇÕES DE CADASTRO E LOGIN
        DOS USUÁRIOS.
    */

    namespace App\Session;

    class Login
    {

        // Método responsável por verificar se o usuário está logado:
        public static function isLogged() 
        {
            return false;
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