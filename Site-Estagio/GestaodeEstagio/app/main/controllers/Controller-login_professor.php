<?php 
session_start();
require("../models/model-function.php");

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {


    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $x = new Usuarios();
    if($x->Login_professor($email, $senha) == true) {
        if(isset($_SESSION['idUser'])) {
            header("Location: ../views/paginainicial.php");
        }else {
            header("Location: ../views/Login_professor.php");
        }
    }else {
        header("Location: ../views/Login_professor.php");
    }

} else {
    header("Location: ../views/Login_professor.php");
}




?>