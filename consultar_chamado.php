<?php require_once("validador_acesso.php"); 

print_r($_SESSION);

//chamados
$chamados = array();

//Abrir o arquivo com os dados dos chamados
$arquivo = fopen('arquivo.hd', 'r');

//Percorrer o arquivo enquanto tiver linhas
while(!feof($arquivo)){//feod indentifica o fim do arquivo

  $registro = fgets($arquivo);

  //explode dos detalhes do registro para verificar o id do usuário responsável pelo cadastro
  $registro_detalhes = explode('#', $registro);

  //(perfil id = 2) só vamos exibir o chamado, se ele foi criado pelo usuário
  if($_SESSION['perfil_id'] == 2){

    //se usuário autenticado não for o usuário de abertura do chamado então não faz nada
    if($SESSION['id'] != $registro_detalhes[0]){
      continue; //não faz nada
    }else{
      $chamados[] = $registro;//adiciona o registro do arquivo ao array $chamados
    }

  }else{
    $chamados[] = $registro;//adiciona o registro do arquivo ao array $chamados
  }

}

fclose($arquivo);

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              
              <?php 
                foreach($chamados as $chamado){ 
              
              
                  $chamado_dados = explode('#', $chamado);

                  if(count($chamado_dados ) < 3){
                    continue;
                  }
                  $html = <<<HTML
                  <div class="card mb-3 bg-light">
                    <div class="card-body">
                      <h5 class="card-title"> $chamado_dados[1]</h5>
                      <h6 class="card-subtitle mb-2 text-muted"> $chamado_dados[2]</h6>
                      <p class="card-text"> $chamado_dados[3]</p>
                    </div>
                  </div>
HTML;

                  echo $html;
                } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php" class="btn btn-lg btn-warning btn-block">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>