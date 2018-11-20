<?php
include "../inc/util.php";
allowView();

$gPostId = $_GET['post'];

$pTitulo = $_POST['titulo'];
$pDescricao = $_POST['descricao'];


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
$result = $conn->prepare("select titulo, descricao from cp_posts where id = ?");
$result->bind_param('i', $gPostId);
$result->execute();
$result->bind_result($tituloAtual, $descricaoAtual);
$result->fetch();
$conn->close();

if(isset($pTitulo) && isset($pDescricao)){
  if(!checkCredentials($pTitulo, $pDescricao)){
    alertThat('Preencha os campos Título e Descrição corretamente.');
  }else{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
    $result = $conn->prepare("update cp_posts set titulo = ?, descricao = ? where id = ?");
    $result->bind_param('ssi', $pTitulo, $pDescricao, $gPostId);
    if($result->execute()){
      alertThat("Post editado com sucesso!");
      scriptThat("location='list-posts.php'");
    }else{
      alertThat("Erro ao editar este post!");
      scriptThat("location='list-posts.php'");
    }
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
      <p>Editar post</p>
    </div>
    <form class="" action="edit-post.php?post=<?= $gPostId ?>" method="post">
      <table class="iframe-table">
        <tr>
          <th> Título </th>
          <td> <input type="text" name="titulo" value="<?= $tituloAtual ?>" autofocus> </td>
        </tr>
        <tr>
          <th> Descrição </th>
          <td> <textarea name="descricao" rows="8" cols="50"><?= $descricaoAtual ?></textarea> </td>
        </tr>
        <tr>
          <th> </th>
          <td> <input  type="submit" name="" value="Editar!"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
