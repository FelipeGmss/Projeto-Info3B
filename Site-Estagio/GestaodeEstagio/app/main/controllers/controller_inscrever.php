<?php
session_start();
require_once '../models/cadastros.class.php';

if (!isset($_SESSION['idAluno'])) {
    header("Location: ../views/Login_aluno.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formulario = $_POST['id_formulario'];
    $id_aluno = $_SESSION['idAluno'];
    $data_inscricao = isset($_POST['data_inscricao']) ? $_POST['data_inscricao'] : date('Y-m-d H:i:s');
    $perfis = isset($_POST['perfis']) ? $_POST['perfis'] : [];

    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');

    // Get form details
    $stmt = $pdo->prepare('SELECT id_concedente, local, hora FROM selecao WHERE id = ?');
    $stmt->execute([$id_formulario]);
    $form = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$form) {
        header("Location: ../views/processoseletivo.php?error=formulario_nao_encontrado");
        exit;
    }

    // Check if student is already enrolled
    $stmt = $pdo->prepare('SELECT id FROM selecao WHERE id = ? AND id_aluno = ?');
    $stmt->execute([$id_formulario, $id_aluno]);
    if ($stmt->rowCount() > 0) {
        header("Location: ../views/processoseletivo.php?error=aluno_ja_inscrito");
        exit;
    }

    // Update the form with student data
    $stmt = $pdo->prepare('UPDATE selecao SET id_aluno = ?, data_inscricao = ? WHERE id = ?');
    if ($stmt->execute([$id_aluno, $data_inscricao, $id_formulario])) {
        // Update available positions
        $stmt = $pdo->prepare('UPDATE concedentes SET numero_vagas = numero_vagas - 1 WHERE id = ?');
        $stmt->execute([$form['id_concedente']]);

        header("Location: ../views/processoseletivo.php?success=inscricao_realizada");
    } else {
        header("Location: ../views/processoseletivo.php?error=erro_inscricao");
    }
    exit;
}

header("Location: ../views/processoseletivo.php");
exit; 