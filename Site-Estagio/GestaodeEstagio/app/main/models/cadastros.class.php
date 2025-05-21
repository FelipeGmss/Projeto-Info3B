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


     public function Cadastrar_alunos($nome, $matricula, $contato, $curso, $email, $endereco, $senha){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'INSERT INTO aluno VALUES (null,:nome,:matricula,:contato,:curso,:email,:endereco,:senha)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":matricula", $matricula);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":curso", $curso);
        $query->bindValue(":email", $email);
        $query->bindValue(":endereco", $endereco);
        $query->bindValue(":senha", $senha);
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


    public function excluir_empresa($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'delete from concedentes where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function excluir_aluno($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'delete from aluno where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function editar_empresaById($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'select * from concedentes where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch();
    }

    public function editar_alunoById($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'SELECT * FROM aluno WHERE id = :id';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado : false;
    }

    public function editar_empresa($id, $nome, $contato, $endereco, $perfil, $vagas){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = "UPDATE concedentes SET nome = :nome, contato = :contato, endereco = :endereco, perfil = :perfil, numero_vagas = :numero_vagas WHERE id = :id;";
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":endereco", $endereco);
        $query->bindValue(":perfil", $perfil);
        $query->bindValue(":numero_vagas", $vagas);
        $query->execute();
        return $query->rowCount();
    }

    public function editar_aluno_sem_senha($id, $nome, $matricula, $contato, $curso, $email, $endereco){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = "UPDATE aluno SET nome = :nome, matricula = :matricula, contato = :contato, curso = :curso, email = :email, endereco = :endereco WHERE id = :id;";
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->bindValue(":nome", $nome);
        $query->bindValue(":matricula", $matricula);
        $query->bindValue(":contato", $contato);
        $query->bindValue(":curso", $curso);
        $query->bindValue(":email", $email);
        $query->bindValue(":endereco", $endereco);
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function cadastrar_professor($email, $senha){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'INSERT INTO usuario VALUES (null,:email,:senha)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->bindValue(":senha", $senha);
        $query->execute();
    }

    public function cadastrar_selecao($hora, $local, $id_concedente, $data_inscricao, $id_aluno, $id_vaga){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'INSERT INTO selecao VALUES (null,:hora,:local,:id_concedente,:data_inscricao,:id_aluno,:id_vaga)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":hora", $hora);
        $query->bindValue(":local", $local);
        $query->bindValue(":id_concedente", $id_concedente);
        $query->bindValue(":data_inscricao", $data_inscricao);
        $query->bindValue(":id_aluno", $id_aluno);
        $query->bindValue(":id_vaga", $id_vaga);
        $query->execute();
    }

    public function excluir_formulario($id){
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
        $consulta = 'delete from selecao where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    // public function inscrever_aluno($id_formulario, $id_aluno){
    //     $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
    //     $consulta = 'INSERT INTO inscricao VALUES (null,:id_formulario,:id_aluno)';
    //     $query = $pdo->prepare($consulta);
    //     $query->bindValue(":id_formulario", $id_formulario);
    //     $query->bindValue(":id_aluno", $id_aluno);
    //     $query->execute();
    // }

}

?>