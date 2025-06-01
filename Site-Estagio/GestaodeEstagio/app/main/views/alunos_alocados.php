<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Primeiro, buscar todos os alunos
    $sql = 'SELECT id, nome, curso FROM aluno ORDER BY nome';
    $query = $pdo->prepare($sql);
    $query->execute();
    $alunos = $query->fetchAll(PDO::FETCH_ASSOC);

    // Para cada aluno, verificar o status e o perfil
    foreach ($alunos as &$aluno) {
        // Verificar se está alocado
        $sql_alocado = 'SELECT 1 FROM selecao WHERE id_aluno = ? AND status = "alocado" LIMIT 1';
        $query = $pdo->prepare($sql_alocado);
        $query->execute([$aluno['id']]);
        $alocado = $query->fetch();

        // Verificar se tem inscrição
        $sql_inscricao = 'SELECT 1 FROM selecao WHERE id_aluno = ? LIMIT 1';
        $query = $pdo->prepare($sql_inscricao);
        $query->execute([$aluno['id']]);
        $inscricao = $query->fetch();

        // Definir status
        if ($alocado) {
            $aluno['status_atual'] = 'alocado';
        } elseif ($inscricao) {
            $aluno['status_atual'] = 'pendente';
        } else {
            $aluno['status_atual'] = 'nao_alocado';
        }

        // Buscar perfil da inscrição mais recente
        $sql_perfil = 'SELECT perfis_selecionados FROM selecao WHERE id_aluno = ? ORDER BY id DESC LIMIT 1';
        $query = $pdo->prepare($sql_perfil);
        $query->execute([$aluno['id']]);
        $perfil = $query->fetch(PDO::FETCH_ASSOC);

        if ($perfil && !empty($perfil['perfis_selecionados'])) {
            $perfis = json_decode($perfil['perfis_selecionados'], true);
            $aluno['perfil'] = is_array($perfis) ? implode(", ", $perfis) : '';
        } else {
            $aluno['perfil'] = '';
        }
    }

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

        .header {
            background: #2d4739;
            padding: 0.5rem 0;
        }

        .header * {
            color: #ffffff !important;
        }

        .transparent-button {
            background: none;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
            color: #ffffff;
        }

        .transparent-button:hover {
            color: #FFA500;
            transform: translateY(-1px);
        }

        .main-list-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            padding: 1.5rem;
        }

        .student-card {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .student-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .student-card.alocado {
            border-left-color: #008C45;
        }

        .student-card.pendente {
            border-left-color: #FFA500;
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

        .status-badge.pendente {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-badge.nao-alocado {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .perfil-tag {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background-color: #e5e7eb;
            color: #374151;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            margin: 0.125rem;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Cabeçalho -->
    <header class="header w-full mb-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="javascript:history.back()" class="transparent-button">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <div class="flex flex-col">
                        <span class="text-sm font-medium">EEEP Salaberga</span>
                        <h1 class="text-lg font-bold">Status de Alocação dos Alunos</h1>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="processoseletivo.php" class="transparent-button flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        Processos Seletivos
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="w-10 h-10 object-contain">
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
                <div class="w-3 h-3 rounded-full bg-[#FFA500]"></div>
                <span class="text-sm text-gray-600">Em Espera</span>
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
                        <div class="student-card <?php echo $aluno['status_atual']; ?> bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($aluno['nome']); ?></h2>
                                <?php if ($aluno['status_atual'] === 'alocado'): ?>
                                    <span class="status-badge alocado">
                                        <i class="fas fa-check-circle"></i> Alocado
                                    </span>
                                <?php elseif ($aluno['status_atual'] === 'pendente'): ?>
                                    <span class="status-badge pendente">
                                        <i class="fas fa-clock"></i> Em Espera
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge nao-alocado">
                                        <i class="fas fa-times-circle"></i> Não Alocado
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Curso:</span> <?php echo htmlspecialchars($aluno['curso']); ?>
                                </p>
                                <?php if (!empty($aluno['perfil'])): ?>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Perfil:</span> <?php echo htmlspecialchars($aluno['perfil']); ?>
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
