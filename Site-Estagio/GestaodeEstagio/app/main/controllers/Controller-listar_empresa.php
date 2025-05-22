<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados das Empresas</title>
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
        /* Melhorias de Acessibilidade */
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

        /* Estilos para foco visível */
        *:focus {
            outline: 3px solid #FFA500;
            outline-offset: 2px;
        }

        /* Melhor contraste para leitores de tela */
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

        /* Ajustes para mobile */
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
            
            .mobile-hidden {
                display: none;
            }
            
            .mobile-visible {
                display: block;
            }
        }

        /* Estilos do EEEP Salaberga */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
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
        .accessibility-btn {
            transition: all 0.3s ease;
        }
        .accessibility-btn:hover {
            color: #FFA500;
        }
        .table-row:hover {
            background-color: rgba(255, 165, 0, 0.1);
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
            backdrop-filter: blur(4px);
        }
        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .back-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }

        .school-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .school-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .header-moss {
            background: #2d4739;
        }
        .header-moss * {
            color: #fff !important;
        }
        .header-moss input,
        .header-moss input:focus {
            color: #222 !important;
            background: #fff !important;
        }
        .header-moss .fa-search {
            color: #888 !important;
        }

        .main-list-container {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            margin: 0 auto;
            max-width: 1200px;
            padding: 2rem;
        }

        .table th, .table td {
            white-space: normal !important;
        }

        @media (max-width: 900px) {
            .main-list-container {
                padding: 1rem;
            }
        }
        @media (max-width: 600px) {
            .main-list-container {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen font-['Roboto'] select-none">
    <!-- Cabeçalho verde musgo -->
    <header class="header-moss w-full shadow-lg mb-8">
        <div class="container mx-auto px-4 py-4">
            <!-- Main header content -->
            <div class="flex flex-col md:flex-row md:items-center gap-3">
                <!-- Left section with back button, logo and school name -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <a href="javascript:history.back()" class="back-button">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="school-logo">
                    <div class="flex flex-col">
                        <span class="school-name">EEEP Salaberga</span>
                        <h1 class="text-xl md:text-2xl font-bold mb-0">Dados das Empresas</h1>
                    </div>
                </div>

                <!-- Search bar - now takes more space -->
                <form action="" method="GET" class="relative flex-1 min-w-[300px]" role="search">
                    <label for="search" class="sr-only">Pesquisar empresas</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           class="w-full px-4 py-2 pl-10 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                           placeholder="Pesquisar empresas..."
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                           aria-label="Pesquisar empresas">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2" aria-hidden="true"></i>
                </form>

                <!-- Right section with action buttons -->
                <div class="flex gap-2 flex-shrink-0">
                    <a href="../views/relatorio.php<?php echo isset($_GET['search']) && $_GET['search'] != '' ? '?search=' . urlencode($_GET['search']) : ''; ?>" class="bg-gradient-to-r from-ceara-orange to-ceara-green hover:from-ceara-green hover:to-ceara-orange text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                        Gerar PDF
                    </a>
                    <a href="../views/cadastrodaempresa.php" class="bg-gradient-to-r from-ceara-orange to-ceara-green hover:from-ceara-green hover:to-ceara-orange text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        Nova Empresa
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Lista centralizada -->
    <div class="main-list-container mt-4 mb-8">
        <div class="overflow-x-auto">
            <table class="min-w-full table" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Endereço</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perfil</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vagas</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    require("../models/model-function.php");
                    $x = new Cadastro();
                    $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                    
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    if (!empty($search)) {
                        $consulta = 'SELECT * FROM concedentes WHERE nome LIKE :search OR contato LIKE :search OR endereco LIKE :search OR perfil LIKE :search';
                        $query = $pdo->prepare($consulta);
                        $query->bindValue(':search', '%' . $search . '%');
                    } else {
                        $consulta = 'SELECT * FROM concedentes';
                        $query = $pdo->prepare($consulta);
                    }
                    
                    $query->execute();
                    $result = $query->rowCount();

                    if ($result > 0) {
                        foreach ($query as $value) {
                            echo "<tr class='table-row hover:bg-gray-50 transition-colors cursor-pointer' role='row'>";
                            echo "<td class='px-4 py-3 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<div class='flex items-center'>";
                            echo "<div class='flex-shrink-0 h-8 w-8 md:h-10 md:w-10'>";
                            echo "<img class='h-8 w-8 md:h-10 md:w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Logo da empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "</div>";
                            echo "<div class='ml-2 md:ml-4'>";
                            echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['nome']) . "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['contato']) . "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['endereco']) . "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['perfil']) . "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['numero_vagas']) . "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 whitespace-nowrap text-sm font-medium' role='cell'>";
                            echo "<div class='flex items-center justify-center gap-2'>";
                            echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                            echo "<input type='hidden' name='btn-editar_empresa' value='" . htmlspecialchars($value['id']) . "'>";
                            echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "<i class='fas fa-edit' aria-hidden='true'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "<form action='../controllers/Controller-excluir_empresa.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>";
                            echo "<input type='hidden' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "'>";
                            echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "<i class='fas fa-trash' aria-hidden='true'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='px-4 py-3 text-center text-gray-500' role='cell'>Nenhuma empresa cadastrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="companyDetails" class="fixed inset-0 bg-black bg-opacity-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="min-h-screen px-4 text-center">
            <div class="fixed inset-0" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>
            <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modalTitle">Detalhes da Empresa</h3>
                    <button onclick="closeDetails()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mt-2">
                    <div class="flex justify-center mb-4">
                        <img id="companyImage" class="h-24 w-24 rounded-full" src="" alt="">
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h4 id="companyName" class="text-xl font-semibold text-gray-900 text-center"></h4>
                            <p id="companyProfile" class="mt-1 text-sm text-gray-500 text-center"></p>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Contato</dt>
                                    <dd id="companyContact" class="mt-1 text-sm text-gray-900"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Endereço</dt>
                                    <dd id="companyAddress" class="mt-1 text-sm text-gray-900"></dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Vagas Ativas</dt>
                                    <dd id="companyVacancies" class="mt-1 text-sm text-gray-900"></dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCompanyDetails(company) {
            const modal = document.getElementById('companyDetails');
            modal.classList.remove('hidden');
            
            document.getElementById('companyImage').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(company.nome)}`;
            document.getElementById('companyImage').alt = `Logo da empresa ${company.nome}`;
            document.getElementById('companyName').textContent = company.nome;
            document.getElementById('companyProfile').textContent = company.perfil;
            document.getElementById('companyContact').textContent = company.contato;
            document.getElementById('companyAddress').textContent = company.endereco;
            document.getElementById('companyVacancies').textContent = company.numero_vagas;
        }

        function closeDetails() {
            document.getElementById('companyDetails').classList.add('hidden');
        }

        // Adiciona suporte a teclado para navegação
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetails();
            }
        });

        // Fecha o modal ao clicar fora dele
        document.getElementById('companyDetails').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetails();
            }
        });
    </script>
</body>
</html>