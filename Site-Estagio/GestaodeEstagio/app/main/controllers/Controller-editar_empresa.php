<?php 

require("../models/cadastros.class.php");

if(isset($_POST['btn-editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    $perfil = $_POST['perfil'];
    $vagas = $_POST['numero_vagas'];

    $x = new Cadastro();
    $resultado = $x->editar_empresa($id, $nome, $contato, $endereco, $perfil, $vagas);
    
    if($resultado){
        header('location:Controller-listar_empresa.php?resultado=editar');
    }else{
        header('location:Controller-listar_empresa.php?resultado=erro');
    }
}
?>