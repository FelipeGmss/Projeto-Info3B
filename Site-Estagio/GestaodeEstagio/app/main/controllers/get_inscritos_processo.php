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

    // Primeiro, buscar o id_concedente do processo selecionado
    $sql_concedente = 'SELECT id_concedente FROM selecao WHERE id = :processo_id';
    $query_concedente = $pdo->prepare($sql_concedente);
    $query_concedente->bindValue(':processo_id', $processoId, PDO::PARAM_INT);
    $query_concedente->execute();
    $concedente = $query_concedente->fetch(PDO::FETCH_ASSOC);

    if (!$concedente) {
        echo json_encode(['error' => 'Processo não encontrado.']);
        exit();
    }

    // Agora buscar todos os inscritos deste concedente
    $sql = 'SELECT s.id as id_selecao, a.id as id_aluno, a.nome, a.curso, s.hora, c.perfil, c.nome as nome_empresa, s.status
            FROM selecao s
            INNER JOIN aluno a ON s.id_aluno = a.id
            INNER JOIN concedentes c ON s.id_concedente = c.id
            WHERE s.id_concedente = :id_concedente AND s.id_aluno IS NOT NULL
            ORDER BY s.id DESC';

    $query = $pdo->prepare($sql);
    $query->bindValue(':id_concedente', $concedente['id_concedente'], PDO::PARAM_INT);
    $query->execute();
    $inscritos = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($inscritos);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao buscar inscritos: ' . $e->getMessage()]);
}
?> 