<?php

class Cadastro
{

    public function Cadastrar_empresa($nome, $contato, $endereco, $perfil, $vagas)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
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
        } else {
            return false;
        }
    }


    public function Cadastrar_alunos($nome, $matricula, $contato, $curso, $email, $endereco, $senha)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
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
        } else {
            return false;
        }
    }


    public function excluir_empresa($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'delete from concedentes where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function excluir_aluno($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'delete from aluno where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function editar_empresaById($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'select * from concedentes where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch();
    }

    public function editar_alunoById($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'select * from aluno where id = :id;';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch();
    }

    public function editar_empresa($id, $nome, $contato, $endereco, $perfil, $vagas)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
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

    public function cadastroselecao($hora, $local, $empresa_id, $data, $aluno_id, $vaga_id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'INSERT INTO selecao VALUES (null,:hora,:local,:empresa_id,:data,:aluno_id,:vaga_id)';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":hora", $hora);
        $query->bindValue(":local", $local);
        $query->bindValue(":empresa_id", $empresa_id);
        $query->bindValue(":data", $data);
        $query->bindValue(":aluno_id", $aluno_id);
        $query->bindValue(":vaga_id", $vaga_id);
        $query->execute();

        header("Location: ../views/paginainicial.php");
    }
}

class Usuarios
{
    public function Login_aluno($email, $senha)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'SELECT * FROM aluno WHERE email = :email AND senha = :senha';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->bindValue(":senha", $senha);
        $query->execute();

        if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idUser'] = $dado['id'];

            return true;
            // header("Location: ../views/paginainicial.php");
        } else {
            return false;
        }
    }


    // Professores

    public function Login_professor($email, $senha)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $consulta = 'SELECT * FROM usuario WHERE email = :email AND senha = :senha';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->bindValue(":senha", $senha);
        $query->execute();

        if ($query->rowCount() > 0) {
            $dado = $query->fetch();
            $_SESSION['idUser'] = $dado['id'];

            return true;
            // header("Location: ../views/paginainicial.php");
        } else {
            return false;
        }
    }

    
}
