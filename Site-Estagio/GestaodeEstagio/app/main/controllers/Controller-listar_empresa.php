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
                        primary: '#005A24',
                        'primary-dark': '#004a1d',
                        secondary: '#FF8C00',
                        'secondary-dark': '#e67e00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen font-['Roboto']">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Dados das Empresas</h1>
                    <p class="text-gray-600">Gerencie e visualize os dados das empresas parceiras</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="" method="GET" class="relative">
                        <input type="text" 
                               name="search"
                               class="w-full md:w-64 px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Pesquisar empresas..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                    <button class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        <a href="../views/cadastrodaempresa.php">Nova Empresa</a>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Companies List -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perfil</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vagas</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php
                                require("../models/cadastros.class.php");
                                $x = new Cadastro();
                                $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                                
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                if (!empty($search)) {
                                    $consulta = 'SELECT * FROM concedentes WHERE nome LIKE :search';
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
                                        echo "<tr class='hover:bg-gray-50 transition-colors cursor-pointer' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                        echo "<div class='flex items-center'>";
                                        echo "<div class='flex-shrink-0 h-10 w-10'>";
                                        echo "<img class='h-10 w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt=''>";
                                        echo "</div>";
                                        echo "<div class='ml-4'>";
                                        echo "<div class='text-sm font-medium text-gray-900'>" . $value['nome'] . "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                        echo "<div class='text-sm text-gray-900'>" . $value['contato'] . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                        echo "<div class='text-sm text-gray-900'>" . $value['endereco'] . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                        echo "<div class='text-sm text-gray-900'>" . $value['perfil'] . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap'>";
                                        echo "<div class='text-sm text-gray-900'>" . $value['numero_vagas'] . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>";
                                        echo "<form action='editar_empresa.php' method='GET' style='display: inline;'>";
                                        echo "<input type='hidden' name='btn' value='" . $value['id'] . "'>";
                                        echo "<button type='submit' class='text-secondary hover:text-secondary-dark mr-3'>";
                                        echo "<i class='fas fa-edit'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "<form action='../controllers/Controller-excluir_empresa.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>";
                                        echo "<input type='hidden' name='btn' value='" . $value['id'] . "'>";
                                        echo "<button type='submit' class='text-red-600 hover:text-red-800'>";
                                        echo "<i class='fas fa-trash'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='px-6 py-4 text-center text-gray-500'>Nenhuma empresa cadastrada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Company Details Sidebar -->
            <div class="lg:col-span-1">
                <div id="companyDetails" class="bg-white rounded-2xl shadow-lg p-6 sticky top-8 hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Detalhes da Empresa</h2>
                        <button onclick="closeDetails()" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="space-y-6">
                        <div class="flex justify-center">
                            <img id="companyImage" class="h-24 w-24 rounded-full" src="" alt="">
                        </div>
                        <div>
                            <h3 id="companyName" class="text-lg font-semibold text-gray-800 mb-2"></h3>
                            <p id="companyProfile" class="text-gray-600"></p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Contato</label>
                                <p id="companyContact" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Endereço</label>
                                <p id="companyAddress" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Vagas Ativas</label>
                                <p id="companyVacancies" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchCompanies() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[0]; // Primeira coluna (nome da empresa)
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        function showCompanyDetails(company) {
            const detailsDiv = document.getElementById('companyDetails');
            detailsDiv.classList.remove('hidden');
            
            document.getElementById('companyImage').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(company.nome)}`;
            document.getElementById('companyName').textContent = company.nome;
            document.getElementById('companyProfile').textContent = company.perfil;
            document.getElementById('companyContact').textContent = company.contato;
            document.getElementById('companyAddress').textContent = company.endereco;
            document.getElementById('companyVacancies').textContent = company.numero_vagas;
        }

        function closeDetails() {
            document.getElementById('companyDetails').classList.add('hidden');
        }
    </script>
</body>
</html>