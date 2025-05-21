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
                        <p class="text-gray-600">Visualize e inscreva-se nos processos seletivos disponíveis</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <form action="" method="GET" class="relative w-full md:w-64" role="search">
                        <label for="search" class="sr-only">Pesquisar processos seletivos</label>
                        <input type="text" 
                               id="search"
                               name="search"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                               placeholder="Pesquisar local ou empresa..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               aria-label="Pesquisar processos seletivos">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Formulários List -->
            <div class="lg:col-span-3">
                <div class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto mobile-table">
                        <table class="min-w-full" role="grid">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Local</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php
                                session_start();
                                $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                
                                $sql = 'SELECT s.*, c.nome as nome_empresa 
                                       FROM selecao s 
                                       LEFT JOIN concedentes c ON s.id_concedente = c.id 
                                       WHERE s.id_aluno IS NULL';
                                
                                if (!empty($search)) {
                                    $sql .= ' AND (s.local LIKE :search OR c.nome LIKE :search)';
                                }
                                
                                $query = $pdo->prepare($sql);
                                
                                if (!empty($search)) {
                                    $query->bindValue(':search', '%' . $search . '%');
                                }
                                
                                $query->execute();
                                $result = $query->rowCount();

                                if ($result > 0) {
                                    foreach ($query as $form) {
                                        echo "<tr class='table-row hover:bg-gray-50 transition-colors cursor-pointer' role='row'>";
                                        echo "<td class='px-4 py-3'>" . htmlspecialchars($form['hora']) . "</td>";
                                        echo "<td class='px-4 py-3'>" . htmlspecialchars($form['local']) . "</td>";
                                        echo "<td class='px-4 py-3'>" . htmlspecialchars($form['nome_empresa']) . "</td>";
                                        echo "<td class='px-4 py-3'>";
                                        echo "<button onclick='showInscricaoModal(" . $form['id'] . ")' class='text-green-600 hover:text-green-800' title='Inscrever-se'>";
                                        echo "<i class='fas fa-user-plus'></i> Inscrever-se";
                                        echo "</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center text-gray-500 py-4'>Nenhum processo seletivo disponível.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                <input type="hidden" name="id_aluno" value="<?php echo $_SESSION['id']; ?>">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Aluno:</label>
                    <input type="text" value="<?php echo $_SESSION['nome']; ?>" class="w-full px-3 py-2 border rounded bg-gray-50" readonly>
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

        function closeModal() {
            const modal = document.getElementById('inscricaoModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Form submission
        document.getElementById('inscricaoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
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