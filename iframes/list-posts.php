<?php
include "../inc/util.php";
allowView();






?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
  </head>
  <body class="iframe-welcome-body">
    <div class="iframe-title">
      <p>Listar posts</p>
    </div>
    <?php
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
    $result = $conn->prepare("select count(*) from cp_posts");
    $result->execute();
    $result->bind_result($count);
    $result->fetch();
    $result->close();
    if($count > 0){
    ?>
      <table class="iframe-table-list-posts">
        <thead>
          <tr>
            <th>TÍTULO</th>
            <th>DESCRIÇÃO</th>
            <th>ADICIONADO EM</th>
            <th>OPÇÕES</th>
          </tr>
        </thead>
        <tbody>
        <?php

        $result = $conn->prepare("select * from cp_posts order by inserido_em desc");
        //$result->bind_param('ss', $pTitulo, $pDescricao);
        $result->execute();
        $result->bind_result($id, $titulo, $descricao, $inseridoem);

        while($result->fetch()){
        ?>
          <tr>
            <td><?= $titulo ?></td>
            <td><?= $descricao ?></td>
            <td><?= $inseridoem ?></td>
            <td>
              <a href="edit-post.php?post=<?= $id ?>"> <img src="../img/icon-edit-post.png" alt=""> </a>
              <a href="delete-post.php?post=<?= $id ?>"> <img src="../img/icon-delete-post.png" alt=""> </a>
            </td>
          </tr>
        <?php
        }
        ?>
        </tbody>


      </table>
<?php
    }else{
      echo "<br><br><br><h4>Não há posts disponíveis para serem exibidos.<br>Adicione algum post.</h4>";
    }
    ?>
  </body>
</html>
