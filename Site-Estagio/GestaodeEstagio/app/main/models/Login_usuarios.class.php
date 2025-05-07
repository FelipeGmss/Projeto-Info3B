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


    // Professores

    public function Login_professor($email, $senha) {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
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
            }else {
             return false;
            }
    }
   

}


?>