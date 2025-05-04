<?php 
session_start();
require("../models/Login_usuarios.class.php");

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $x = new Usuarios();
    if($x->Login_aluno($email, $senha) == true) {
        if(isset($_SESSION['idUser'])) {
            header("Location: ../views/detalhes_aluno.php?id=" . $_SESSION['idUser']);
            exit();
        } else {
            header("Location: ../views/Login_aluno.php");
            exit();
        }
    } else {
        header("Location: ../views/Login_aluno.php");
        exit();
    }
} else {
    header("Location: ../views/Login_aluno.php");
    exit();
}
?>