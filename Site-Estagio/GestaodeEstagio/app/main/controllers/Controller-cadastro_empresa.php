<?php 
session_start();
require("../models/model-function.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $contato = $_POST['contato'];
   $endereco = $_POST['endereco'];
   $perfil = $_POST['perfil'];
   $vagas = $_POST['numero_vagas'];

   $x = new Cadastro();
   $x->Cadastrar_empresa($nome, $contato, $endereco, $perfil, $vagas);
   header("Location: ../views/dadosempresa.php");
}

?>
