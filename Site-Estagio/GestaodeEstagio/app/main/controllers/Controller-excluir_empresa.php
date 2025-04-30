<?php 

require("../models/Login_usuarios.class.php");

if (isset($_POST['btn'])) {
   $id = $_POST['btn'];


   $x = new Usuarios();
   $x->excluir($id);
header('location:../views/dadosempresa.php?resultado=excluir');
}
?>