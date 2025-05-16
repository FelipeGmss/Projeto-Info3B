<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Seletivo</title>
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
                        primary: '#008C45',
                        secondary: '#FFA500',
                    }
                }
            }
        }
    </script>
    <style>
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        @media (prefers-contrast: high) {
            :root {
                --text-color: #000;
                --border-color: #000;
            }
        }

        *:focus {
            outline: 3px solid #FFA500;
            outline-offset: 2px;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        @media (max-width: 768px) {
            .mobile-stack {
                display: flex;
                flex-direction: column;
            }
            
            .mobile-full {
                width: 100%;
            }
            
            .mobile-padding {
                padding: 1rem;
            }
            
            .mobile-text-center {
                text-align: center;
            }
            
            .mobile-margin {
                margin-bottom: 1rem;
            }
            
            .mobile-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .mobile-table th,
            .mobile-table td {
                min-width: 120px;
            }
        }

        body {
            font-family: 'Roboto', sans-serif;
        }
        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFFFFF;
            border: 2px solid #008C45;
            border-radius: 12px;
            color: #008C45;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background: #008C45;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .back-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 140, 69, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-ceara-green to-ceara-orange min-h-screen font-['Roboto'] select-none">
    <div class="container mx-auto px-4 py-4 md:py-8 fade-in">
        <!-- Header Section -->
        <header class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 md:p-6 mb-4 md:mb-8">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col sm:flex-row justify-between items-center mobile-text-center">
                    <div>
                        <a href="javascript:history.back()" class="back-button">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Processo Seletivo</h1>
                        <p class="text-gray-600">Gerencie as inscrições dos alunos</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <form action="" method="GET" class="relative w-full md:w-64" role="search">
                        <label for="search" class="sr-only">Pesquisar inscrições</label>
                        <input type="text" 
                               id="search"
                               name="search"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                               placeholder="Pesquisar por nome, curso ou empresa..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               aria-label="Pesquisar inscrições">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                    </form>
                    <a href="../views/relatorio_inscricoes.php<?php echo isset($_GET['search']) && $_GET['search'] != '' ? '?search=' . urlencode($_GET['search']) : ''; ?>" class="w-full md:w-auto bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 hover-scale">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                        Gerar PDF
                    </a>
                    <a href="../views/nova_inscricao.php" class="w-full md:w-auto bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 hover-scale">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        Nova Inscrição
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Inscrições List -->
            <div class="lg:col-span-3">
                <div class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto mobile-table">
                        <table class="min-w-full" role="grid">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php
                                require("../models/cadastros.class.php");
                                $x = new Cadastro();
                                $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                                
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                if (!empty($search)) {
                                    $consulta = 'SELECT i.*, a.nome as aluno_nome, a.curso, e.nome as empresa_nome 
                                               FROM inscricoes i 
                                               JOIN alunos a ON i.aluno_id = a.id 
                                               JOIN concedentes e ON i.empresa_id = e.id 
                                               WHERE a.nome LIKE :search 
                                               OR a.curso LIKE :search 
                                               OR e.nome LIKE :search';
                                    $query = $pdo->prepare($consulta);
                                    $query->bindValue(':search', '%' . $search . '%');
                                } else {
                                    $consulta = 'SELECT i.*, a.nome as aluno_nome, a.curso, e.nome as empresa_nome 
                                               FROM inscricoes i 
                                               JOIN alunos a ON i.aluno_id = a.id 
                                               JOIN concedentes e ON i.empresa_id = e.id';
                                    $query = $pdo->prepare($consulta);
                                }
                                
                                $query->execute();
                                $result = $query->rowCount();

                                if ($result > 0) {
                                    foreach ($query as $value) {
                                        echo "<tr class='table-row hover:bg-gray-50 transition-colors cursor-pointer' role='row'>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showInscricaoDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='flex items-center'>";
                                        echo "<div class='flex-shrink-0 h-8 w-8 md:h-10 md:w-10'>";
                                        echo "<img class='h-8 w-8 md:h-10 md:w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['aluno_nome']) . "' alt='Foto do aluno " . htmlspecialchars($value['aluno_nome']) . "'>";
                                        echo "</div>";
                                        echo "<div class='ml-2 md:ml-4'>";
                                        echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['aluno_nome']) . "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showInscricaoDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['curso']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showInscricaoDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['empresa_nome']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showInscricaoDetails(" . json_encode($value) . ")'>";
                                        $statusClass = '';
                                        switch($value['status']) {
                                            case 'Pendente':
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'Aprovado':
                                                $statusClass = 'bg-green-100 text-green-800';
                                                break;
                                            case 'Reprovado':
                                                $statusClass = 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                $statusClass = 'bg-gray-100 text-gray-800';
                                        }
                                        echo "<span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full " . $statusClass . "'>";
                                        echo htmlspecialchars($value['status']);
                                        echo "</span>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showInscricaoDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . date('d/m/Y', strtotime($value['data_inscricao'])) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium' role='cell'>";
                                        echo "<div class='flex items-center gap-2'>";
                                        echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                                        echo "<input type='hidden' name='btn-editar_inscricao' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar inscrição de " . htmlspecialchars($value['aluno_nome']) . "'>";
                                        echo "<i class='fas fa-edit' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "<form action='../controllers/Controller-excluir_inscricao.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta inscrição?\");'>";
                                        echo "<input type='hidden' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir inscrição de " . htmlspecialchars($value['aluno_nome']) . "'>";
                                        echo "<i class='fas fa-trash' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='px-4 md:px-6 py-3 md:py-4 text-center text-gray-500' role='cell'>Nenhuma inscrição encontrada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Inscrição Details Sidebar -->
            <div class="lg:col-span-1">
                <div id="inscricaoDetails" class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 md:p-6 sticky top-4 md:top-8 hidden" role="complementary" aria-label="Detalhes da inscrição">
                    <div class="flex justify-between items-center mb-4 md:mb-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Detalhes da Inscrição</h2>
                        <button onclick="closeDetails()" class="text-gray-500 hover:text-ceara-orange" aria-label="Fechar detalhes">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        <div class="flex justify-center">
                            <img id="alunoImage" class="h-16 w-16 md:h-24 md:w-24 rounded-full" src="" alt="" role="img">
                        </div>
                        <div>
                            <h3 id="alunoName" class="text-base md:text-lg font-semibold text-gray-800 mb-2"></h3>
                            <p id="alunoCurso" class="text-sm md:text-base text-gray-600"></p>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Empresa</label>
                                <p id="empresaName" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status</label>
                                <p id="inscricaoStatus" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Data da Inscrição</label>
                                <p id="inscricaoData" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showInscricaoDetails(inscricao) {
            const detailsDiv = document.getElementById('inscricaoDetails');
            detailsDiv.classList.remove('hidden');
            
            document.getElementById('alunoImage').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(inscricao.aluno_nome)}`;
            document.getElementById('alunoImage').alt = `Foto do aluno ${inscricao.aluno_nome}`;
            document.getElementById('alunoName').textContent = inscricao.aluno_nome;
            document.getElementById('alunoCurso').textContent = inscricao.curso;
            document.getElementById('empresaName').textContent = inscricao.empresa_nome;
            document.getElementById('inscricaoStatus').textContent = inscricao.status;
            document.getElementById('inscricaoData').textContent = new Date(inscricao.data_inscricao).toLocaleDateString('pt-BR');
        }

        function closeDetails() {
            document.getElementById('inscricaoDetails').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetails();
            }
        });
    </script>
</body>
</html>