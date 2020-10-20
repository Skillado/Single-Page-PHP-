<?php
  include_once '../models/conexao.php';
  if(isset($_POST['name']))
  {
    $name = $_POST['name'];
  }
  if(isset($_POST['password']))
  {
    $password = $_POST['password'];
  }
  if(isset($_POST['image']))
  {
    $image = $_FILES['image'];
    
  }
  $sql = $pdo -> query("SELECT * FROM usuarios");
  $data = $sql -> fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>mostra</title>

  <style>
    body{
    width:100%;
    height:100%;
    margin: 0;
    padding:0;
    }

    
    #buscar{
      display:grid;
      grid-template-columns: 1fr 1fr;
    }

    h1{
      color:#FFF;
    }

    .inputs{
      display:grid;
      grid-template-columns: repeat(4, 1fr);
    }

    select{
      width:100%;
    }
    
    .inputs input, select{
      border-radius: 20px;
      background:#fffcfc;
      height:40px;
      align-items: center;
      text-align: center;
    }

    .enviar{
      margin-top: 7%;
    }

    input[type=file]{
      border-radius: 0;
      width:290px;
      color: #ccc;
      background:transparent;
      border:1px solid #ccc;
      border-radius:20px;
      margin-top:7%;
    }

    article{
      width: 100%;
      height: 100vh;
    }
  </style>
</head>
<body> 
    <article id="home">
        <h1>SEJA BEM VINDO A SUA AVALIAÇÃO DE HTML/CSS/PHP!</h1>
    </article>

      <article id="create">
        <form action="mostra.php#criar" method="post" action="mostra.php#criar" enctype="multipart/form-data">
          <div class="inputs">
            <label for="name">Digite seu nome:
              <input name="name" type="text" value="gui">
            </label>
            <label for="password">Digite sua senha:
              <input name="password" type="password" value="***">
            </label>
            <input type="hidden" name="tipo" value="1">
            <input type="file" name="image" >
            <input type="submit" class="enviar" value=" enviar ">
          </div>
          
        </form>
      </article>

      <article id="atualizar">
        <form class="form-group" method="POST" id="update" action="mostra.php#atualizar_elementos" target="mostra_update" enctype="multipart/form-data">		
          <select name="atualizar" class="input" onchange="document.getElementById('update').submit()"target="mostra_update"   >
            <option value="0" selected > Selecione...</option> 
            <?php foreach ($data as $users):?>
              <option value="<?=$users['idusuarios']?>"><?=$users['nome']?></option>;	
            <?php endforeach;?>
          </select>
        </form>
        <iframe style="width: 500px;" name="mostra_update" src="" scrolling="no" frameborder="0"></iframe>
      </article>

     

      <article id="buscar">
      <form class="form-group" method="POST" id="selecao" action="mostra.php#pesquisa" target="mostraimage" enctype="multipart/form-data">		
        <select name="buscador" class="input" onchange="document.getElementById('selecao').submit()" target="mostraimage" >
          <option value="0" selected > Selecione...</option> 
           <?php foreach ($data as $users):?>
             <option value="<?=$users['idusuarios']?>"><?=$users['nome']?></option>';
          ?>	
          <?php endforeach;?>
        </select>
      </form>
      <iframe name="mostraimage" src=""  scrolling="no" frameborder="0"></iframe>
      </article>
      
</body>
</html>