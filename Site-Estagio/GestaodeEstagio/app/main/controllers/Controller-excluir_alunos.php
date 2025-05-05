<?php 

require("../models/cadastros.class.php");

if (isset($_POST['btn-excluir'])) {
   $id = $_POST['btn-excluir'];


   $x = new Cadastro();
   $x->excluir_aluno($id);
header('location:../views/perfildoaluno.php?resultado=excluir');
}
?>