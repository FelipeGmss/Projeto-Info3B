
<?php 
session_start();
require("../models/Login_usuarios.class.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $contato = $_POST['contato'];
   $endereco = $_POST['endereco'];
   $cidade = $_POST['cidade'];
   $vagas = $_POST['vagas'];

   $x = new Usuarios();
   $x->Cadastrar_empresa($nome, $contato, $endereco, $cidade, $vagas);
   header("Location: ../views/cadastrodaempresa.php");
}

?>
