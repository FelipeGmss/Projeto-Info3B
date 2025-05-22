<?php
header('Content-Type: application/json');

if (!isset($_GET['empresa_id'])) {
    echo json_encode(['error' => 'ID da empresa não fornecido']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $empresa_id = $_GET['empresa_id'];

    // Modificada para incluir o perfil do concedente
    $sql = 'SELECT a.nome, a.curso, s.hora, c.perfil
            FROM aluno a
            INNER JOIN selecao s ON a.id = s.id_aluno
            INNER JOIN concedentes c ON s.id_concedente = c.id
            WHERE s.id_concedente = :empresa_id
            ORDER BY a.nome';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':empresa_id', $empresa_id, PDO::PARAM_INT);
    $stmt->execute();

    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($alunos);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar alunos: ' . $e->getMessage()]);
}
?> 