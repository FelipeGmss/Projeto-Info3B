<?php 

require_once '../models/cadastros.class.php';
if(isset($_POST['btn-editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    $perfil = $_POST['perfil'];
    $vagas = $_POST['numero_vagas'];

    $empresa = new Cadastro();
    $empresa->editar_empresa($id, $nome, $contato, $endereco, $perfil, $vagas);
    header('location:../views/dadosempresa.php?resultado=editar');
}
?>