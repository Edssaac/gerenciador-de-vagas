<?php

    /* CLASSE RESPONSÁVEL POR GERAR O OBJETO COM OS CAMPOS NECESSÁRIOS 
       PARA ARMAZENAR AS INFORMAÇÕES DE CADASTRO DA VAGA 
    */

    namespace App\Entity;
    use \App\Db\Database;
    use \PDO;

    class Vaga
    {
        // (int) Identificador índice da vaga:
        public $id;

        // (string) Título da vaga:
        public $titulo;

        // (string) Descrição da vaga:
        public $descricao;

        // (char) Registro de que a vaga está ativa ou não (s/n):
        public $ativo;

        // (string) Data de registro de quando a vaga foi cadastrada:
        public $data;

        // Método responsável por cadastrar uma nova vaga no banco de dados:
        public function cadastrar()
        {
            // DEFINIR A DATA:
            $this->data = date( "Y-m-d H:i:s" );
            
            // INSERIR A VAGA NO BANCO:
            // ATRIBUIR O ID DA VAGA NA INSTÂNCIA:
            $objDataBase = new Database( 'vagas' );
            $this->id = $objDataBase->insert([
                'titulo' => $this->titulo,
                'descricao' => $this->descricao,
                'ativo' => $this->ativo,
                'data' => $this->data
            ]);

            // RETORNANDO SUCESSO:
            return true;
        }

        // Método responsável por atualizar as informações cadastradas:
        public function atualizar()
        {
            // ATUALIZA A DATA:
            $this->data = date( "Y-m-d H:i:s" );

            return (new Database('vagas'))->update( 'id = '.$this->id, [
                                                            'titulo' => $this->titulo,
                                                            'descricao' => $this->descricao,
                                                            'ativo' => $this->ativo,
                                                            'data' => $this->data
                                                        ] );
        }

        // Método responsável por excluir uma vaga no banco de dados:
        public function excluir()
        {
            return (new Database('vagas'))->delete( 'id = '.$this->id );
        }

        // Método responsável por retornar os dados de todas as vagas cadastradas:
        public static function getVagas( $where=null, $order=null, $limit=null )
        {
            return (new Database('vagas'))->select( $where, $order, $limit )
                                          ->fetchAll( PDO::FETCH_CLASS, self::class ); /* RETORNANDO OS DADOS ENCONTRADOS COMO UM ARRAY */
        }

        // Método responsável por retornar a quantidade de vagas cadastradas:
        public static function getQuantidadeVagas( $where=null )
        {
            return (new Database('vagas'))->select( $where, null, null, 'COUNT(*) as quantidade' )
                                          ->fetchObject()->quantidade; /* RETORNANDO A QUANTIDADE DE DADOS ENCONTRADOS */ 
        }

        // Método responsável por buscar uma vaga com base em seu ID:
        public static function getVaga($id)
        {
            return (new Database('vagas'))->select( 'id = '.$id )
                                          ->FetchObject( self::class );
        }

        // Método responsável por limpar todos os registros da tabela e reiniciar o auto-increment do id:
        public static function clsDB()
        {
            return (new Database('vagas'))->truncate();
        }

    }

?>