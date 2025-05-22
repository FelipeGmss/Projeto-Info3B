<?php
require_once '../models/model-function.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formulario = $_POST['id_formulario'];
    $id_aluno = $_POST['id_aluno'];
    $data_inscricao = date('Y-m-d');

    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');

    try {
        // Get form details
        $stmt = $pdo->prepare('SELECT id_concedente, local, hora FROM selecao WHERE id = ?');
        $stmt->execute([$id_formulario]);
        $form = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$form) {
            echo json_encode([
                'success' => false,
                'message' => 'Formulário não encontrado'
            ]);
            exit;
        }

        // Check if student is already enrolled
        $stmt = $pdo->prepare('SELECT id FROM selecao WHERE id_aluno = ? AND id = ?');
        $stmt->execute([$id_aluno, $id_formulario]);
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Aluno já está inscrito neste processo seletivo'
            ]);
            exit;
        }

        // Update the selecao table with student enrollment
        $stmt = $pdo->prepare('UPDATE selecao SET id_aluno = ?, data_inscriçao = ? WHERE id = ?');
        $result = $stmt->execute([$id_aluno, $data_inscricao, $id_formulario]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Inscrição realizada com sucesso'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erro ao realizar inscrição'
            ]);
        }

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao realizar inscrição: ' . $e->getMessage()
        ]);
    }
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Método não permitido'
]);
exit; 