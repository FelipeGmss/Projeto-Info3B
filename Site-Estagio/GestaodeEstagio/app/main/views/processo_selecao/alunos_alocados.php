<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buscar todos os alunos com suas informações de alocação
    $sql = 'SELECT DISTINCT a.id, a.nome, a.curso, c.perfil, c.nome as nome_empresa, c.endereco as endereco_empresa,
            CASE 
                WHEN s.id_aluno IS NOT NULL THEN "alocado"
                ELSE "nao_alocado"
            END as status,
            DATE_FORMAT(s.hora, "%d/%m/%Y") as data_alocacao
            FROM aluno a
            LEFT JOIN selecao s ON a.id = s.id_aluno
            LEFT JOIN concedentes c ON s.id_concedente = c.id
            ORDER BY a.nome';
    
    $query = $pdo->prepare($sql);
    $query->execute();
    $alunos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='text-center text-red-500 p-4'>Erro ao carregar dados: " . $e->getMessage() . "</div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos Alocados - EEEP Salaberga</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .header-moss { background-color: #005A24; }
        .gradient-button {
            background: linear-gradient(135deg, #005A24 0%, #008C45 100%);
        }
        .gradient-button:hover {
            background: linear-gradient(135deg, #004A1D 0%, #007A3D 100%);
        }
        .student-card {
            transition: all 0.3s ease;
        }
        .student-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .status-badge.alocado {
            background-color: #DEF7EC;
            color: #03543F;
        }
        .status-badge.nao-alocado {
            background-color: #FDE8E8;
            color: #9B1C1C;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Cabeçalho -->
    <header class="header-moss w-full shadow-lg mb-8">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <a href="javascript:history.back()" class="text-white hover:text-gray-200">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="h-12">
                    <div>
                        <h1 class="text-xl font-bold text-white">Alunos Alocados</h1>
                        <p class="text-sm text-gray-200">Gerenciamento de Estágios</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="Listar_inscricoes.php" class="gradient-button text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        Listar Inscrições
                    </a>
                    <a href="processoseletivo.php" class="gradient-button text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fas fa-clipboard-list"></i>
                        Processos Seletivos
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if (count($alunos) > 0): ?>
                <?php foreach ($alunos as $aluno): ?>
                    <div class="student-card <?php echo $aluno['status']; ?> bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($aluno['nome']); ?></h2>
                            <?php if ($aluno['status'] === 'alocado'): ?>
                                <span class="status-badge alocado">
                                    <i class="fas fa-check-circle"></i> Alocado
                                </span>
                            <?php else: ?>
                                <span class="status-badge nao-alocado">
                                    <i class="fas fa-times-circle"></i> Não Alocado
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Curso:</strong> <?php echo htmlspecialchars($aluno['curso']); ?></p>
                            
                            <?php if ($aluno['status'] === 'alocado'): ?>
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="font-medium text-gray-800">Informações da Empresa:</p>
                                    <p><strong>Empresa:</strong> <?php echo htmlspecialchars($aluno['nome_empresa']); ?></p>
                                    <p><strong>Perfil:</strong> <?php echo htmlspecialchars($aluno['perfil']); ?></p>
                                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($aluno['endereco_empresa']); ?></p>
                                    <p><strong>Data de Alocação:</strong> <?php echo htmlspecialchars($aluno['data_alocacao']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">Nenhum aluno encontrado.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
