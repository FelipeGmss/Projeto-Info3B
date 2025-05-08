<?php
require("../models/model.functions.php");

if (isset($_POST["btn"])) {
   $hora = $_POST['hora'];
   $local= $_POST['local'];
   $empresa_id = $_POST['empresa_id'];
   $data = $_POST['data'];
   $aluno_id = $_POST['aluno_id'];
   $vaga_id = $_POST['vaga_id'];

   $x = new Cadastro();
   $x->cadastroselecao($hora,$local, $empresa_id, $data, $aluno_id, $vaga_id);

}

?>
