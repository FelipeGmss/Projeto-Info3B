<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Seletivo - Aluno</title>
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

        /* Melhorias de Foco e Navegação */
        *:focus-visible {
            outline: 3px solid #FFA500;
            outline-offset: 2px;
            border-radius: 4px;
        }

        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #008C45;
            color: white;
            padding: 8px;
            z-index: 100;
            transition: top 0.2s;
        }

        .skip-link:focus {
            top: 0;
        }

        /* Layout Base */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
            line-height: 1.5;
            color: #1f2937;
        }

        .container {
            width: min(1400px, 95%);
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Styles */
        .header-moss {
            background: #2d4739;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-content {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 1rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .header-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
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
        }

        /* Botão Voltar */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .back-button:hover,
        .back-button:focus-visible {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Barra de Pesquisa */
        .search-container {
            width: min(400px, 100%);
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background: #fff;
            font-size: 1rem;
            transition: all 0.2s;
            color: #1f2937;
        }

        .search-input:focus-visible {
            border-color: #008C45;
            box-shadow: 0 0 0 3px rgba(0, 140, 69, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
        }

        /* Tabela Responsiva */
        .table-container {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin: 2rem auto;
            overflow: hidden;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #f8fafc;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
            color: #1f2937;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover td {
            background: #f8fafc;
        }

        /* Botões de Ação */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            white-space: nowrap;
        }

        .action-button.inscrever {
            background: #008C45;
            color: white;
        }

        .action-button.inscrever:hover,
        .action-button.inscrever:focus-visible {
            background: #006b35;
            transform: translateY(-1px);
        }

        .action-button.ver-inscritos {
            background: #f0f9ff;
            color: #0369a1;
        }

        .action-button.ver-inscritos:hover,
        .action-button.ver-inscritos:focus-visible {
            background: #e0f2fe;
            transform: translateY(-1px);
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .table-container {
                margin: 1rem auto;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                gap: 0.75rem;
            }

            .school-brand {
                justify-content: center;
            }

            .table th,
            .table td {
                padding: 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .action-button {
                width: 100%;
                justify-content: center;
            }
        }

        /* Mensagem de Estado Vazio */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #94a3b8;
        }

        /* Melhorias de Acessibilidade para Leitores de Tela */
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

        [role="button"],
        button {
            cursor: pointer;
        }

        /* Melhorias de Performance */
        .will-change-transform {
            will-change: transform;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Skip Link para Acessibilidade -->
    <a href="#main-content" class="skip-link">Pular para o conteúdo principal</a>

    <!-- Cabeçalho verde musgo -->
    <header class="header-moss" role="banner">
        <div class="container">
            <div class="header-content">
                <div class="school-brand">
                    <a href="javascript:history.back()" class="back-button" aria-label="Voltar para a página anterior">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <span>Voltar</span>
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" 
                         alt="Logo EEEP Salaberga" 
                         class="school-logo"
                         width="40"
                         height="40">
                    <div>
                        <span class="school-name">EEEP Salaberga</span>
                        <h1 class="text-xl font-bold text-white mt-1">Processo Seletivo</h1>
                    </div>
                </div>

                <div class="search-container">
                    <form action="" method="GET" class="relative" role="search">
                        <label for="search" class="sr-only">Pesquisar processos seletivos</label>
                        <input type="text" 
                               id="search"
                               name="search"
                               class="search-input"
                               placeholder="Pesquisar local ou empresa..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               aria-label="Pesquisar processos seletivos">
                        <i class="fas fa-search search-icon" aria-hidden="true"></i>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main id="main-content" class="container py-6" role="main">
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table" role="grid" aria-label="Lista de processos seletivos">
                    <thead>
                        <tr>
                            <th scope="col">Hora</th>
                            <th scope="col">Local</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        
                        $sql = 'SELECT s.*, c.nome as nome_empresa 
                               FROM selecao s 
                               LEFT JOIN concedentes c ON s.id_concedente = c.id';
                        
                        if (!empty($search)) {
                            $sql .= ' WHERE (s.local LIKE :search OR c.nome LIKE :search)';
                        }
                        
                        $query = $pdo->prepare($sql);
                        
                        if (!empty($search)) {
                            $query->bindValue(':search', '%' . $search . '%');
                        }
                        
                        $query->execute();
                        $result = $query->rowCount();

                        if ($result > 0) {
                            foreach ($query as $form) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($form['hora']) . "</td>";
                                echo "<td>" . htmlspecialchars($form['local']) . "</td>";
                                echo "<td>" . htmlspecialchars($form['nome_empresa']) . "</td>";
                                echo "<td>";
                                echo "<div class='action-buttons'>";
                                // Botão Inscrever-se
                                echo "<button onclick='showInscricaoModal(" . $form['id'] . ")' 
                                          class='action-button inscrever' 
                                          title='Inscrever-se no processo seletivo'
                                          aria-label='Inscrever-se no processo seletivo'>";
                                echo "<i class='fas fa-user-plus' aria-hidden='true'></i> Inscrever-se";
                                echo "</button>";
                                
                                // Botão Ver Inscritos
                                echo "<button onclick='showInscritosModal(" . $form['id'] . ")' 
                                          class='action-button ver-inscritos' 
                                          title='Ver lista de inscritos'
                                          aria-label='Ver lista de inscritos'>";
                                echo "<i class='fas fa-users' aria-hidden='true'></i> Ver Inscritos";
                                echo "</button>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='empty-state'>";
                            echo "<i class='fas fa-clipboard-list' aria-hidden='true'></i>";
                            echo "<p>Nenhum processo seletivo disponível no momento.</p>";
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal de Inscrição -->
    <div id="inscricaoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Inscrição no Processo Seletivo</h3>
                <button onclick="closeModal('inscricaoModal')" class="text-gray-500 hover:text-gray-700">
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
                    <input type="text" 
                           id="nome_aluno" 
                           name="nome_aluno" 
                           class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-ceara-orange focus:border-transparent" 
                           autocomplete="off" 
                           placeholder="Digite o nome do aluno">
                    <div id="alunoSuggestions" class="bg-white border rounded-lg shadow mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Perfis Disponíveis:</label>
                    <div id="perfisContainer" class="space-y-2"></div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="closeModal('inscricaoModal')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-ceara-green text-white rounded-lg hover:bg-opacity-90">Confirmar Inscrição</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Lista de Inscritos -->
    <div id="inscritosListaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Alunos Inscritos</h3>
                <button onclick="closeModal('inscritosListaModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="inscritosList" class="space-y-4">
                <!-- Lista de alunos inscritos será preenchida via JavaScript -->
            </div>
        </div>
    </div>

    <script>
        function showInscricaoModal(formId) {
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

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

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
                    closeModal('inscricaoModal');
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

        function showInscritosModal(processoId) {
            const modal = document.getElementById('inscritosListaModal');
            const inscritosList = document.getElementById('inscritosList');
            
            // Mostrar loading
            inscritosList.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-500"></i></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Buscar alunos inscritos neste processo específico
            fetch(`../controllers/get_inscritos_processo.php?processo_id=${processoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        inscritosList.innerHTML = `<p class="text-center text-red-500">${data.error}</p>`;
                        return;
                    }
                    
                    if (data.length > 0) {
                        const nomeEmpresa = data[0].nome_empresa;
                        inscritosList.innerHTML = `
                            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                <p class="text-lg font-semibold text-gray-800">Empresa: ${nomeEmpresa}</p>
                                <p class="text-sm text-gray-600">Total de Inscritos: ${data.length}</p>
                            </div>
                            <div class="space-y-3">
                                ${data.map((aluno, index) => `
                                    <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div>
                                            <p class="font-medium text-gray-900">${aluno.nome}</p>
                                            <p class="text-sm text-gray-500">${aluno.curso}</p>
                                        </div>
                                        <div class="text-sm text-gray-500 text-right">
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                                Inscrito
                                            </span>
                                            <p class="text-xs text-gray-400 mt-2">Data da Inscrição: ${aluno.data_inscricao}</p>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        `;
                    } else {
                        inscritosList.innerHTML = '<p class="text-center text-gray-500">Nenhum aluno inscrito nesta empresa ainda.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    inscritosList.innerHTML = '<p class="text-center text-red-500">Erro ao carregar inscritos.</p>';
                });
        }
    </script>
</body>
</html>