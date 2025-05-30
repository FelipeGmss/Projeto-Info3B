<?php
session_start();
require_once '../models/model-function.php';

// Removendo a verificação de sessão inicial, o id_aluno virá do formulário via POST
// if (!isset($_SESSION['idAluno'])) {
//     header("Location: ../views/Login_aluno.php");
//     exit;
// }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formulario = $_POST['id_formulario'] ?? null; // Este é o ID na tabela `selecao`
    $id_aluno = $_POST['id_aluno'] ?? null; // ID do aluno selecionado
    // $data_inscricao = date('Y-m-d H:i:s'); // Data e hora atuais da inscrição - não usada mais na query

    if (!$id_formulario || !$id_aluno) {
        echo json_encode([
            'success' => false,
            'message' => 'Dados incompletos: ID do formulário ou ID do aluno faltando.'
        ]);
        exit;
    }
    
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Verifica apenas se o mesmo aluno já está inscrito neste processo
        $check_query = $pdo->prepare("
            SELECT id_aluno FROM selecao 
            WHERE id = :id_formulario AND id_aluno = :id_aluno
        ");
        $check_query->bindValue(":id_formulario", $id_formulario);
        $check_query->bindValue(":id_aluno", $id_aluno);
        $check_query->execute();
        
        if ($check_query->rowCount() > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Você já está inscrito neste processo seletivo.'
            ]);
            exit;
        }
        
        // Insere uma nova inscrição
        $query = $pdo->prepare("
            INSERT INTO selecao (id_concedente, id_aluno, hora, local, status)
            SELECT id_concedente, :id_aluno, hora, local, 'pendente'
            FROM selecao 
            WHERE id = :id_formulario
        ");
        
        $query->bindValue(":id_aluno", $id_aluno);
        $query->bindValue(":id_formulario", $id_formulario);
        $query->execute();
        
        echo json_encode([
            'success' => true,
            'message' => 'Inscrição realizada com sucesso!'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao realizar inscrição: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método não permitido'
    ]);
}
?> 

