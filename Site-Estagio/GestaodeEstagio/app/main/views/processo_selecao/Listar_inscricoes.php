<<<<<<< HEAD
<?php
session_start();
require_once '../../models/model-function.php';

if (!isset($_SESSION['idAluno'])) {
    header("Location: ../Login_aluno.php");
    exit;
}
?>

=======
>>>>>>> parent of 548c6e6 (voltei)
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscrições</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-button {
            background: linear-gradient(to right, #FFA500, #008C45);
            color: white;
            border: none;
=======
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

        .gradient-button {
            background: linear-gradient(to right, #FFA500, #008C45);
>>>>>>> parent of 548c6e6 (voltei)
            transition: all 0.3s ease;
        }
        .gradient-button:hover {
            background: linear-gradient(to right, #008C45, #FFA500);
            transform: scale(1.05);
<<<<<<< HEAD
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Processos Seletivos Disponíveis</h2>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Vagas Disponíveis</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="processosList">
                    <!-- Lista de processos será carregada via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Inscrição -->
    <div class="modal fade" id="inscricaoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inscrição no Processo Seletivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Empresa</h5>
                            <p><strong>Nome:</strong> <span id="modal-empresa-nome"></span></p>
                            <p><strong>Contato:</strong> <span id="modal-empresa-contato"></span></p>
                            <p><strong>Endereço:</strong> <span id="modal-empresa-endereco"></span></p>
                            <p><strong>Perfil:</strong> <span id="modal-empresa-perfil"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Informações do Processo</h5>
                            <p><strong>Vagas Disponíveis:</strong> <span id="modal-empresa-vagas"></span></p>
                            <p><strong>Data:</strong> <span id="modal-empresa-data"></span></p>
                            <p><strong>Local:</strong> <span id="modal-empresa-local"></span></p>
                            <p><strong>Hora:</strong> <span id="modal-empresa-hora"></span></p>
                        </div>
                    </div>
                    <hr>
                    <form id="form-inscricao">
                        <input type="hidden" id="id_formulario" name="id_formulario">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Ao confirmar sua inscrição, você estará se comprometendo a participar deste processo seletivo.
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmarInscricao()">Confirmar Inscrição</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Inscritos -->
    <div class="modal fade" id="inscritosModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alunos Inscritos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Data de Inscrição</th>
                                </tr>
                            </thead>
                            <tbody id="inscritosList">
                                <!-- Lista de inscritos será carregada via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Carregar lista de processos
        function loadProcessos() {
            fetch('../controllers/get_processos.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('processosList');
                    tbody.innerHTML = '';
                    
                    data.forEach(processo => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${processo.nome_empresa}</td>
                            <td>${processo.numero_vagas}</td>
                            <td>${processo.data}</td>
                            <td>
                                <button class="btn btn-sm gradient-button me-2" onclick="showInscricaoModal(${processo.id})">
                                    <i class="fas fa-user-plus"></i> Inscrever
                                </button>
                                <button class="btn btn-sm btn-info" onclick="showInscritosModal(${processo.id})">
                                    <i class="fas fa-users"></i> Ver Inscritos
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Erro:', error));
        }

        // Mostrar modal de inscrição
        function showInscricaoModal(id) {
            fetch(`../controllers/get_processo_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id_formulario').value = id;
                    document.getElementById('modal-empresa-nome').textContent = data.nome_empresa;
                    document.getElementById('modal-empresa-contato').textContent = data.contato;
                    document.getElementById('modal-empresa-endereco').textContent = data.endereco;
                    document.getElementById('modal-empresa-perfil').textContent = data.perfil;
                    document.getElementById('modal-empresa-vagas').textContent = data.numero_vagas;
                    document.getElementById('modal-empresa-data').textContent = data.data;
                    document.getElementById('modal-empresa-local').textContent = data.local;
                    document.getElementById('modal-empresa-hora').textContent = data.hora;
                    
                    new bootstrap.Modal(document.getElementById('inscricaoModal')).show();
                })
                .catch(error => console.error('Erro:', error));
        }

        // Mostrar modal de inscritos
        function showInscritosModal(id) {
            fetch(`../controllers/get_inscritos.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('inscritosList');
                    tbody.innerHTML = '';
                    
                    data.forEach(inscrito => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${inscrito.nome}</td>
                            <td>${inscrito.curso}</td>
                            <td>${inscrito.data_inscricao}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                    
                    new bootstrap.Modal(document.getElementById('inscritosModal')).show();
                })
                .catch(error => console.error('Erro:', error));
        }

        // Confirmar inscrição
        function confirmarInscricao() {
            const formData = new FormData(document.getElementById('form-inscricao'));
=======
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
                    <img src="../../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="school-logo">
                    <div class="flex flex-col">
                        <span class="school-name">EEEP Salaberga</span>
                        <h1 class="text-xl md:text-2xl font-bold mb-0">Empresas com Inscrições</h1>
                    </div>
                </div>

                <!-- Search bar -->
                <form action="" method="GET" class="relative flex-1 min-w-[300px]" role="search">
                    <label for="search" class="sr-only">Pesquisar empresas</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           class="w-full px-4 py-2 pl-10 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                           placeholder="Pesquisar empresa..."
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                           aria-label="Pesquisar empresas">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2" aria-hidden="true"></i>
                </form>

                <!-- Right section with action buttons -->
                <div class="flex gap-2 flex-shrink-0">
                    <a href="alunos_alocados.php" class="gradient-button text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-user-check" aria-hidden="true"></i>
                        Alunos Alocados
                    </a>
                    <a href="processoseletivo.php" class="gradient-button text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-list" aria-hidden="true"></i>
                        Ver Formulários
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-4 md:py-8 fade-in">
        <div class="main-list-container">
            <div class="overflow-x-auto mobile-table">
                <table class="min-w-full table" role="grid">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Local</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        
                        try {
                            $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            
                            $sql = 'SELECT DISTINCT s.id, s.local, s.hora, s.data_inscricao, c.nome as nome_empresa,
                                   (SELECT COUNT(*) FROM inscricoes WHERE id_selecao = s.id) as total_inscritos
                                   FROM selecao s 
                                   INNER JOIN concedentes c ON s.id_concedente = c.id
                                   WHERE EXISTS (SELECT 1 FROM inscricoes i WHERE i.id_selecao = s.id)';
                            
                            if (!empty($search)) {
                                $sql .= ' AND (c.nome LIKE :search OR s.local LIKE :search)';
                            }
                            
                            $sql .= ' ORDER BY c.nome';
                            
                            $query = $pdo->prepare($sql);
                            
                            if (!empty($search)) {
                                $query->bindValue(':search', '%' . $search . '%');
                            }
                            
                            $query->execute();
                            $result = $query->rowCount();

                            if ($result > 0) {
                                foreach ($query as $form) {
                                    echo "<tr class='hover:bg-gray-50'>";
                                    echo "<td class='px-4 py-3'>" . htmlspecialchars($form['nome_empresa']) . "</td>";
                                    echo "<td class='px-4 py-3'>" . htmlspecialchars($form['local']) . "</td>";
                                    echo "<td class='px-4 py-3'>" . htmlspecialchars($form['hora']) . "</td>";
                                    echo "<td class='px-4 py-3 text-center'>";
                                    echo "<button onclick='showInscritosModal(" . $form['id'] . ")' 
                                              class='gradient-button text-white px-3 py-1 rounded-lg' 
                                              title='Ver lista de inscritos'
                                              aria-label='Ver lista de inscritos'>";
                                    echo "<i class='fas fa-users'></i> Ver Inscritos (" . $form['total_inscritos'] . ")";
                                    echo "</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='px-4 py-3 text-center text-gray-500'>Nenhuma empresa com inscrições encontrada.</td></tr>";
                            }
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='4' class='px-4 py-3 text-center text-red-500'>Erro ao conectar ao banco de dados: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Lista de Inscritos -->
    <div id="inscritosListaModal" class="fixed inset-0 bg-black bg-opacity-50 modal hidden items-center justify-center z-50">
        <div class="modal-content p-6 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto bg-white rounded-xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Inscrição no Processo Seletivo</h3>
                <button onclick="closeModal('inscritosListaModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="empresaDetails" class="space-y-4 mb-6">
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
                    <button type="button" onclick="closeModal('inscritosListaModal')" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancelar</button>
                    <button type="submit" class="gradient-button text-white px-4 py-2 rounded-lg">Confirmar Inscrição</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showInscritosModal(processoId) {
            const modal = document.getElementById('inscritosListaModal');
            const formIdInput = document.getElementById('modal_form_id');
            const dataInscricaoInput = document.getElementById('data_inscricao');
            const empresaDetails = document.getElementById('empresaDetails');
            const perfisContainer = document.getElementById('perfisContainer');
            
            // Set current date and time
            const now = new Date();
            dataInscricaoInput.value = now.toISOString().slice(0, 19).replace('T', ' ');
            
            // Set form ID
            formIdInput.value = processoId;
            
            // Mostrar loading
            empresaDetails.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-500"></i></div>';
            perfisContainer.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin text-2xl text-gray-500"></i></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Fetch company details
            fetch(`../controllers/get_empresa_details.php?id=${processoId}`)
                .then(response => response.json())
                .then(data => {
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
                })
                .catch(error => {
                    console.error('Error:', error);
                    empresaDetails.innerHTML = '<p class="text-center text-red-500">Erro ao carregar detalhes da empresa.</p>';
                    perfisContainer.innerHTML = '';
                });
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

            fetch(`../controllers/buscar_alunos.php?nome=${encodeURIComponent(nome)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        alunoSuggestions.innerHTML = data.map(aluno => `
                            <div class="p-2 hover:bg-gray-100 cursor-pointer" 
                                 onclick="selecionarAluno('${aluno.id}', '${aluno.nome}')">
                                ${aluno.nome} - ${aluno.curso}
                            </div>
                        `).join('');
                        alunoSuggestions.classList.remove('hidden');
                    } else {
                        alunoSuggestions.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alunoSuggestions.classList.add('hidden');
                });
        });

        function selecionarAluno(id, nome) {
            idAlunoInput.value = id;
            nomeAlunoInput.value = nome;
            alunoSuggestions.classList.add('hidden');
        }

        // Form submission
        document.getElementById('inscricaoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!idAlunoInput.value) {
                alert('Por favor, selecione um aluno da lista');
                return;
            }

            const formData = new FormData(this);
>>>>>>> parent of 548c6e6 (voltei)
            
            fetch('../controllers/controller_inscrever.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inscrição realizada com sucesso!');
<<<<<<< HEAD
                    bootstrap.Modal.getInstance(document.getElementById('inscricaoModal')).hide();
                    loadProcessos();
=======
                    closeModal('inscritosListaModal');
                    window.location.reload();
>>>>>>> parent of 548c6e6 (voltei)
                } else {
                    alert(data.message || 'Erro ao realizar inscrição');
                }
            })
            .catch(error => {
<<<<<<< HEAD
                console.error('Erro:', error);
                alert('Erro ao realizar inscrição');
            });
        }

        // Carregar processos ao iniciar
        document.addEventListener('DOMContentLoaded', loadProcessos);
    </script>
</body>
</html> 
=======
                console.error('Error:', error);
                alert('Erro ao realizar inscrição');
            });
        });

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>
>>>>>>> parent of 548c6e6 (voltei)
