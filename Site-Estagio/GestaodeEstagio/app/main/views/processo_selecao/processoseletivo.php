<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários de Seleção</title>
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
                        'ceara-moss': '#2d4739', // Verde musgo
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
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .grid {
                display: grid;
                gap: 1rem;
            }
            
            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            
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
            background: #f3f4f6; /* cinza claro */
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
            padding: 2rem 2rem 2rem 2rem;
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
        .grid {
            display: grid;
            gap: 1rem;
        }
        
        @media (min-width: 640px) {
            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        
        @media (min-width: 1024px) {
            .grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .info-box {
            background: #f9fafb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: background-color 0.2s ease;
        }
        
        .info-box:hover {
            background: #f3f4f6;
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
                        <h1 class="text-xl md:text-2xl font-bold mb-0">Formulários de Seleção</h1>
                    </div>
                </div>

                <!-- Search bar - now takes more space -->
                <form action="" method="GET" class="relative flex-1 min-w-[300px]" role="search">
                    <label for="search" class="sr-only">Pesquisar formulários</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           class="w-full px-4 py-2 pl-10 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                           placeholder="Pesquisar local, concedente, aluno..."
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                           aria-label="Pesquisar formulários">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2" aria-hidden="true"></i>
                </form>

                <!-- Right section with action buttons -->
                <div class="flex gap-2 flex-shrink-0">
                    <a href="../processo_selecao/novo_formulario.php" class="bg-gradient-to-r from-ceara-orange to-ceara-green hover:from-ceara-green hover:to-ceara-orange text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        Novo Formulário
                    </a>
                    <a href="../processo_selecao/Listar_inscricoes.php" class="bg-gradient-to-r from-ceara-orange to-ceara-green hover:from-ceara-green hover:to-ceara-orange text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-list" aria-hidden="true"></i>
                        Ver Inscrições
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Fim do cabeçalho -->

    <!-- Lista centralizada -->
    <div class="container mx-auto px-4 py-4 md:py-8 fade-in">
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full table" role="grid">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Concedente</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Local</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        if (!empty($search)) {
                            $sql = 'SELECT s.*, c.nome as nome_concedente FROM selecao s 
                                   INNER JOIN concedentes c ON s.id_concedente = c.id 
                                   WHERE c.nome LIKE :search OR s.local LIKE :search OR s.hora LIKE :search';
                            $query = $pdo->prepare($sql);
                            $query->bindValue(':search', '%' . $search . '%');
                        } else {
                            $sql = 'SELECT s.*, c.nome as nome_concedente FROM selecao s 
                                   INNER JOIN concedentes c ON s.id_concedente = c.id 
                                   ORDER BY c.nome';
                            $query = $pdo->prepare($sql);
                        }
                        $query->execute();
                        $result = $query->rowCount();

                        if ($result > 0) {
                            foreach ($query as $form) {
                                echo "<tr class='hover:bg-gray-100 transition-colors cursor-pointer' role='row'>";
                                echo "<td class='px-4 py-3'>" . htmlspecialchars($form['nome_concedente']) . "</td>";
                                echo "<td class='px-4 py-3'>" . htmlspecialchars($form['local']) . "</td>";
                                echo "<td class='px-4 py-3'>" . htmlspecialchars($form['hora']) . "</td>";
                                echo "<td class='px-4 py-3 flex gap-2 justify-center'>";
                                echo "<form action='../../controllers/Controller-excluir_formulario.php' method='POST' style='display:inline;' onsubmit='return confirm(\\'Tem certeza que deseja excluir este formulário?\\');'>";
                                echo "<input type='hidden' name='id' value='" . $form['id'] . "'>";
                                echo "<button type='submit' name='btn-excluir' class='text-red-600 hover:text-red-800 bg-red-50 rounded-full p-2' title='Excluir'><i class='fas fa-trash'></i></button>";
                                echo "</form>";
                                echo "<form action='../../controllers/controller_inscrever.php' method='POST' style='display:inline;'>";
                                echo "<input type='hidden' name='id_formulario' value='" . $form['id'] . "'>";
                                echo "<button type='submit' class='text-green-600 hover:text-green-800 bg-green-50 rounded-full p-2' title='Inscrever-se'><i class='fas fa-user-plus'></i></button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center text-gray-500 py-4'>Nenhum formulário encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Inscrição -->
    <div id="inscricaoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Inscrição no Processo Seletivo</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="empresaDetails" class="space-y-4">
                <!-- Detalhes da empresa serão preenchidos via JavaScript -->
            </div>

            <form id="inscricaoForm" action="../controllers/controller_inscrever.php" method="POST" class="mt-6">
                <input type="hidden" name="id_formulario" id="modal_form_id">
                <input type="hidden" name="data_inscricao" id="data_inscricao">
                <input type="hidden" name="id_aluno" id="id_aluno">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Aluno:</label>
                    <input type="text" id="nome_aluno" name="nome_aluno" class="w-full px-3 py-2 border rounded" autocomplete="off" placeholder="Digite o nome do aluno">
                    <div id="alunoSuggestions" class="bg-white border rounded shadow mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Perfis Disponíveis:</label>
                    <div id="perfisContainer" class="space-y-2"></div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-ceara-green text-white rounded-lg hover:bg-opacity-90">Confirmar Inscrição</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(formId) {
            const modal = document.getElementById('inscricaoModal');
            const formIdInput = document.getElementById('modal_form_id');
            const dataInscricaoInput = document.getElementById('data_inscricao');
            
            // Set current date and time
            const now = new Date();
            dataInscricaoInput.value = now.toISOString().slice(0, 19).replace('T', ' ');
            
            // Set form ID
            formIdInput.value = formId;
            
            // Fetch company details
            fetch(`get_empresa_details.php?id=${formId}`)
                .then(response => response.json())
                .then(data => {
                    const empresaDetails = document.getElementById('empresaDetails');
                    const perfisContainer = document.getElementById('perfisContainer');
                    
                    // Display company details
                    empresaDetails.innerHTML = `
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nome da Empresa</p>
                                <p class="font-medium">${data.nome}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Contato</p>
                                <p class="font-medium">${data.contato}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Endereço</p>
                                <p class="font-medium">${data.endereco}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Vagas Disponíveis</p>
                                <p class="font-medium">${data.numero_vagas}</p>
                            </div>
                        </div>
                    `;
                    
                    // Create profile checkboxes
                    const perfis = data.perfil.split(',').map(p => p.trim());
                    perfisContainer.innerHTML = perfis.map((perfil, index) => `
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="perfil_${index}" 
                                   name="perfis[]" 
                                   value="${perfil}"
                                   class="h-4 w-4 text-ceara-green focus:ring-ceara-green border-gray-300 rounded">
                            <label for="perfil_${index}" class="ml-2 text-sm text-gray-700">${perfil}</label>
                        </div>
                    `).join('');
                });
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('inscricaoModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Modify the inscription button click handler
        document.querySelectorAll('form[action="controller_inscrever.php"]').forEach(form => {
            form.onsubmit = function(e) {
                e.preventDefault();
                const formId = this.querySelector('input[name="id_formulario"]').value;
                openModal(formId);
            };
        });

        // Busca AJAX de alunos pelo nome
        const nomeAlunoInput = document.getElementById('nome_aluno');
        const alunoSuggestions = document.getElementById('alunoSuggestions');
        const idAlunoInput = document.getElementById('id_aluno');

        nomeAlunoInput.addEventListener('input', function() {
            const nome = this.value.trim();
            if (nome.length < 2) {
                alunoSuggestions.classList.add('hidden');
                return;
            }
            fetch(`buscar_alunos.php?nome=${encodeURIComponent(nome)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        alunoSuggestions.innerHTML = data.map(aluno => 
                            `<div class='p-2 cursor-pointer hover:bg-gray-100' 
                                  data-id='${aluno.id}' 
                                  data-nome='${aluno.nome}'>${aluno.nome}</div>`
                        ).join('');
                        alunoSuggestions.classList.remove('hidden');
                    } else {
                        alunoSuggestions.innerHTML = '<div class="p-2 text-gray-500">Nenhum aluno encontrado</div>';
                        alunoSuggestions.classList.remove('hidden');
                    }
                });
        });

        alunoSuggestions.addEventListener('click', function(e) {
            if (e.target.dataset.id) {
                nomeAlunoInput.value = e.target.dataset.nome;
                idAlunoInput.value = e.target.dataset.id;
                alunoSuggestions.classList.add('hidden');
            }
        });

        // Form submission
        document.getElementById('inscricaoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!idAlunoInput.value) {
                alert('Por favor, selecione um aluno da lista');
                return;
            }

            const formData = new FormData(this);
            
            fetch('../controllers/controller_inscrever.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inscrição realizada com sucesso!');
                    closeModal();
                    window.location.reload();
                } else {
                    alert(data.message || 'Erro ao realizar inscrição');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao realizar inscrição');
            });
        });
    </script>
</body>
</html>