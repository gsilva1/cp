<?php
include "../inc/util.php";
allowView();
if(isset($_POST['submit'])){
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
      $result->close();
      /*
      Precisa modificar os seguintes itens do arquivo de configura��o PHP:
      file_uploads = On   -> Ativar upload de arquivos
      upload_max_filesize = 50M   -> Tamanho m�ximo do arquivo de upload:
      post_max_size  = 50M -> Tamanho m�ximo do upload como um todo
      Tempo m�ximo de espera de upload (levar em considera��o o tamanho do arquivo)
      max_execution_time = 60   /   max_input_time = 60
      */
      /*

+-------------+---------------+------+-----+---------+----------------+
| Field       | Type          | Null | Key | Default | Extra          |
+-------------+---------------+------+-----+---------+----------------+
| id          | int(11)       | NO   | PRI | NULL    | auto_increment |
| titulo      | varchar(120)  | YES  |     | NULL    |                |
| descricao   | varchar(2000) | YES  |     | NULL    |                |
| inserido_em | datetime      | YES  |     | NULL    |                |
+-------------+---------------+------+-----+---------+----------------+

*/

      $result = $conn->prepare("select id, inserido_em from cp_posts where titulo = ?");
      $result->bind_param('s', $pTitulo);
      $result->execute();
      $result->bind_result($id, $inseridoem);
      $data = $result->fetch();
      $result->close();

      $novaPasta =  'post_'.$id.'_'.substr($inseridoem, 0, 10).'/';

      $pasta = FILES_PATH.$novaPasta; // Caminho para salvar os arquivos
      $sucess = 0;
      $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;

      // ------------ CRIA PASTA -------------------
      $dir = $pasta;
      $oldmask = umask(0);
      mkdir($dir, 0777);
      /* ------------ CRIA UM INDEX.PHP PARA EVITAR ACESSO INDEVIDO AOS ARQUIVOS ------------ */
      $fp = fopen($dir.'/index.php', 'w');
      fwrite($fp, '<?php header("Location: https://www.instituto.com.br"); ?>');
      fclose($fp);
      /* ------------------------------------------------------------------------------------ */
      umask($oldmask);
      // ------------ / CRIA PASTA -------------------
      if($arquivo != FALSE){
        for ($i = 0; $i < count($arquivo['name']); $i++){
          $destino = $pasta.$arquivo['name'][$i];
          if(move_uploaded_file($arquivo['tmp_name'][$i], $destino)){
            $sucess = 1;
          }
          else{
            $result = $conn->prepare("delete from cp_posts where id = ?");
            $result->bind_param('i', $id);
            $result->execute();
            $data = $result->fetch();
            echo "<script>alert('Falha ao enviar!'); history.go(-1);</script>";
          }
        }
      }
      else{
        echo "<script>alert('Selecione arquivos para enviar!'); history.go(-1);</script>";
      }
      unset($_POST['enviar']);
      alertThat("Post adicionado com sucesso!");
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
  <script>
  var selDiv = "";

  document.addEventListener("DOMContentLoaded", init, false);

  function init() {
    document.querySelector('#arquivo').addEventListener('change', handleFileSelect, false);
    selDiv = document.querySelector("#selectedFiles");
  }

  function handleFileSelect(e) {

    if(!e.target.files) return;

    selDiv.innerHTML = "";
    selDiv.innerHTML = "<h4 style='text-align: center; margin-bottom: 0'>Arquivos selecionados: </h4>";

    var files = e.target.files;

    for(var i=0; i<files.length; i++) {
      var f = files[i];

      selDiv.innerHTML += f.name + "<br/>";

    }

  }
  </script>
</head>
<body class="iframe-welcome-body">
  <div class="iframe-title">
    <p>Novo post</p>
  </div>
  <form action="new-post.php" enctype="multipart/form-data" method="post" >
    <table class="iframe-table">
      <tr>
        <th> Título </th>
        <td> <input type="text" name="titulo" value="" autofocus> </td>
      </tr>
      <tr>
        <th> Descrição </th>
        <td> <textarea name="descricao" rows="8" cols="50"></textarea> </td>
      </tr>
      <tr>
        <th> Selecionar imagens </th>
        <td>
          <input id="arquivo" type="file" name="arquivo[]" multiple="multiple">
          <div id="selectedFiles"></div>
        </td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" name="submit" value="Postar"></td>
      </tr>
    </table>
  </form>
</body>
</html>
