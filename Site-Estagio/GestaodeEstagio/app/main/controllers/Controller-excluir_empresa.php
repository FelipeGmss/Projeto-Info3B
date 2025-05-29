<?php 

require("../models/model-function.php");

if (isset($_POST['btn-excluir'])) {
   $id = $_POST['btn-excluir'];


   $x = new Cadastro();
   $x->excluir_empresa($id);
header('location:../views/dadosempresa.php?resultado=excluir');
}
?>