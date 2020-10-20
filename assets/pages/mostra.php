<?php
include_once '../models/conexao.php';
if(isset($_POST['buscador']))
{
  $id = $_POST['buscador'];
  $sql = $pdo-> prepare("SELECT * FROM usuarios WHERE idusuarios = :id");
  $sql -> bindValue(':id',$id);
  $sql -> execute();
  $dados = $sql-> fetch(PDO::FETCH_ASSOC);
}
if(isset( $_POST['tipo']))
{
  $tipo = $_POST['tipo'];
}
if (isset($_POST['name'])) {
  $name = $_POST['name'];
}
if (isset($_POST['password'])) {
  $password = $_POST['password'];
  $image = $_FILES['image'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style>
    #pesquisa{
      bottom:0;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      height:100vh;
      width:100%;
    }
    article{
      height:100vh;
      width:100%;
    }
   
  </style>
</head>
<body>
  <article id="criar">
      <?php
    if (isset($_POST['tipo'])) {
        if ($tipo == 1) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $image = $_FILES['image'];

            $nomeFinal = 'temp/'.time().'.jpg';
            move_uploaded_file($image['tmp_name'], $nomeFinal);
            $tamanhoImg = filesize($nomeFinal);// pega o tamanho do arquivo da imagem
            $image = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));

            $sql = $pdo -> prepare("INSERT INTO usuarios  (nome,senha,foto) VALUES ('$name',' $password','$image')");
            $sql -> bindValue(':image', $image);
            $sql -> execute();
            unlink($nomeFinal);
            echo '<h3>Cadastro Concluído</h3>';
        }
    }?>    
    </article>

    <article id="pesquisa">
      <?php  if(isset($_POST['buscador']) && !empty($_POST['buscador'])): ?>
      <img src="<?php echo'data:image/jpeg;base64,'.base64_encode($dados['foto'])?>" alt="imagem pra cego" >
      <?=$dados['nome']?>
      <?=$dados['senha']?>
    <?php endif; ?> 
    </article>


   <article id="elementos_att">   
     <?php if(isset($_POST['atualizar']) && !empty($_POST['atualizar'])) 
     {
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
          $image = $_POST['image'];
        }
        
        $sql = $pdo-> prepare(' UPDATE `usuarios` SET  nome = $name, senha = $password,foto = $image WHERE idusuarios = $id');
        $sql -> execute();
      }
 ?>
    </article>
    

    <article id="atualizar_elementos">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="inputs">
            <label for="name">Digite seu nome:
              <input name="name" type="text" value="gui">
            </label>
            <label for="password">Digite sua senha:
              <input name="password" type="password" value="***">
            </label>
            <input type="file" name="image" >
            <input type="hidden" name="tipo" value="true">
            <input type="submit" class="enviar"  onclick="document.getElementById('atualizar').submit()" value=" enviar ">
          </div>
        </form>
      </article>
    
</body>
</html>
