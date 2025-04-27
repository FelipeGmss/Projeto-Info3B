<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Vagas - Processo Seletivo</title>
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
                        accent: '#ff9800',
                        'accent-dark': '#f57c00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen font-['Roboto']">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">Gestão de Vagas</h1>
                    <p class="text-gray-600">Gerencie vagas, formulários e inscrições dos alunos</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" 
                               class="w-full md:w-64 px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Pesquisar vagas...">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Nova Vaga
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Filtros</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Área</label>
                            <select class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option>Todas as Áreas</option>
                                <option>TI</option>
                                <option>Administração</option>
                                <option>Marketing</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Vagas Ativas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Vagas Encerradas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Com Inscrições</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <!-- Tabs -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        <button class="px-6 py-3 rounded-xl bg-primary text-white font-medium whitespace-nowrap flex items-center gap-2">
                            <i class="fas fa-briefcase"></i>
                            Vagas Ativas
                        </button>
                        <button class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-colors whitespace-nowrap flex items-center gap-2">
                            <i class="fas fa-archive"></i>
                            Vagas Encerradas
                        </button>
                        <button class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-colors whitespace-nowrap flex items-center gap-2">
                            <i class="fas fa-file-alt"></i>
                            Formulários
                        </button>
                        <button class="px-6 py-3 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-colors whitespace-nowrap flex items-center gap-2">
                            <i class="fas fa-user-graduate"></i>
                            Inscrições
                        </button>
                    </div>
                </div>

                <!-- Vacancies List -->
                <div class="space-y-6">
                    <!-- Vacancy Card 1 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="bg-primary/10 p-3 rounded-xl">
                                        <i class="fas fa-code text-primary text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">Desenvolvedor Full Stack</h3>
                                        <p class="text-gray-600">Tech Solutions Ltda</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-user-friends mr-1"></i>
                                        5 vagas disponíveis
                                    </span>
                                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i>
                                        Inscrições abertas
                                    </span>
                                    <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-users mr-1"></i>
                                        12 inscritos
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-secondary hover:bg-secondary-dark text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <button class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-times"></i>
                                    Encerrar
                                </button>
                                <button class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-eye"></i>
                                    Ver Inscritos
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Vacancy Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="bg-accent/10 p-3 rounded-xl">
                                        <i class="fas fa-bullhorn text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">Analista de Marketing</h3>
                                        <p class="text-gray-600">Digital Marketing SA</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-user-friends mr-1"></i>
                                        3 vagas disponíveis
                                    </span>
                                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i>
                                        Inscrições abertas
                                    </span>
                                    <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-users mr-1"></i>
                                        8 inscritos
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-secondary hover:bg-secondary-dark text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <button class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-times"></i>
                                    Encerrar
                                </button>
                                <button class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-eye"></i>
                                    Ver Inscritos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Management Section -->
                <div class="mt-12">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Gerenciamento de Formulários</h2>
                        <button class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Criar Novo Formulário
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Form Template 1 -->
                        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="bg-primary/10 p-3 rounded-xl">
                                        <i class="fas fa-file-alt text-primary text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800">Formulário Padrão</h3>
                                </div>
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    20 respostas
                                </span>
                            </div>
                            <p class="text-gray-600 mb-6">Formulário básico para coleta de informações dos candidatos</p>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-secondary hover:bg-secondary-dark text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <button class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-eye"></i>
                                    Ver Respostas
                                </button>
                            </div>
                        </div>

                        <!-- Form Template 2 -->
                        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="bg-accent/10 p-3 rounded-xl">
                                        <i class="fas fa-cogs text-accent text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800">Formulário Técnico</h3>
                                </div>
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    15 respostas
                                </span>
                            </div>
                            <p class="text-gray-600 mb-6">Formulário específico para vagas técnicas com avaliação de habilidades</p>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-secondary hover:bg-secondary-dark text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-edit"></i>
                                    Editar
                                </button>
                                <button class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-xl transition-colors flex items-center gap-2">
                                    <i class="fas fa-eye"></i>
                                    Ver Respostas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Registrations Section -->
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8">Inscrições dos Alunos</h2>
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vaga</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Inscrição</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=João+Silva" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">João Silva</div>
                                                    <div class="text-sm text-gray-500">joao.silva@email.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Desenvolvedor Full Stack</div>
                                            <div class="text-sm text-gray-500">Tech Solutions Ltda</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/03/2024</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Em Análise
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-secondary hover:text-secondary-dark mr-4">
                                                <i class="fas fa-file-alt"></i>
                                                Ver Formulário
                                            </button>
                                            <button class="text-green-600 hover:text-green-800">
                                                <i class="fas fa-check"></i>
                                                Aprovar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Maria+Santos" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Maria Santos</div>
                                                    <div class="text-sm text-gray-500">maria.santos@email.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Analista de Marketing</div>
                                            <div class="text-sm text-gray-500">Digital Marketing SA</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">16/03/2024</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Aprovado
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-secondary hover:text-secondary-dark mr-4">
                                                <i class="fas fa-file-alt"></i>
                                                Ver Formulário
                                            </button>
                                            <button class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-times"></i>
                                                Reprovar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>