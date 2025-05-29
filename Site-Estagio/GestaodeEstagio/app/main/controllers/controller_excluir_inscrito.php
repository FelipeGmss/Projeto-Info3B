<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_selecao = $_POST['id_selecao'];
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Update the selecao table to remove the student enrollment
        $stmt = $pdo->prepare('UPDATE selecao SET id_aluno = NULL, data_inscriçao = NULL WHERE id = ?');
        $result = $stmt->execute([$id_selecao]);
        
        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Inscrição removida com sucesso'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erro ao remover inscrição'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao remover inscrição: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método não permitido'
    ]);
}
?> 