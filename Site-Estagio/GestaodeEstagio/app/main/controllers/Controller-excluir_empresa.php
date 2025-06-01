<?php 

require("../models/model-function.php");

if (isset($_POST['btn-excluir'])) {
    try {
        $id = $_POST['btn-excluir'];
        $x = new Cadastro();
        $resultado = $x->excluir_empresa($id);
        
        if($resultado){
            header('location:Controller-listar_empresa.php?resultado=excluir');
        } else {
            header('location:Controller-listar_empresa.php?resultado=erro');
        }
    } catch (PDOException $e) {
        // Log do erro para debug
        error_log("Erro ao excluir empresa: " . $e->getMessage());
        
        // Redireciona com mensagem de erro apropriada
        if($e->getCode() == 23000) {
            header('location:Controller-listar_empresa.php?resultado=erro_fk');
        } else {
            header('location:Controller-listar_empresa.php?resultado=erro');
        }
    }
}
?>