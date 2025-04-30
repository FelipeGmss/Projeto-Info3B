<?php 

Class Usuarios {
        public function Login_aluno($email, $senha) {
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'SELECT * FROM usuario WHERE email_aluno = :email AND senha_aluno = :senha';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->bindValue(":senha", $senha);
        $query->execute();

            if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idUser'] = $dado['id'];

             return true;
            // header("Location: ../views/paginainicial.php");
            }else {
             return false;
            }
    }


    public function Login_professor($email, $senha) {
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'SELECT * FROM user_prof WHERE email_professor = :email AND senha_professor = :senha';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->bindValue(":senha", $senha);
        $query->execute();

            if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idUser'] = $dado['id'];

             return true;
            // header("Location: ../views/paginainicial.php");
            }else {
             return false;
            }
    }

    public function Cadastrar_empresa($nome, $contato, $endereco, $cidade, $vagas){
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'INSERT INTO cadastro_emp VALUES (null,:nome,:contato,:endereco,:cidade,:vagas)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":endereco", $endereco);
        $query->bindValue(":cidade", $cidade);
        $query->bindValue(":vagas", $vagas);
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

     public function Cadastrar_alunos($nome, $email, $telefone, $curso, $perfil){
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'INSERT INTO cadastro_aluno VALUES (null,:nome,:email,:telefone,:curso,:perfil)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":email", $email);
        $query->bindValue(":telefone", $telefone);
        $query->bindValue(":curso", $curso);
        $query->bindValue(":perfil", $perfil);
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
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'select * from cadastro_emp;';
        $query = $pdo->prepare($consulta);
        $query->execute();
        $result = $query->rowCount();

        if ($result > 0) {
            foreach ($query as $value) {
                echo (" | nome: ". $value['nome'] ." | contato: ". $value['contato']." | endereco: ". $value['endereco']." | cidade: ". $value['cidade']." | vagas: ". $value['vagas']);
            }
        }
    }

    public function excluir($id){
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'delete from cadastro_emp where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
     }
}


?>