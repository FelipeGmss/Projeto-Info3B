<?php
header('Content-Type: application/json');

require_once '../models/model-function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_selecao'])) {
        echo json_encode([
            'success' => false,
            'message' => 'ID da seleção não fornecido'
        ]);
        exit;
    }

    $id_selecao = $_POST['id_selecao'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Excluir a inscrição
        $stmt = $pdo->prepare('DELETE FROM inscricoes WHERE id_selecao = ?');
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

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao remover inscrição: ' . $e->getMessage()
        ]);
    }
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Método não permitido'
]);
exit;
?> 