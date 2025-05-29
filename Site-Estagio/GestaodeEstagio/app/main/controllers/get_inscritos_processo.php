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

    $sql = 'SELECT i.id as id_inscricao, a.id as id_aluno, a.nome, a.curso, s.hora, c.perfil, c.nome as nome_empresa,
            CASE WHEN s.id_aluno IS NOT NULL THEN 1 ELSE 0 END as esta_alocado,
            i.status as status_inscricao
            FROM inscricoes i
            INNER JOIN aluno a ON i.id_aluno = a.id
            INNER JOIN selecao s ON i.id_selecao = s.id
            INNER JOIN concedentes c ON s.id_concedente = c.id
            WHERE i.id_selecao = :processo_id
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