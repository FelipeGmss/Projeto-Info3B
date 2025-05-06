<?php 

// Incluir a classe Cadastro
require_once '../models/cadastros.class.php';

if(isset($_GET['btn-editar'])){
    $opc = $_GET['btn-editar'];
    $id = $_GET['btn-editar'];

    switch($opc){
        case 'Editar Empresa':
            $empresa = new Cadastro();
            $empresa->editar_empresaById($id);
            include '../views/editar_empresa.php';
            break;
        case 'Editar Aluno':
            $aluno = new Cadastro();
            $aluno->editar_alunoById($id);
            include '../views/editar_aluno.php';
            break;
    }
}

?>