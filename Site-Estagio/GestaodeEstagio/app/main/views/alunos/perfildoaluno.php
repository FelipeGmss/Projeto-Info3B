<?php 
    if (isset($_GET['resultado'])) {
        echo "<script>alert('Aluno excluido com sucesso');</script>";
        header('location:../../controllers/controller-listar_alunos.php');
    }else{
        header('location:../../controllers/controller-listar_alunos.php');
    }
    ?> 