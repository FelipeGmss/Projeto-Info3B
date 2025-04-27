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
                        primary: '#4caf50',
                        'primary-dark': '#43a047',
                        secondary: '#2196f3',
                        'secondary-dark': '#1976d2',
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
                    <div class="relative">
                        <input type="text" 
                               class="w-full md:w-64 px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Pesquisar empresas...">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
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
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Localização</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vagas Ativas</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <!-- Company Row 1 -->
                                <tr class="hover:bg-gray-50 transition-colors cursor-pointer" onclick="showCompanyDetails(1)">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Tech+Solutions" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Tech Solutions</div>
                                                <div class="text-sm text-gray-500">CNPJ: 12.345.678/0001-90</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">contato@techsolutions.com</div>
                                        <div class="text-sm text-gray-500">(11) 9999-9999</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">São Paulo, SP</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            5 vagas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-secondary hover:text-secondary-dark mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Company Row 2 -->
                                <tr class="hover:bg-gray-50 transition-colors cursor-pointer" onclick="showCompanyDetails(2)">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Digital+Marketing" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Digital Marketing</div>
                                                <div class="text-sm text-gray-500">CNPJ: 98.765.432/0001-10</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">contato@digitalmarketing.com</div>
                                        <div class="text-sm text-gray-500">(11) 8888-8888</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Rio de Janeiro, RJ</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            3 vagas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-secondary hover:text-secondary-dark mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Company Details Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Detalhes da Empresa</h2>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="space-y-6">
                        <div class="flex justify-center">
                            <img class="h-24 w-24 rounded-full" src="https://ui-avatars.com/api/?name=Tech+Solutions" alt="">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Tech Solutions</h3>
                            <p class="text-gray-600">Empresa de tecnologia especializada em desenvolvimento de software</p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">CNPJ</label>
                                <p class="mt-1 text-sm text-gray-900">12.345.678/0001-90</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900">contato@techsolutions.com</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Telefone</label>
                                <p class="mt-1 text-sm text-gray-900">(11) 9999-9999</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Endereço</label>
                                <p class="mt-1 text-sm text-gray-900">Av. Paulista, 1000 - São Paulo, SP</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Vagas Ativas</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                        <span class="text-sm text-gray-900">Desenvolvedor Full Stack</span>
                                        <span class="text-xs font-semibold text-blue-600">2 vagas</span>
                                    </div>
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                        <span class="text-sm text-gray-900">Analista de Dados</span>
                                        <span class="text-xs font-semibold text-blue-600">3 vagas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button class="w-full py-2 px-4 bg-secondary hover:bg-secondary-dark text-white rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-edit"></i>
                                Editar Empresa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCompanyDetails(companyId) {
            // Aqui você implementaria a lógica para mostrar os detalhes da empresa selecionada
            console.log('Mostrando detalhes da empresa:', companyId);
        }
    </script>
</body>
</html>