<?php 

require("../models/model-function.php");

if(isset($_POST['btn-editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    $perfis = isset($_POST['perfis']) ? json_encode($_POST['perfis']) : json_encode([]);
    $vagas = $_POST['numero_vagas'];

    $x = new Cadastro();
    $resultado = $x->editar_empresa($id, $nome, $contato, $endereco, $perfis, $vagas);
    
    if($resultado){
        header('location:Controller-listar_empresa.php?resultado=editar');
    }else{
        header('location:Controller-listar_empresa.php?resultado=erro');
    }
}
?>