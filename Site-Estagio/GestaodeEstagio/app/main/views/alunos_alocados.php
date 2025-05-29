<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buscar todos os alunos com seus status de alocação usando apenas as tabelas existentes
    $sql = 'SELECT DISTINCT a.id, a.nome, c.perfil, c.nome as nome_empresa,
            CASE 
                WHEN s.id_aluno IS NOT NULL THEN "alocado"
                ELSE "nao_alocado"
            END as status
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
    <title>Status de Alocação dos Alunos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ceara-green': '#008C45',
                        'ceara-orange': '#FFA500',
                        'ceara-white': '#FFFFFF',
                        'ceara-moss': '#2d4739',
                        primary: '#008C45',
                        secondary: '#FFA500',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
        }

        .header-moss {
            background: #2d4739;
        }
        .header-moss * {
            color: #fff !important;
        }

        .main-list-container {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            margin: 0 auto;
            max-width: 1200px;
            padding: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #FFFFFF;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .student-card {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }
        .student-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .student-card.alocado {
            border-left-color: #008C45;
        }
        .student-card.nao-alocado {
            border-left-color: #DC2626;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-badge.alocado {
            background-color: #D1FAE5;
            color: #065F46;
        }
        .status-badge.nao-alocado {
            background-color: #FEE2E2;
            color: #991B1B;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Cabeçalho -->
    <header class="header-moss w-full shadow-lg mb-8">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row md:items-center gap-3">
                <div class="flex items-center gap-3">
                    <a href="javascript:history.back()" class="back-button">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <h1 class="text-xl md:text-2xl font-bold mb-0">Status de Alocação dos Alunos</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Legenda -->
    <div class="container mx-auto px-4 mb-6">
        <div class="flex flex-wrap gap-4 justify-center">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-[#008C45]"></div>
                <span class="text-sm text-gray-600">Alocado</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-[#DC2626]"></div>
                <span class="text-sm text-gray-600">Não Alocado</span>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-4 py-4">
        <div class="main-list-container">
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
                            <div class="space-y-1">
                                <?php if ($aluno['perfil']): ?>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Perfil:</span> <?php echo htmlspecialchars($aluno['perfil']); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($aluno['nome_empresa']): ?>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Empresa:</span> <?php echo htmlspecialchars($aluno['nome_empresa']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center text-gray-500 py-8">Nenhum aluno encontrado.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
