<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID não fornecido']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('
        SELECT s.*, c.nome as nome_empresa, c.contato, c.endereco, c.numero_vagas, c.perfil 
        FROM selecao s 
        INNER JOIN concedentes c ON s.id_concedente = c.id 
        WHERE s.id = ?
    ');
    $stmt->execute([$_GET['id']]);
    $processo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($processo) {
        echo json_encode($processo);
    } else {
        echo json_encode(['error' => 'Processo não encontrado']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} 