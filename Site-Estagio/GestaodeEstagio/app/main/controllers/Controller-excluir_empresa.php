<?php 

require("../models/cadastros.class.php");

if (isset($_POST['btn'])) {
   $id = $_POST['btn'];


   $x = new Cadastro();
   $x->excluir($id);
header('location:../views/dadosempresa.php?resultado=excluir');
}
?>