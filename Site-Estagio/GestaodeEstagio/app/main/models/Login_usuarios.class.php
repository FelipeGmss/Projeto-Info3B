<?php 

// Alunos
Class Usuarios {
    public function Login_aluno($email, $senha) {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
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
            }else {
             return false;
            }
    }

    public function Recuperar_senha($email) {
        $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
        $consulta = 'SELECT * FROM usuario WHERE email_aluno = :email';
        $query = $pdo->prepare($consulta);
        $query->bindValue(":email", $email);
        $query->execute();
    }




    // Professores

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
   

}


?>