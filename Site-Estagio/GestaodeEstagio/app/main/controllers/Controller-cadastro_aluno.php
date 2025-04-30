
<?php 
session_start();
require("../models/Login_usuarios.class.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $telefone = $_POST['telefone'];
   $curso = $_POST['curso'];
   $perfil = $_POST['perfil'];

   $x = new Usuarios();
   $x->Cadastrar_alunos($nome, $email, $telefone, $curso, $perfil);
   header("Location: ../views/cadastroaluno.php");
}

?>
