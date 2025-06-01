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

        .modal-button {
            background: none;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.4rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .modal-button.cancel {
            color: #6B7280;
        }

        .modal-button.cancel:hover {
            background: #F3F4F6;
        }

        .modal-button.submit {
            background: linear-gradient(to right, #FFA500, #008C45);
            color: white;
        }

        .modal-button.submit:hover {
            opacity: 0.9;
            transform: translateY(-1px);
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
                        <h1 class="text-lg font-bold">Formulários de Seleção</h1>
                    </div>
                </div>

                <!-- Right section with action buttons -->
                <div class="flex gap-2">
                    <a href="novo_formulario.php" class="transparent-button flex items-center gap-1">
                        <i class="fas fa-plus"></i>
                        Novo
                    </a>
                    <a href="alunos_alocados.php" class="transparent-button flex items-center gap-1">
                        <i class="fas fa-user-graduate"></i>
                        Alunos Alocados
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="container mx-auto px-4">
        <div class="search-container">
            <form action="" method="GET" class="relative" role="search">
                <label for="search" class="sr-only">Pesquisar formulários</label>
                <input type="text" 
                       id="search"
                       name="search"
                       class="search-input"
                       placeholder="Pesquisar local, concedente, aluno..."
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                       aria-label="Pesquisar formulários">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
            </form>
        </div>
    </div>

    <!-- Lista centralizada -->
    <div class="container mx-auto px-4 py-4">
        <!-- Table View (Desktop) -->
        <div class="table-container">
            <table class="min-w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Concedente</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Local</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Inscritos</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    if (!empty($search)) {
                        $sql = 'SELECT DISTINCT c.id as id_concedente, c.nome as nome_concedente,
                               s.local, s.hora,
                               (SELECT COUNT(*) FROM selecao WHERE id_concedente = c.id AND id_aluno IS NOT NULL) as total_inscritos,
                               (SELECT MIN(id) FROM selecao WHERE id_concedente = c.id) as primeiro_id
                               FROM selecao s 
                               INNER JOIN concedentes c ON s.id_concedente = c.id 
                               WHERE c.nome LIKE :search OR s.local LIKE :search OR s.hora LIKE :search
                               GROUP BY c.id, c.nome, s.local, s.hora';
                        $query = $pdo->prepare($sql);
                        $query->bindValue(':search', '%' . $search . '%');
                    } else {
                        $sql = 'SELECT DISTINCT c.id as id_concedente, c.nome as nome_concedente,
                               s.local, s.hora,
                               (SELECT COUNT(*) FROM selecao WHERE id_concedente = c.id AND id_aluno IS NOT NULL) as total_inscritos,
                               (SELECT MIN(id) FROM selecao WHERE id_concedente = c.id) as primeiro_id
                               FROM selecao s 
                               INNER JOIN concedentes c ON s.id_concedente = c.id 
                               GROUP BY c.id, c.nome, s.local, s.hora
                               ORDER BY c.nome';
                        $query = $pdo->prepare($sql);
                    }
                    $query->execute();
                    $result = $query->rowCount();

                    if ($result > 0) {
                        foreach ($query as $form) {
                            echo "<tr class='table-row'>";
                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($form['nome_concedente']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($form['local']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($form['hora']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-center'>" . $form['total_inscritos'] . "</td>";
                            echo "<td class='px-4 py-3 text-center'>";
                            echo "<div class='flex justify-center gap-2'>";
                                // Botão Inscrever-se
                                echo "<button onclick='showInscricaoModal(" . $form['primeiro_id'] . ")' 
                                      class='text-green-600 hover:text-green-800 bg-green-50 rounded-full p-2 transition-colors' 
                                      title='Inscrever aluno no processo seletivo'
                                      aria-label='Inscrever aluno'>";
                                echo "<i class='fas fa-user-plus'></i>";
                                echo "</button>";
                                
                                // Botão Ver Inscritos
                                echo "<button onclick='showInscritosModal(" . $form['primeiro_id'] . ")' 
                                      class='text-blue-600 hover:text-blue-800 bg-blue-50 rounded-full p-2 transition-colors' 
                                      title='Ver alunos inscritos'
                                      aria-label='Ver inscritos'>";
                                echo "<i class='fas fa-users'></i>";
                                echo "</button>";
                                
                                // Botão Excluir Formulário
                                echo "<button onclick='excluirFormulario(" . $form['primeiro_id'] . ")' 
                                      class='text-red-600 hover:text-red-800 bg-red-50 rounded-full p-2 transition-colors' 
                                      title='Excluir formulário'
                                      aria-label='Excluir formulário'>";
                                echo "<i class='fas fa-trash'></i>";
                                echo "</button>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center text-gray-500 py-4'>Nenhum formulário encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Card View (Mobile) -->
        <div class="md:hidden">
            <?php
            if ($result > 0) {
                foreach ($query as $form) {
                    echo '<div class="card">';
                    echo '<div class="card-content">';
                    echo '<h3 class="text-base font-semibold text-gray-800 mb-2">' . htmlspecialchars($form['nome_concedente']) . '</h3>';
                    echo '<div class="space-y-1">';
                    echo '<p class="text-sm text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i>' . htmlspecialchars($form['local']) . '</p>';
                    echo '<p class="text-sm text-gray-600"><i class="fas fa-clock mr-2"></i>' . htmlspecialchars($form['hora']) . '</p>';
                    echo '<p class="text-sm text-gray-600"><i class="fas fa-users mr-2"></i>' . $form['total_inscritos'] . ' inscritos</p>';
                    echo '</div>';
                    echo '<div class="card-actions">';
                    echo '<button onclick="showInscricaoModal(' . $form['primeiro_id'] . ')" 
                          class="action-button text-green-600 hover:text-green-800 bg-green-50" 
                          title="Inscrever aluno no processo seletivo"
                          aria-label="Inscrever aluno">';
                    echo '<i class="fas fa-user-plus"></i>';
                    echo '</button>';
                    echo '<button onclick="showInscritosModal(' . $form['primeiro_id'] . ')" 
                          class="action-button text-blue-600 hover:text-blue-800 bg-blue-50" 
                          title="Ver alunos inscritos"
                          aria-label="Ver inscritos">';
                    echo '<i class="fas fa-users"></i>';
                    echo '</button>';
                    echo '<button onclick="excluirFormulario(' . $form['primeiro_id'] . ')" 
                          class="action-button text-red-600 hover:text-red-800 bg-red-50" 
                          title="Excluir formulário"
                          aria-label="Excluir formulário">';
                    echo '<i class="fas fa-trash"></i>';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="text-center text-gray-500 py-4">Nenhum formulário encontrado.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Modal de Inscritos -->
    <div id="inscritosModal" class="fixed inset-0 bg-black bg-opacity-50 modal hidden items-center justify-center z-50">
        <div class="modal-content p-6 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto bg-white rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Alunos Inscritos</h3>
                <button onclick="closeModal('inscritosModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="inscritosList" class="space-y-4">
                <!-- Lista de alunos inscritos será preenchida via JavaScript -->
            </div>
        </div>
    </div>

    <!-- Modal de Inscrição -->
    <div id="inscricaoModal" class="fixed inset-0 bg-black bg-opacity-50 modal hidden items-center justify-center z-50">
        <div class="modal-content p-6 max-w-2xl w-full mx-4 bg-white rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Nova Inscrição</h3>
                <button onclick="closeModal('inscricaoModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="inscricaoForm" class="space-y-4">
                <input type="hidden" id="modal_form_id" name="id_formulario">
                <input type="hidden" id="id_aluno" name="id_aluno">
                
                <div id="empresaDetails" class="bg-gray-50 p-4 rounded-lg mb-4">
                    <!-- Detalhes da empresa serão preenchidos via JavaScript -->
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="nome_aluno" class="block text-sm font-medium text-gray-700 mb-1">Nome do Aluno</label>
                        <div class="relative">
                            <input type="text" 
                                   id="nome_aluno" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-ceara-green focus:border-transparent"
                                   placeholder="Digite o nome do aluno"
                                   autocomplete="off">
                            <div id="alunoSuggestions" class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto"></div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Perfis Disponíveis</label>
                        <div id="perfisContainer" class="space-y-2 bg-gray-50 p-4 rounded-lg">
                            <!-- Checkboxes dos perfis serão preenchidos via JavaScript -->
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('inscricaoModal')" class="modal-button cancel">
                        Cancelar
                    </button>
                    <button type="submit" class="modal-button submit">
                        Confirmar Inscrição
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showInscritosModal(processoId) {
            const modal = document.getElementById('inscritosModal');
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
                                        <div class="flex items-center gap-3">
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold ${
                                                aluno.status === 'alocado' 
                                                    ? 'bg-green-100 text-green-800' 
                                                    : 'bg-yellow-100 text-yellow-800'
                                            }">
                                                ${aluno.status === 'alocado' ? 'Alocado' : 'Em Espera'}
                                            </span>
                                            ${aluno.status === 'pendente' ? `
                                                <button onclick="alocarAluno(${aluno.id_selecao}, ${processoId}, ${aluno.id_aluno})" 
                                                        class="text-green-600 hover:text-green-800 bg-green-50 rounded-full p-2 transition-colors"
                                                        title="Alocar aluno na empresa">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            ` : ''}
                                            <button onclick="excluirInscrito(${aluno.id_selecao}, ${processoId})" 
                                                    class="text-red-600 hover:text-red-800 bg-red-50 rounded-full p-2 transition-colors"
                                                    title="Excluir inscrição">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

        function excluirInscrito(idSelecao, processoId) {
            if (!confirm('Tem certeza que deseja excluir esta inscrição?')) {
                return;
            }

            const formData = new FormData();
            formData.append('id_selecao', idSelecao);

            fetch('../controllers/controller_excluir_inscrito.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inscrição removida com sucesso!');
                    showInscritosModal(processoId); // Recarrega a lista
                    window.location.reload(); // Recarrega a página para atualizar o contador
                } else {
                    alert(data.message || 'Erro ao remover inscrição');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao remover inscrição');
            });
        }

        function alocarAluno(idSelecao, processoId, idAluno) {
            if (!confirm('Tem certeza que deseja alocar este aluno na empresa?')) {
                return;
            }

            const formData = new FormData();
            formData.append('id_selecao', idSelecao);
            formData.append('id_aluno', idAluno);

            fetch('../controllers/controller_alocar_aluno.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Aluno alocado com sucesso!');
                    showInscritosModal(processoId); // Recarrega a lista
                    window.location.reload(); // Recarrega a página para atualizar o contador
                } else {
                    alert(data.message || 'Erro ao alocar aluno');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao alocar aluno');
            });
        }

        // Variáveis globais para o formulário de inscrição
        const nomeAlunoInput = document.getElementById('nome_aluno');
        const alunoSuggestions = document.getElementById('alunoSuggestions');
        const idAlunoInput = document.getElementById('id_aluno');

        // Função para mostrar o modal de inscrição
        function showInscricaoModal(id) {
            const modal = document.getElementById('inscricaoModal');
            document.getElementById('modal_form_id').value = id;
            
            // Limpar campos anteriores
            document.getElementById('nome_aluno').value = '';
            document.getElementById('id_aluno').value = '';
            document.getElementById('perfisContainer').innerHTML = '';
            
            // Buscar detalhes do processo e perfis da empresa
            fetch(`../controllers/get_processo_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    const empresaDetails = document.getElementById('empresaDetails');
                    empresaDetails.innerHTML = `
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold mb-3">Detalhes do Processo</h4>
                            <p><span class="text-gray-600">Empresa:</span> <span class="font-medium">${data.nome_empresa}</span></p>
                            <p><span class="text-gray-600">Local:</span> <span class="font-medium">${data.local}</span></p>
                            <p><span class="text-gray-600">Hora:</span> <span class="font-medium">${data.hora}</span></p>
                        </div>
                    `;

                    // Preencher os perfis disponíveis
                    if (data.perfis) {
                        const perfis = JSON.parse(data.perfis);
                        const perfisContainer = document.getElementById('perfisContainer');
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
                    }
                })
                .catch(error => console.error('Erro:', error));

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Buscar sugestões de alunos
        nomeAlunoInput.addEventListener('input', function() {
            const search = this.value.trim();
            if (search.length < 2) {
                alunoSuggestions.classList.add('hidden');
                return;
            }

            fetch(`../controllers/get_alunos_suggestions.php?search=${encodeURIComponent(search)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        alunoSuggestions.innerHTML = data.map(aluno => `
                            <div class="p-2 hover:bg-gray-100 cursor-pointer" 
                                 onclick="selectAluno('${aluno.id}', '${aluno.nome.replace(/'/g, "\\'")}')">
                                ${aluno.nome} - ${aluno.curso}
                            </div>
                        `).join('');
                        alunoSuggestions.classList.remove('hidden');
                    } else {
                        alunoSuggestions.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Erro:', error));
        });

        // Selecionar aluno da lista de sugestões
        function selectAluno(id, nome) {
            idAlunoInput.value = id;
            nomeAlunoInput.value = nome;
            alunoSuggestions.classList.add('hidden');
        }

        // Fechar sugestões ao clicar fora
        document.addEventListener('click', function(e) {
            if (!nomeAlunoInput.contains(e.target) && !alunoSuggestions.contains(e.target)) {
                alunoSuggestions.classList.add('hidden');
            }
        });

        // Adicionar o event listener para o formulário de inscrição
        document.getElementById('inscricaoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!idAlunoInput.value) {
                alert('Por favor, selecione um aluno da lista');
                return;
            }

            // Verificar se pelo menos um perfil foi selecionado
            const perfisSelecionados = document.querySelectorAll('input[name="perfis[]"]:checked');
            if (perfisSelecionados.length === 0) {
                alert('Por favor, selecione pelo menos um perfil');
                return;
            }

            const formData = new FormData(this);
            formData.append('perfis', JSON.stringify(Array.from(perfisSelecionados).map(cb => cb.value)));
            
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

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            if (modalId === 'inscricaoModal') {
                document.getElementById('inscricaoForm').reset(); // Resetar o formulário
                document.getElementById('id_aluno').value = ''; // Limpar o id do aluno hidden
                document.getElementById('nome_aluno').value = ''; // Limpar o campo de nome do aluno
                document.getElementById('alunoSuggestions').innerHTML = ''; // Limpar sugestões
                document.getElementById('alunoSuggestions').classList.add('hidden'); // Esconder sugestões
                document.getElementById('perfisContainer').innerHTML = ''; // Limpar perfis ao fechar
            }
        }

        function excluirFormulario(id) {
            if (!confirm('Tem certeza que deseja excluir este formulário? Esta ação não pode ser desfeita.')) {
                return;
            }

            const formData = new FormData();
            formData.append('id', id);
            formData.append('btn-excluir', true);

            fetch('../controllers/Controller-excluir_formulario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    throw new Error('Erro ao excluir formulário');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao excluir formulário');
            });
        }
    </script>
</body>
</html>