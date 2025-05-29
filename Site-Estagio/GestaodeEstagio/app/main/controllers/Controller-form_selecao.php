<?php 

require_once '../models/model-function.php';

if(isset($_POST['btn'])){
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $id_concedente = $_POST['id_concedente'];
    $data_inscricao = $_POST['data_inscricao'];
    $id_aluno = $_POST['id_aluno'];

    $x = new Cadastro();
    $x->cadastrar_selecao($hora, $local, $id_concedente, $data_inscricao, $id_aluno, $id_vaga);
    if($x){
        header("Location: ../views/processo_selecao/processoseletivo.php");
    }else{
        echo "Erro ao cadastrar";
    }
}

?>