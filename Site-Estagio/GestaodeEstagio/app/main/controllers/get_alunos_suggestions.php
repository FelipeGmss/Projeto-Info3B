<?php
header('Content-Type: application/json');

if (!isset($_GET['search'])) {
    echo json_encode(['error' => 'Termo de busca não fornecido']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar alunos que correspondem ao termo de busca
    $sql = 'SELECT id, nome, curso 
            FROM aluno 
            WHERE nome LIKE :search 
            ORDER BY nome 
            LIMIT 10';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $_GET['search'] . '%');
    $stmt->execute();

    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($alunos);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar alunos: ' . $e->getMessage()]);
}
?> 