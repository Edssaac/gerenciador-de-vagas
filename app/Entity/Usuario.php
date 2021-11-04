<?php

    /*
        CLASSE RESPONSÁVEL POR INTERAGIR COM OS DADOS DO USUÁRIO.
    */

    namespace App\Entity;

    // Dependências necessárias:
    use \App\Db\Database;
    use \PDO;


    class Usuario
    {
        // Variável responsável por armazenar o ID do usuário:
        public $id;

        // Variável responsável por armazenar o NOME do usuário:    
        public $nome;

        // Variável responsável por armazenar o EMAIL do usuário:
        public $email;

        // Variável responsável por armazenar o NOME DE USUARIO do usuário:
        public $username;

        // Variável responsável por armazenar a HASH da SENHA do usuário:
        public $senha;


        // Método responsável por cadastrar um novo usuário no banco de dados:
        public function cadastrar()
        {
            // Instânciando o banco de dados:
            $objDatabase = new Database('usuarios');

            // Inserindo um novo usuário:
            $this->id = $objDatabase->insert([
                                              "nome"  => $this->nome,
                                              "email" => $this->email,
                                              "username" => $this->username,
                                              "senha" => $this->senha  
                                            ]);

            // Retornando sucesso:
            return true;
        }


        // Método responsável por retornar uma instância de usuário com base no email recebido:
        public static function getUsuarioPorEmail($email)
        {
            return (new Database('usuarios'))->select('email = "'.$email.'"')->FetchObject(self::class);
        }




    }

?>