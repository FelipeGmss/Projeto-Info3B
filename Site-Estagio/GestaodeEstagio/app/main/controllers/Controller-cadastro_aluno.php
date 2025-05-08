<?php 
session_start();
require("../models/model.functions.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $matricula = $_POST['matricula'];
   $contato = $_POST['contato'];
   $curso = $_POST['curso'];
   $email = $_POST['email'];
   $endereco = $_POST['endereco'];
   $senha = $_POST['senha'];

   
   $x = new Cadastro();
   $x->Cadastrar_alunos($nome, $matricula, $contato, $curso, $email, $endereco, $senha);
   header("Location: ../views/cadastroaluno.php");
}

?>
