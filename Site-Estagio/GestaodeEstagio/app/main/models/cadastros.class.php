<?php 

Class Cadastro{

    public function Cadastrar_empresa($nome, $contato, $endereco, $perfil, $vagas){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'INSERT INTO concedentes VALUES (null,:nome,:contato,:endereco,:perfil,:numero_vagas)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":endereco", $endereco);
        $query->bindValue(":perfil", $perfil);
        $query->bindValue(":numero_vagas", $vagas);
        $query->execute();

        if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idEmp'] = $dado['id'];

             return true;
            // header("Location: ../views/paginainicial.php");
            }else {
             return false;
            }
     } 

     public function Cadastrar_alunos($nome, $matricula, $contato, $curso){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'INSERT INTO aluno VALUES (null,:nome,:matricula,:contato,:curso)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":matricula", $matricula);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":curso", $curso);
        $query->execute();

        if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idAluno'] = $dado['id'];

             return true;
            // header("Location: ../views/paginainicial.php");
            }else {
             return false;
            }
     } 

     public function listar(){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'select * from concedentes;';
        $query = $pdo->prepare($consulta);
        $query->execute();
        $result = $query->rowCount();

        if ($result > 0) {
            foreach ($query as $value) {
                echo (" | nome: ". $value['nome'] ." | contato: ". $value['contato']." | endereco: ". $value['endereco']." | perfil: ". $value['perfil']." | numero_vagas: ". $value['numero_vagas']);
            }
        }
    } 

    public function excluir($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'delete from concedentes where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }
    
}

?>