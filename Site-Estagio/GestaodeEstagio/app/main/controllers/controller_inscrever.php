<?php
session_start();
require_once '../models/model-function.php';

if (!isset($_SESSION['idAluno'])) {
    header("Location: ../views/Login_aluno.php");
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_formulario = $_POST['id_formulario'];
    $id_aluno = $_SESSION['idAluno'];
    $data_inscricao = date('Y-m-d');

    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Get form and company details
        $stmt = $pdo->prepare('
            SELECT s.*, c.nome as nome_empresa, c.contato, c.endereco, c.numero_vagas, c.perfil 
            FROM selecao s 
            INNER JOIN concedentes c ON s.id_concedente = c.id 
            WHERE s.id = ?
        ');
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
                'message' => 'Você já está inscrito neste processo seletivo'
            ]);
            exit;
        }

        // Check if there are available positions
        if ($form['numero_vagas'] <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Não há mais vagas disponíveis'
            ]);
            exit;
        }

        // Begin transaction
        $pdo->beginTransaction();

        try {
            // Update selecao with student information
            $stmt = $pdo->prepare('UPDATE selecao SET id_aluno = ?, data_inscricao = ? WHERE id = ?');
            $result = $stmt->execute([$id_aluno, $data_inscricao, $id_formulario]);

            if ($result) {
                // Update available positions
                $stmt = $pdo->prepare('UPDATE concedentes SET numero_vagas = numero_vagas - 1 WHERE id = ?');
                $stmt->execute([$form['id_concedente']]);

                $pdo->commit();

                echo json_encode([
                    'success' => true,
                    'message' => 'Inscrição realizada com sucesso',
                    'data' => [
                        'empresa' => $form['nome_empresa'],
                        'contato' => $form['contato'],
                        'endereco' => $form['endereco'],
                        'perfil' => $form['perfil'],
                        'data_inscricao' => $data_inscricao
                    ]
                ]);
            } else {
                throw new Exception('Erro ao realizar inscrição');
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao realizar inscrição: ' . $e->getMessage()
        ]);
    }
    exit;
}

// If not POST request, return error
echo json_encode([
    'success' => false,
    'message' => 'Método não permitido'
]);
exit; 

