<?php
include "inc/util.php";
checkConnection();

$l = $_GET['l'];
if($_SESSION['user_active']){
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Principal - LIKE</title>
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="../images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body class="main-body">
    <div class="todo">
      <div class="main-left-panel">
        <a href="main.php?l=new-post">
          <img src="img/icon-new-post.png" alt="">
          <p>Novo post</p>
        </a>
        <a href="main.php?l=list-posts">
          <img src="img/icon-list-posts.png" alt="">
          <p>Listar posts</p>
        </a>
      </div>
      <div class="main-top-panel">
        <img src="img/logo.png" onclick="location='main.php'" alt="">
        <a href="logout.php">Logout</a>
      </div>
      <iframe src="<?php $link = isset($l) ?  'iframes/'.$l.'.php' : "iframes/welcome.php"; echo $link?> "> Seu navegador não suporta iFrames. </iframe>
    </div>
    <div class="footer-main">Versão 1.0</div>
  </body>
</html>
<?php } ?>
