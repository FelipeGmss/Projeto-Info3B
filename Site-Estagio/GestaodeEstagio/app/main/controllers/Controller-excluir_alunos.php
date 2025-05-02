<?php 

require("../models/cadastros.class.php");

if (isset($_POST['btn'])) {
   $id = $_POST['btn'];


   $x = new Cadastro();
   $x->excluir_aluno($id);
header('location:../views/perfildoaluno.php?resultado=excluir');
}
?>