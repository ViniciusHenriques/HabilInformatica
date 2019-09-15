<?php
require 'conexaobanco.class.php';
  class InformacoesDAL{
    private $conexao = null;
    public function __construct(){
      $this->conexao = ConexaoBanco::getInstance();
    }
    public function __destruct(){}

    public function cadastrarParceiro($fun){
      try{
        $stat = $this->conexao->prepare("insert into PARCEIRO(CD_PARCEIRO,TITULO,DESCRICAO,URL_IMG)values(null,?,?,?)");

        $stat->bindValue(1,$fun->titulo);
        $stat->bindValue(2,$fun->descricao);
        $stat->bindValue(3,$fun->imagem);

        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao cadastrar! ".$e;
      }

    }

    public function buscarParceiro(){
      try {
        $stat = $this->conexao->query("select * from PARCEIRO");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'parceiro');
        return $array;//NÃO ESQUECER
      }catch(PDOException $pe){
        echo "erro ao buscar Parceiros!".$pe;
      }
    }//fecha método



    public function deletarParceiro($id){
      try {
        $stat = $this->conexao->prepare(
          "delete from PARCEIRO where CD_PARCEIRO = ?");
        $stat->bindValue(1, $id);
        $stat->execute();
      } catch(PDOException $e) {
        echo "Erro ao excluir PARCEIRO! ".$e;
      }
    }//fecha deletarLivro
    public function alterarParceiro($fun){
      try{
        $stat=$this->conexao->prepare("update PARCEIRO set TITULO=?,DESCRICAO=?,URL_IMG=? where CD_PARCEIRO=?");
        $stat->bindValue(1,$fun->titulo);
        $stat->bindValue(2,$fun->descricao);
        $stat->bindValue(3,$fun->imagem);
        $stat->bindValue(4,$fun->idParceiro);

        $stat->execute();
      }catch(PDOException $e){
        echo "erro ao alterar parceiro!".$e;
      }//fechacatch
    }//fecha
    public function cadastrarPortfolio($fun){
      try{
        $stat = $this->conexao->prepare("insert into PORTFOLIO(CD_PORTFOLIO,TITULO,DESCRICAO,URL_IMG)values(null,?,?,?)");

        $stat->bindValue(1,$fun->titulo);
        $stat->bindValue(2,$fun->descricao);
        $stat->bindValue(3,$fun->imagem);

        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao cadastrar! ".$e;
      }

    }

    public function buscarPortfolio(){
      try {
        $stat = $this->conexao->query("select * from PORTFOLIO");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'portfolio');
        return $array;//NÃO ESQUECER
      }catch(PDOException $pe){
        echo "erro ao buscar !".$pe;
      }
    }//fecha método



    public function deletarPortfolio($id){
      try {
        $stat = $this->conexao->prepare(
          "delete from PORTFOLIO where CD_PORTFOLIO = ?");
        $stat->bindValue(1, $id);
        $stat->execute();
      } catch(PDOException $e) {
        echo "Erro ao excluir ! ".$e;
      }
    }//fecha deletarLivro
    public function alterarPortfolio($fun){
      try{
        $stat=$this->conexao->prepare("update PORTFOLIO set TITULO=?,DESCRICAO=?,URL_IMG=? where CD_PORTFOLIO=?");
        $stat->bindValue(1,$fun->titulo);
        $stat->bindValue(2,$fun->descricao);
        $stat->bindValue(3,$fun->imagem);
        $stat->bindValue(4,$fun->idPortfolio);

        $stat->execute();
      }catch(PDOException $e){
        echo "erro ao alterar !".$e;
      }//fechacatch
    }//fecha
    public function filtrarPortfolio($query){
      try{
        $stat=$this->conexao->query("select * from PORTFOLIO ".$query);
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Portfolio');
        return $array;
      }catch(PDOException $e){
        echo "Erro ao filtrar! ".$e;
      }//fecha catch
    }//fecha filtrar
    public function filtrarParceiros($query){
      try{
        $stat=$this->conexao->query("select * from parceiro ".$query);
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Parceiro');
        return $array;
      }catch(PDOException $e){
        echo "Erro ao filtrar! ".$e;
      }//fecha catch
    }//fecha filtrar

  }
