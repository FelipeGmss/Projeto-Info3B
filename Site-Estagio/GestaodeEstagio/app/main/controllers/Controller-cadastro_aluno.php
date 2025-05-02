
<?php 
session_start();
require("../models/cadastros.class.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $matricula = $_POST['matricula'];
   $contato = $_POST['contato'];
   $curso = $_POST['curso'];

   
   $x = new Cadastro();
   $x->Cadastrar_alunos($nome, $matricula, $contato, $curso);
   header("Location: ../views/cadastroaluno.php");
}

?>
