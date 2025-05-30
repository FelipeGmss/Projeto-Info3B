<?php 

require("../models/model-function.php");

if (isset($_POST['btn-excluir'])) {
    $id = $_POST['id'];
 
    $x = new Cadastro();
    $x->excluir_formulario($id);
    header('location:../views/processoseletivo.php?resultado=excluir');
}



?>