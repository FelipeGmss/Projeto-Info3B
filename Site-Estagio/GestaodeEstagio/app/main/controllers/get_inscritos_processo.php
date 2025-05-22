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

    $sql = 'SELECT a.nome, a.curso, s.hora, c.perfil, c.nome as nome_empresa
            FROM aluno a
            INNER JOIN selecao s ON a.id = s.id_aluno
            INNER JOIN concedentes c ON s.id_concedente = c.id
            WHERE s.id_concedente = :processo_id
            ORDER BY a.nome';

    $query = $pdo->prepare($sql);
    $query->bindValue(':processo_id', $processoId, PDO::PARAM_INT);
    $query->execute();
    $inscritos = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($inscritos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar inscritos: ' . $e->getMessage()]);
}
?> 