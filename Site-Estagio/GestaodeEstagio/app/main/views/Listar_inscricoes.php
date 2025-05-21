<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscrições</title>
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
                        <h1 class="text-xl md:text-2xl font-bold mb-0">Empresas com Inscrições</h1>
                    </div>
                </div>

                <!-- Search bar -->
                <form action="" method="GET" class="relative w-full md:w-64" role="search">
                    <label for="search" class="sr-only">Pesquisar empresas</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                           placeholder="Pesquisar empresa..."
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                           aria-label="Pesquisar empresas">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-4 md:py-8 fade-in">
        <div class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto mobile-table">
                <table class="min-w-full" role="grid">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                            <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Local</th>
                            <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                            <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                        
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $sql = 'SELECT DISTINCT c.id, c.nome as nome_empresa, s.local, s.hora, 
                               (SELECT COUNT(*) FROM selecao WHERE id_concedente = c.id AND id_aluno IS NOT NULL) as total_inscritos
                               FROM concedentes c 
                               INNER JOIN selecao s ON c.id = s.id_concedente 
                               WHERE s.id_aluno IS NOT NULL';
                        
                        if (!empty($search)) {
                            $sql .= ' AND c.nome LIKE :search';
                        }
                        
                        $sql .= ' GROUP BY c.id, c.nome, s.local, s.hora';
                        $sql .= ' ORDER BY c.nome';
                        
                        $stmt = $pdo->prepare($sql);
                        
                        if (!empty($search)) {
                            $stmt->bindValue(':search', '%' . $search . '%');
                        }
                        
                        $stmt->execute();
                        
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr class='hover:bg-gray-50'>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'>" . htmlspecialchars($row['nome_empresa']) . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'>" . htmlspecialchars($row['local']) . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'>" . htmlspecialchars($row['hora']) . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                echo "<button onclick='showAlunos(" . $row['id'] . ")' class='text-blue-600 hover:text-blue-800 mr-2' title='Ver Alunos'>";
                                echo "<i class='fas fa-users'></i> Ver Alunos (" . $row['total_inscritos'] . ")";
                                echo "</button>";
                                echo "<form action='../controllers/Controller-excluir_formulario.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta inscrição?\");'>";
                                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' name='btn-excluir' class='text-red-600 hover:text-red-800' title='Excluir'><i class='fas fa-trash'></i></button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='px-6 py-4 text-center text-gray-500'>Nenhuma empresa com inscrições encontrada</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Alunos -->
    <div id="alunosModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Alunos Inscritos</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="alunosList" class="space-y-4">
                <!-- Lista de alunos será preenchida via JavaScript -->
            </div>
        </div>
    </div>

    <script>
        function showAlunos(empresaId) {
            const modal = document.getElementById('alunosModal');
            const alunosList = document.getElementById('alunosList');
            
            // Mostrar loading
            alunosList.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-500"></i></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Buscar alunos da empresa
            fetch(`../controllers/get_alunos_empresa.php?empresa_id=${empresaId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alunosList.innerHTML = `<p class="text-center text-red-500">${data.error}</p>`;
                        return;
                    }
                    
                    if (data.length > 0) {
                        alunosList.innerHTML = data.map(aluno => `
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">${aluno.nome}</p>
                                    <p class="text-sm text-gray-500">${aluno.curso}</p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    ${aluno.hora}
                                </div>
                            </div>
                        `).join('');
                    } else {
                        alunosList.innerHTML = '<p class="text-center text-gray-500">Nenhum aluno inscrito</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alunosList.innerHTML = '<p class="text-center text-red-500">Erro ao carregar alunos</p>';
                });
        }

        function closeModal() {
            const modal = document.getElementById('alunosModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>
