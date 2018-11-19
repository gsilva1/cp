<?php
include "../inc/util.php";
allowView();

$gPostId = $_GET['post'];
$pResposta = $_POST['submit'];

if($pResposta == "Sim"){
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
  $result = $conn->prepare("delete from cp_posts where id = ?");
  $result->bind_param('i', $gPostId);
  $result->execute();
  //$result->fetch();
  scriptThat('alert("Post deleteado com sucesso!"); location.href="list-posts.php"');
}else if($pResposta == "Não"){
  header("Location: list-posts.php");

}

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
  </head>
  <body>
    <div class="iframe-title">
      <p>Deletar post</p>
    </div>
    <div class="iframe-delete-post-box">
        <h3>Você tem certeza que deseja excluir este post?</h3>
        <form class="" action="delete-post.php?post=<?= $gPostId ?>" method="post">
          <input type="submit" name="submit" value="Sim">
          <input type="submit" name="submit" value="Não">
        </form>
    </div>
  </body>
</html>
