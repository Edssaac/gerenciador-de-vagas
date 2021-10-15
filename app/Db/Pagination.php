<?php

    namespace App\Db;

    class Pagination
    {
        // Máximo de registros por página:
        private $limit;

        // Quantidade total de resultados do banco:
        private $results;

        // Quantidade de páginas:
        private $pages;

        // Recebe a página atual:
        private $currentPage;


        // Construtor da clase:
        public function __construct($results, $currentPage=1, $limit=10)
        {
            $this->results = $results;
            $this->limit = $limit;
            $this->currentPage = ( is_numeric($currentPage) && $currentPage>0 ) ? $currentPage : 1;
            $this->calculate();
        }

        // Método responsável por calcular a páginação:
        private function calculate()
        {
            // Calcula o total de páginas:
            $this->pages = ( $this->results>0 ) ? ceil($this->results/$this->limit) : 1;

            // Verifica se a página atual não excede o número de páginas:
            $this->currentPage = ( $this->currentPage <= $this->pages ) ? $this->currentPage : $this->pages;
        }

        // Método responsável por retornar o limite de vagas por página:
        public function getLimit()
        {
            $offset = ($this->limit * ($this->currentPage-1));
            return $offset.', '.$this->limit;
        }

        // Método responsável por retornar as opções de páginas disponíveis;
        public function getPages()
        {
            // Se existir apenas uma página:
            if ( $this->pages == 1 ) return [];

            // Conjunto de páginas:
            $paginas = [];

            for ( $i=1; $i<=$this->pages; $i++ )
            {
                $paginas[] = [
                    'pagina' => $i,
                    'atual'  => $i==$this->currentPage 
                ];
            }

            return $paginas;
        }

    }

?>