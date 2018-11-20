<?php
// credenciais de acesso
// usuario: like
// senha: $uc3sS0!
// senha provisoria:  123
include "inc/util.php";

if(isset($_POST['user']) && !checkCredentials($_POST['user'], $_POST['passwd'])){
  alertThat('Preencha os campos usuário e senha corretamente.');
}else if(isset($_POST['user'])){
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysql_error());
  $result = $conn->prepare("select password from cp_users where login = ?");
  $result->bind_param('s', $_POST['user']);
  $result->execute();
  $result = $result->get_result();
  $data = mysqli_fetch_assoc($result);
  if(password_verify($_POST['passwd'], $data['password'])){
    // Logado no sistema
    session_start();
    $_SESSION['loginTime'] = time();
    $_SESSION['user_active'] = true;
    header("Location: main.php");
  }else {
    // Credenciais invalidas
    alertThat("Dados inválidos.");
  }
}

unset($_POST['user'], $_POST['passwd']);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Control Panel - Instituto LIKE</title>
    <link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="../images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body class="login-body">
      <div class="login-center-box">
        <img src="img/logo.png" alt="">
        <h1>LIKE Control Panel</h1>
        <form class="login-form" action="index.php" method="post">
          <input type="text" name="user" maxlength="8" placeholder="Usuário" autofocus>
          <input type="password" name="passwd" maxlength="8" placeholder="Senha">
          <input type="submit" name="submit" value="Entrar">
        </form>
      </div>
      <div class="footer-index">Versão 1.0</div>
  </body>
</html>
