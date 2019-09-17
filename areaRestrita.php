  <?php
  session_start();
  ob_start();

  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Habil - Área Restrita</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </script>
  </head>
  <style type="text/css">
    .port{
      background-color: rgba(0,0,0,0.7);
      padding: 10px;
      margin-left: 0!important;
      border:0!important;

    }

    tr{
      background-color: white!important;
    }
    body{
       background-image: url('img/background4.jpg');
       background-size: 100% auto;
       text-align: center;
       padding: 0!important;

    }
    h2{
      color: white!important;
    }
    .container-fluid{
      margin:0!important;
      border: 0!important;
padding: 0!important;
    }
    

  </style>
  <body >
    <div class="container-fluid">
      <div class="row">
      <div class="col-md-5"></div>
        <div class="col-md-2">
          <img src="img/logo2.png" width="150" height="150">
        </div>
        
      </div>
      <?php

      
      if(isset($_SESSION['privateUser'])){

        $u = unserialize($_SESSION['privateUser']);
        include_once 'modelo/parceiro.class.php';
        include_once 'modelo/portfolio.class.php';
        include_once 'DAL/informacoesDAL.class.php';
        $funDAO = new InformacoesDAL();
        $por = new Portfolio();
        $par = new Parceiro();
        $array = $funDAO->buscarPortfolio();


        if(isset($_GET['idPort'])){
          $funDAO->deletarPortfolio($_GET['idPort']);
          header("location:areaRestrita.php");
        }else 
          if(isset($_GET['idPortAlterar'])){

            $query = "where CD_PORTFOLIO = ".$_GET['idPortAlterar'];
            $array22 = $funDAO->filtrarPortfolio($query);
            
         }


        if(isset($_GET['idParc'])){
          $funDAO->deletarParceiro($_GET['idParc']);
          header("location:areaRestrita.php");
        }else 
          if(isset($_GET['idParcAlterar'])){
            $query = "where CD_PARCEIRO = ".$_GET['idParcAlterar'];
            $array11 = $funDAO->filtrarParceiros($query);
            
        }


        ?>
      
        <div class="port" >
          <form name="portfolio" action="" method="post" enctype="multipart/form-data">
            <h2 id="tituloLogin" style="color:white!important">Portfólio</h2>
            <form name="login" action="" method="post">
            <div class="form-group form-inline">

              <input id="titulo" type="text" class="form-control " name="titulo" placeholder="Titulo" value="<?php
                            if(isset($array22)){
                              echo $array22[0]->TITULO;
                            }
                            ?>" required>

              <input id="descricao" type="text" class="form-control " name="descricao" placeholder="Descrição" value="<?php
                            if(isset($array22)){
                              echo $array22[0]->DESCRICAO;
                            }
                            ?>" required>
              <input type="file" name="imagem" class="form-control " required value="<?php
                            if(isset($array22)){
                              echo $array22[0]->URL_IMG;
                            }
                            ?>">    
              <input type="submit" name="cadastrarPort" value="Inserir"
                     class="btn btn-primary">
                

            </div>

          </form> 
            <?php
          if(isset($_GET['idPortAlterar'])){
            $aviso2 = $_GET['idPortAlterar'];
          }else{
            $aviso2 = 0;
          }
          

          if(isset($_POST['cadastrarPort'])){


              $titulo = $_POST['titulo'];
              $descricao = $_POST['descricao'];
              
              if ( isset( $_FILES[ 'imagem' ][ 'name' ] )) {
             
                $arquivo_tmp = $_FILES[ 'imagem' ][ 'tmp_name' ];
                $nome = $_FILES[ 'imagem' ][ 'name' ];
             
                // Pega a extensão
                $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
             
                // Converte a extensão para minúsculo
                $extensao = strtolower ( $extensao );

                if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
                    // Cria um nome único para esta imagem
                    // Evita que duplique as imagens no servidor.
                    // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                    $novoNome = uniqid ( time () ) . '.' . $extensao;
             
                    // Concatena a pasta com o nome
                    $destino = 'img / ' . $novoNome;
             
                    // tenta mover o arquivo para o destino
                    if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {


                        $port->titulo = $titulo;
                        $port->descricao = $descricao;
                        $port->imagem = $destino;

                        if($aviso2 ==0){
                          $funDAO->cadastrarPortfolio($port);
                          echo "<h2>Portfolio cadastrado com sucesso!!!</h2>";
                          header("location:areaRestrita.php");
                          
                        }
                        else
                        {
                          $port->idPortfolio = $aviso2;
                          $funDAO->alterarPortfolio($port);
                          echo "<h2>Portfolio alterado com sucesso!!!</h2>";
                          header("location:areaRestrita.php");
                        }
                        
                        
                    }
                    else
                        echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
                }
                else
                    echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
            }
            else
                echo 'Você não enviou nenhum arquivo!';

                  

          }
          
          if(count($array) != 0){
            

          ?>

          <div class="table-responsive">
            <table class="table table-striped table-bordered bg-link table-hover table-condensed">
              <thead>
                <tr class="" id="table">
                  <th colspan="2">Portfólio</th>
                  <th>Código</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>URL</th>

                </tr>
              </thead>

              <tfoot>
                <tr class="">
                  <th colspan="2">Portfólio</th>
                  <th>Código</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>URL</th>

                </tr>
              </tfoot>

              <tbody>

                <?php

                 
                foreach($array as $a){

                  echo "<tr class='active'>";


                    echo "<td><a href='areaRestrita.php?idPortAlterar=$a->CD_PORTFOLIO'><img src='img/alterar.png'  ></td>";
                    echo "<td><a href='areaRestrita.php?idPort=$a->CD_PORTFOLIO'><img src='img/delete.png'  ></td>";
                    echo "<td>$a->CD_PORTFOLIO</td>";
                    echo "<td>$a->TITULO</td>";
                    echo "<td>$a->DESCRICAO</td>";
                    echo "<td>$a->URL_IMG</td>";


                    echo "</tr>";

                  }
                }else{
                  echo "<h2>Não há Portfólio no banco de dados!</h2>";
                }
                ?>
              </tbody>
            </table>    
            </div>
            </form>
          </div>
          
          <div class="port" style="margin-top: 10px">
          <form name="parceiro" action="" method="post" enctype="multipart/form-data">
            <h2 id="tituloLogin" style="color:white">Parceiros</h2>
            <form name="login" action="" method="post" >
            <div class="form-group form-inline">

              <input id="titulo2" type="text" class="form-control input" name="titulo2" placeholder="Titulo" value="<?php
                          if(isset($array11)){
                            echo $array11[0]->TITULO;
                          }
                          ?>" required>

              <input id="descricao2" type="text" class="form-control input" name="descricao2" placeholder="Descrição" value="<?php
                          if(isset($array11)){
                            echo $array11[0]->DESCRICAO;
                          }
                          ?>" required>
              <input type="file" name="arquivo" class="form-control input" required> 
              <input type="submit" name="cadastrarParc" value="Inserir"
                     class="btn btn-primary">
            </div>
          </form> 
          <?php
            if(isset($_GET['idParcAlterar'])){
              $aviso = $_GET['idParcAlterar'];
            }else{
              $aviso = 0;
            }


          if(isset($_POST['cadastrarParc'])){


            $titulo = $_POST['titulo2'];
            $descricao = $_POST['descricao2'];
            
            if ( isset( $_FILES[ 'arquivo' ][ 'name' ] )) {
           
              $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
              $nome = $_FILES[ 'arquivo' ][ 'name' ];
           
              // Pega a extensão
              $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
           
              // Converte a extensão para minúsculo
              $extensao = strtolower ( $extensao );

              if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
                  // Cria um nome único para esta imagem
                  // Evita que duplique as imagens no servidor.
                  // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                  $novoNome = uniqid ( time () ) . '.' . $extensao;
           
                  // Concatena a pasta com o nome
                  $destino = 'img / ' . $novoNome;
           
                  // tenta mover o arquivo para o destino
                  if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {

                      $par->titulo = $titulo;
                      $par->descricao = $descricao;
                      $par->imagem = $destino;

                      if($aviso!=0){
                        $par->idParceiro = $aviso;
                        $funDAO->alterarParceiro($par);
                        echo "<h2>Parceiro Alterado com sucesso!!!</h2>";
                        header("location:areaRestrita.php");
                        
                      }else{
                        $funDAO->cadastrarParceiro($par);
                        echo "<h2>Parceiro cadastrado com sucesso!!!</h2>";
                        header("location:areaRestrita.php");
                       } 
                      
                      
                      
                  }
                  else
                      echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
              }
              else
                  echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
          }
          else
              echo 'Você não enviou nenhum arquivo!';

                

        }
          $array = $funDAO->buscarParceiro();
          if(count($array) != 0){


          ?>
          

          <div class="table-responsive">
            <table class="table table-striped table-bordered bg-link table-hover table-condensed">
              <thead>
                <tr class="" id="table">
                  <th colspan="2">Parceiro</th>
                  <th>Código</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>URL</th>

                </tr>
              </thead>

              <tfoot>
                <tr class="">
                  <th colspan="2">Parceiro</th>
                  <th>Código</th>
                  <th>Titulo</th>
                  <th>Descricao</th>
                  <th>URL</th>

                </tr>
              </tfoot>

              <tbody>

                <?php

                 
                foreach($array as $a){

                  echo "<tr class='active'>";


                    echo "<td><a href='areaRestrita.php?idParcAlterar=$a->CD_PARCEIRO'><img src='img/alterar.png'  ></td>";
                    echo "<td><a href='areaRestrita.php?idParc=$a->CD_PARCEIRO'><img src='img/delete.png'  ></td>";
                    echo "<td>$a->CD_PARCEIRO</td>";
                    echo "<td>$a->TITULO</td>";
                    echo "<td>$a->DESCRICAO</td>";
                    echo "<td>$a->URL_IMG</td>";


                    echo "</tr>";

                  }
                }else{
                  echo "<h2>Não há Parceiros no banco de dados!</h2>";
                }
                ?>
              </tbody>
            </table>    
          </div>
          </div>

        

      
        <?php
        if(isset($_POST['deslogar'])){
          unset($_SESSION['privateUser']);
          header("location:login.php");
        }
        } else {
        ?>
        <!-- INICIO LOGIN -->
        <section class="" style="padding: 0!important">

          <h2  style="color: white!important">Login!</h2>
          <form name="" action="" method="post">
            <div class="form-group form-inline">
              <span class="form-control input"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email" type="text" class="form-control input" name="login" placeholder="Login">
            </div>
            <div class="form-group form-inline ">
              <span class="form-control input"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control input" name="senha" placeholder="Senha">
            </div>
            <div class="form-group form-inline">
              <input type="submit" name="entrar" value="Entrar"
                     class="btn btn-primary">
            </div>

          </form>

        <?php
        }//fecha

        if(isset($_POST['entrar'])){


          if($_POST['login'] == "##" && $_POST['senha'] == "###"){
            //Significa que login tá certo!


            $_SESSION['privateUser'] = serialize($_POST['login']);
            header("location:areaRestrita.php");
          }else{
            echo "Login/Senha incorreto(s)... Tente novamente!";

            
          }

          unset($_POST['entrar']);
        }//fecha if
        ?>

        </section>
      </div>
    </div>
  </body>
</html>
