<?php
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID do processo não fornecido']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar detalhes do processo e do concedente
    $sql = 'SELECT s.id, s.hora, s.local, c.id as id_concedente, c.nome as nome_empresa, c.perfis
            FROM selecao s
            INNER JOIN concedentes c ON s.id_concedente = c.id
            WHERE s.id = :id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();

    $processo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$processo) {
        echo json_encode(['error' => 'Processo não encontrado']);
        exit;
    }

    // Converter a string de perfis em array
    $processo['perfis'] = explode(',', $processo['perfis']);

    echo json_encode($processo);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar detalhes do processo: ' . $e->getMessage()]);
} 