<?php 

require_once '../models/model-function.php';

if(isset($_POST['btn'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $x = new Cadastro();
    $resultado = $x->cadastrar_professor($email, $senha);
    if($resultado){
        header('location:../views/Login_professor.php');
    }else{
        header('location:../views/Cadastro_professor.php');
    }
}


?>