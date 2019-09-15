<?php
class Portfolio{
  private $idPortfolio;
  private $titulo;
  private $descricao;
  private $imagem;


  public function __construct(){}
  public function __destruct(){}
  public function __get($a){
    return $this->$a;

  }
  public function __set($a,$v){
    $this->$a = $v;
  }
  public function __toString(){
    return nl2br("<p>ID Portfolio: $this->idPortfolio
                 Titulo: $this->titulo
                 Descricao: $this->descricao
                 Imagem: $this->imagem
                  </p>");
  }

}
