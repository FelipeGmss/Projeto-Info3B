<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se o ID do processo foi fornecido
    if (!isset($_GET['processo_id']) || empty($_GET['processo_id'])) {
        echo json_encode(['error' => 'ID do processo não fornecido.']);
        exit();
    }

    $processoId = $_GET['processo_id'];

    $sql = 'SELECT 
                a.nome, 
                a.curso,
                c.nome as nome_empresa,
                s.hora as data_inscricao
            FROM selecao s
            JOIN aluno a ON s.id_aluno = a.id
            JOIN concedentes c ON s.id_concedente = c.id
            WHERE s.id_concedente = (SELECT id_concedente FROM selecao WHERE id = :processo_id)
            AND s.id_aluno IS NOT NULL
            ORDER BY s.hora DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(':processo_id', $processoId, PDO::PARAM_INT);
    $query->execute();
    $inscritos = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($inscritos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar inscritos: ' . $e->getMessage()]);
}
?> 