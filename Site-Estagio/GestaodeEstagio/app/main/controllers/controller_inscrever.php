<?php
session_start();
require_once '../models/cadastros.class.php';

if (!isset($_SESSION['idAluno'])) {
    header("Location: ../views/Login_aluno.php");
    exit;
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formulario = $_POST['id_formulario'];
    $id_aluno = $_SESSION['idAluno'];
    $data_inscricao = isset($_POST['data_inscricao']) ? $_POST['data_inscricao'] : date('Y-m-d H:i:s');
    $perfis = isset($_POST['perfis']) ? $_POST['perfis'] : [];
    $id_aluno = $_POST['id_aluno'];
    $data_inscricao = date('Y-m-d');

    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');

    // Get form details
    $stmt = $pdo->prepare('SELECT id_concedente, local, hora FROM selecao WHERE id = ?');
    $stmt->execute([$id_formulario]);
    $form = $stmt->fetch(PDO::FETCH_ASSOC);
    try {
        // Get form details
        $stmt = $pdo->prepare('SELECT id_concedente, local, hora FROM selecao WHERE id = ?');
        $stmt->execute([$id_formulario]);
        $form = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$form) {
        header("Location: ../views/processoseletivo.php?error=formulario_nao_encontrado");
        exit;
    }
        if (!$form) {
            echo json_encode([
                'success' => false,
                'message' => 'Formulário não encontrado'
            ]);
            exit;
        }

    // Check if student is already enrolled
    $stmt = $pdo->prepare('SELECT id FROM selecao WHERE id = ? AND id_aluno = ?');
    $stmt->execute([$id_formulario, $id_aluno]);
    if ($stmt->rowCount() > 0) {
        header("Location: ../views/processoseletivo.php?error=aluno_ja_inscrito");
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

    // Update the form with student data
    $stmt = $pdo->prepare('UPDATE selecao SET id_aluno = ?, data_inscricao = ? WHERE id = ?');
    if ($stmt->execute([$id_aluno, $data_inscricao, $id_formulario])) {
        // Update available positions
        $stmt = $pdo->prepare('UPDATE concedentes SET numero_vagas = numero_vagas - 1 WHERE id = ?');
        $stmt->execute([$form['id_concedente']]);
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

        header("Location: ../views/processoseletivo.php?success=inscricao_realizada");
    } else {
        header("Location: ../views/processoseletivo.php?error=erro_inscricao");
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao realizar inscrição: ' . $e->getMessage()
        ]);
    }
    exit;
}

header("Location: ../views/processoseletivo.php");
echo json_encode([
    'success' => false,
    'message' => 'Método não permitido'
]);
exit; 
