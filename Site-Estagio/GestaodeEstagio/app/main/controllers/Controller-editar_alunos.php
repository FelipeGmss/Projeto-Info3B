<?php 
require("../models/model-function.php");

if (isset($_POST['btn-editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $contato = $_POST['contato'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    
    $x = new Cadastro();
    $resultado = $x->editar_aluno_sem_senha($id, $nome, $matricula, $contato, $curso, $email, $endereco);
    
    if ($resultado) {
        header("Location: Controller-listar_alunos.php?success=aluno_atualizado");
    } else {
        header("Location: Controller-listar_alunos.php?error=erro_ao_atualizar");
    }
    exit;
}
?>
