<?php
/*
    Criação da classe Jogo com o CRUD
*/
class JogoDAO{
    
    public function create(Jogo $jogo) {
        try {
            $sql = "INSERT INTO bibliotecajogo (                   
                  titulo,genero,lancamento,descricao)
                  VALUES (
                  :titulo,:genero,:lancamento,:descricao)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":titulo", $jogo->getTitulo());
            $p_sql->bindValue(":genero", $jogo->getGenero());
            $p_sql->bindValue(":lancamento", $jogo->getLancamento());
            $p_sql->bindValue(":descricao", $jogo->getDescricao());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir jogo <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM bibliotecajogo order by titulo asc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaJogos($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar jogos." . $e;
        }
    }
     
    public function update(Jogo $jogo) {
        try {
            $sql = "UPDATE bibliotecajogo set
                
                  titulo=:titulo,
                  genero=:genero,
                  lancamento=:lancamento,
                  descricao=:descricao                  
                                                                       
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":titulo", $jogo->getTitulo());
            $p_sql->bindValue(":genero", $jogo->getGenero());
            $p_sql->bindValue(":lancamento", $jogo->getLancamento());
            $p_sql->bindValue(":descricao", $jogo->getDescricao());
            $p_sql->bindValue(":id", $jogo->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Jogo $jogo) {
        try {
            $sql = "DELETE FROM bibliotecajogo WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $jogo->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir jogo<br> $e <br>";
        }
    }


    

    private function listaJogos($row) {
        $jogo = new Jogo();
        $jogo->setId($row['id']);
        $jogo->setTitulo($row['titulo']);
        $jogo->setGenero($row['genero']);
        $jogo->setLancamento($row['lancamento']);
        $jogo->setDescricao($row['descricao']);

        return $jogo;
    }
 }

 ?>