<?php
header('Content-Type: application/json');

if (!isset($_GET['empresa_id'])) {
    echo json_encode(['error' => 'ID da empresa não fornecido']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT a.nome, a.curso, s.hora
            FROM selecao s
            INNER JOIN aluno a ON s.id_aluno = a.id
            WHERE s.id_concedente = :empresa_id
            ORDER BY a.nome';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['empresa_id' => $_GET['empresa_id']]);
    
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($alunos);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar alunos: ' . $e->getMessage()]);
}
?> 