<?php
header('Content-Type: application/json');
if (!isset($_GET['nome'])) { echo json_encode([]); exit; }
$pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
$nome = '%' . $_GET['nome'] . '%';
$stmt = $pdo->prepare('SELECT id, nome FROM aluno WHERE nome LIKE ?');
$stmt->execute([$nome]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)); 