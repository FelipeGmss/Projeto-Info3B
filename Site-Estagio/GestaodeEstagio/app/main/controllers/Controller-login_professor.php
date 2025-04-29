<?php 
session_start();
require("../models/Login_usuarios.class.php");

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {


    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $x = new Usuarios();
    if($x->Login_professor($email, $senha) == true) {
        if(isset($_SESSION['idUser'])) {
            header("Location: ../views/paginainical.php");
        }else {
            header("Location: ../views/Login_Professor.php");
        }
    }else {
        header("Location: ../views/Login_Professor.php");
    }

} else {
    header("Location: ../views/Login_Professor.php");
}




?>