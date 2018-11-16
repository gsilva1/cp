<?php
include "../inc/util.php";
allowView();


$pTitulo = $_POST['titulo'];
$pDescricao = $_POST['descricao'];

if(isset($pTitulo) && isset($pDescricao)){
  if(!checkCredentials($pTitulo, $pDescricao)){
    alertThat('Preencha os campos Título e Descrição corretamente.');
  }else{

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
    $result = $conn->prepare("insert into cp_posts(titulo, descricao, inserido_em) values(?, ?, now()) ");
    $result->bind_param('ss', $pTitulo, $pDescricao);
    $result->execute();
    alertThat("Post adicionado com sucesso!");
    scriptThat("location='welcome.php'");
  }
}


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
  </head>
  <body class="iframe-welcome-body">
    <div class="iframe-title">
      <p>Novo post</p>
    </div>
    <form class="" action="new-post.php" method="post">
      <table class="iframe-table">
        <tr>
          <th> Título </th>
          <td> <input type="text" name="titulo" value="" autofocus> </td>
        </tr>
        <tr>
          <th> Descrição </th>
          <td> <textarea name="descricao" rows="8" cols="80"></textarea> </td>
        </tr>
        <tr>
          <th> Selecionar imagens </th>
          <td> <input type="file" name="fileUpload[]" value="" accept="image/*" multiple  > </td>
        </tr>
        <tr>
          <th> </th>
          <td> <input id="submit" type="submit" name="" value="Postar!"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
