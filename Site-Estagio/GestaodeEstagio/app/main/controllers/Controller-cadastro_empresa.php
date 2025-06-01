<?php 
session_start();
require("../models/model-function.php");

if (isset($_POST["btn"])) {
   $nome = $_POST['nome'];
   $contato = $_POST['contato'];
   $endereco = $_POST['endereco'];
   $perfis = isset($_POST['perfis']) ? json_encode($_POST['perfis']) : json_encode([]);
   $vagas = $_POST['numero_vagas'];

   $x = new Cadastro();
   $x->Cadastrar_empresa($nome, $contato, $endereco, $perfis, $vagas);
   header("Location: ../views/dadosempresa.php");
}

?>
