<?php 
session_start();
require("../models/model-function.php");
require_once '../config/conexao.php';

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $matricula = $_POST['matricula'];
   $contato = $_POST['contato'];
   $curso = $_POST['curso'];
   $email = $_POST['email'];
   $endereco = $_POST['endereco'];
   $senha = $_POST['senha'];

   // Verificar se a matrícula já existe
   $sql_check = "SELECT matricula FROM aluno WHERE matricula = ?";
   $stmt_check = $conexao->prepare($sql_check);
   $stmt_check->bind_param("s", $matricula);
   $stmt_check->execute();
   $result = $stmt_check->get_result();

   if ($result->num_rows > 0) {
       // Matrícula já existe, redirecionar com mensagem de erro
       header("Location: ../views/cadastroaluno.php?error=duplicate");
       exit();
   }

   // Se a matrícula não existe, prosseguir com o cadastro
   $x = new Cadastro();
   $x->Cadastrar_alunos($nome, $matricula, $contato, $curso, $email, $endereco, $senha);
   header("Location: ../views/Login_aluno.php");
   exit();
}

?>
