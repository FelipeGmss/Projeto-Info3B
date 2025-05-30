<?php 
    if (isset($_GET['resultado'])) {
        echo "<script>alert('Empresa excluida com sucesso');</script>";
        header('location:../controllers/Controller-listar_empresa.php');
    }else{
        header('location:../controllers/Controller-listar_empresa.php');
    }
?>
