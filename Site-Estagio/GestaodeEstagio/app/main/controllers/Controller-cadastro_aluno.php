<?php 
session_start();
require("../models/model-function.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $matricula = $_POST['matricula'];
   $contato = $_POST['contato'];
   $curso = $_POST['curso'];
   $email = $_POST['email'];
   $endereco = $_POST['endereco'];
   $senha = $_POST['senha'];

   try {
       $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       // Verificar se a matrícula já existe
       $stmt = $pdo->prepare("SELECT matricula FROM aluno WHERE matricula = ?");
       $stmt->execute([$matricula]);
       
       if ($stmt->rowCount() > 0) {
           // Matrícula já existe, redirecionar com mensagem de erro
           header("Location: ../views/cadastroaluno.php?error=duplicate");
           exit();
       }

       // Se a matrícula não existe, prosseguir com o cadastro
       $x = new Cadastro();
       $x->Cadastrar_alunos($nome, $matricula, $contato, $curso, $email, $endereco, $senha);
       header("Location: ../views/perfildoaluno.php");
       exit();
   } catch (PDOException $e) {
       header("Location: ../views/cadastroaluno.php?error=database");
       exit();
   }
}
?>
