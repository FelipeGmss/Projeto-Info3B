<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

try {
    if (!isset($_POST['id_selecao']) || !isset($_POST['id_aluno'])) {
        throw new Exception('Dados incompletos para alocação');
    }

    $id_selecao = intval($_POST['id_selecao']);
    $id_aluno = intval($_POST['id_aluno']);

    // Verificar se o aluno já está alocado em outra vaga
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT id FROM selecao WHERE id_aluno = ? AND id != ?");
    $stmt->bind_param("ii", $id_aluno, $id_selecao);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('Este aluno já está alocado em outra vaga');
    }

    // Atualizar a seleção para marcar o aluno como alocado
    $stmt = $conn->prepare("UPDATE selecao SET id_aluno = ? WHERE id = ?");
    $stmt->bind_param("ii", $id_aluno, $id_selecao);
    
    if (!$stmt->execute()) {
        throw new Exception('Erro ao alocar aluno: ' . $stmt->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Aluno alocado com sucesso',
        'redirect' => '../views/alunos_alocados.php'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 