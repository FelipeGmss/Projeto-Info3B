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
                        'ceara-moss': '#2d4739',
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

        .search-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            margin: 0.75rem 0;
        }

        .search-input {
            background: #ffffff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.3);
        }

        .table-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-header {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        .action-button {
            padding: 0.4rem;
            border-radius: 0.4rem;
            transition: all 0.2s ease;
            border: none;
            background: none;
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .card {
            display: none;
        }

        @media (max-width: 768px) {
            .table-container {
                display: none;
            }

            .card {
                display: block;
                background: white;
                border-radius: 0.75rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                margin-bottom: 1rem;
                padding: 1rem;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .card-content {
                padding: 0.5rem;
            }

            .card-actions {
                display: flex;
                justify-content: flex-end;
                gap: 0.5rem;
                margin-top: 0.75rem;
            }
        }
    </style>
</head>
<body class="min-h-screen font-['Roboto'] select-none">
    <!-- Cabeçalho -->
    <header class="header w-full mb-4">
        <div class="container mx-auto px-4">
            <!-- Main header content -->
            <div class="flex items-center justify-between">
                <!-- Left section with back button, logo and school name -->
                <div class="flex items-center gap-3">
                    <a href="javascript:history.back()" class="transparent-button">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="w-10 h-10 object-contain">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium">EEEP Salaberga</span>
                        <h1 class="text-lg font-bold">Dados das Empresas</h1>
                    </div>
                </div>

                <!-- Right section with action buttons -->
                <div class="flex gap-2">
                    <a href="../views/relatorios/relatorio.php" class="transparent-button">
                        <i class="fas fa-file-pdf"></i> Gerar PDF
                    </a>
                    <a href="../views/cadastrodaempresa.php" class="transparent-button">
                        <i class="fas fa-plus"></i> Nova Empresa
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="container mx-auto px-4">
        <div class="search-container">
            <form action="" method="GET" class="relative" role="search">
                <label for="search" class="sr-only">Pesquisar empresas</label>
                <input type="text" 
                       id="search"
                       name="search"
                       class="search-input"
                       placeholder="Pesquisar por nome, contato, endereço..."
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                       aria-label="Pesquisar empresas">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-4">
        <?php
        // Mensagens de resultado
        if(isset($_GET['resultado'])) {
            $mensagem = '';
            $tipo = '';
            
            switch($_GET['resultado']) {
                case 'excluir':
                    $mensagem = 'Empresa excluída com sucesso!';
                    $tipo = 'success';
                    break;
                case 'erro':
                    $mensagem = 'Ocorreu um erro ao processar a operação.';
                    $tipo = 'error';
                    break;
                case 'erro_fk':
                    $mensagem = 'Não foi possível excluir a empresa pois existem registros vinculados a ela.';
                    $tipo = 'error';
                    break;
                case 'editar':
                    $mensagem = 'Empresa atualizada com sucesso!';
                    $tipo = 'success';
                    break;
            }
            
            if($mensagem) {
                $bgColor = $tipo === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
                echo "<div class='mb-4 p-4 rounded-lg border {$bgColor}'>";
                echo htmlspecialchars($mensagem);
                echo "</div>";
            }
        }
        ?>
        
        <!-- Table View (Desktop) -->
        <div class="table-container">
            <table class="min-w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Endereço</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Perfil</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Vagas</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
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
                            echo "<tr class='table-row cursor-pointer hover:bg-gray-50' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                            echo "<td class='px-4 py-3'>";
                            echo "<div class='flex items-center'>";
                            echo "<div class='flex-shrink-0 h-8 w-8'>";
                            echo "<img class='h-8 w-8 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Logo da empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "</div>";
                            echo "<div class='ml-3'>";
                            echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['nome']) . "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['contato']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['endereco']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>";
                            $perfis = json_decode($value['perfis'], true);
                            if (is_array($perfis)) {
                                echo implode(', ', array_map('htmlspecialchars', $perfis));
                            } else {
                                echo htmlspecialchars($value['perfis']);
                            }
                            echo "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['numero_vagas']) . "</td>";
                            echo "<td class='px-4 py-3 text-center' onclick='event.stopPropagation();'>";
                            echo "<div class='flex justify-center gap-2'>";
                            echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                            echo "<input type='hidden' name='btn-editar_empresa' value='" . htmlspecialchars($value['id']) . "'>";
                            echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "<i class='fas fa-edit'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "<form action='../controllers/Controller-excluir_empresa.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>";
                            echo "<input type='hidden' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "'>";
                            echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir empresa " . htmlspecialchars($value['nome']) . "'>";
                            echo "<i class='fas fa-trash'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='px-4 py-3 text-center text-gray-500'>Nenhuma empresa cadastrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Card View (Mobile) -->
        <div class="md:hidden">
            <?php
            if ($result > 0) {
                foreach ($query as $value) {
                    echo "<div class='card'>";
                    echo "<div class='card-content'>";
                    echo "<div class='flex items-center gap-3 mb-2'>";
                    echo "<img class='h-10 w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Logo da empresa " . htmlspecialchars($value['nome']) . "'>";
                    echo "<div>";
                    echo "<p class='text-lg font-semibold text-gray-800'>" . htmlspecialchars($value['nome']) . "</p>";
                    echo "<p class='text-sm text-gray-600'>";
                    $perfis = json_decode($value['perfis'], true);
                    if (is_array($perfis)) {
                        echo implode(', ', array_map('htmlspecialchars', $perfis));
                    } else {
                        echo htmlspecialchars($value['perfis']);
                    }
                    echo "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-phone mr-2'></i>" . htmlspecialchars($value['contato']) . "</p>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-map-marker-alt mr-2'></i>" . htmlspecialchars($value['endereco']) . "</p>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-users mr-2'></i>" . htmlspecialchars($value['numero_vagas']) . " vagas</p>";
                    echo "</div>";
                    echo "<div class='card-actions'>";
                    echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                    echo "<input type='hidden' name='btn-editar_empresa' value='" . htmlspecialchars($value['id']) . "'>";
                    echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar empresa " . htmlspecialchars($value['nome']) . "'>";
                    echo "<i class='fas fa-edit'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "<form action='../controllers/Controller-excluir_empresa.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>";
                    echo "<input type='hidden' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "'>";
                    echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir empresa " . htmlspecialchars($value['nome']) . "'>";
                    echo "<i class='fas fa-trash'></i>";
                    echo "</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='card'><div class='card-content'><p class='text-center text-gray-500'>Nenhuma empresa cadastrada</p></div></div>";
            }
            ?>
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
            document.getElementById('companyProfile').textContent = Array.isArray(JSON.parse(company.perfis)) ? 
                JSON.parse(company.perfis).join(', ') : company.perfis;
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