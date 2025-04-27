<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estágio</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4caf50',
                        'primary-dark': '#43a047',
                        secondary: '#ff6f61',
                        'secondary-dark': '#e66255',
                        tertiary: '#ff9800',
                        'tertiary-dark': '#f57c00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Cabeçalho -->
    <header class="bg-white shadow-lg sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                    <div class="bg-primary/10 p-2 rounded-xl">
                        <img src="https://cdn-icons-png.flaticon.com/128/308/308833.png" alt="Logo" class="h-8 w-8 sm:h-10 sm:w-10">
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Sistema de Gestão de Estágio</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 text-sm sm:text-base hidden sm:inline">Bem-vindo, Professor</span>
                    <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-700 transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                        <img src="https://cdn-icons-png.flaticon.com/128/1077/1077114.png" alt="Perfil" class="h-5 w-5 sm:h-6 sm:w-6">
                        <span class="hidden sm:inline">Meu Perfil</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Seção de Estatísticas (Visível apenas em mobile) -->
        <div class="grid grid-cols-2 sm:hidden gap-4 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-4 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs">Alunos</p>
                        <h3 class="text-lg font-bold text-gray-800">124</h3>
                    </div>
                    <div class="bg-green-100 p-2 rounded-xl">
                        <i class="fas fa-users text-green-500 text-lg"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-4 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs">Empresas</p>
                        <h3 class="text-lg font-bold text-gray-800">45</h3>
                    </div>
                    <div class="bg-orange-100 p-2 rounded-xl">
                        <i class="fas fa-building text-orange-500 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Seção de Relatórios -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="bg-secondary/10 p-3 rounded-xl mr-4">
                        <i class="fas fa-chart-bar text-secondary text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Relatórios</h2>
                </div>
                <div class="space-y-4">
                    <a href="../views/relatorios.php" class="block w-full py-3 px-4 bg-secondary hover:bg-secondary-dark text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-file-alt"></i>
                        Gerar Relatório
                    </a>
                    <a href="../views/processoseletivo.php" class="block w-full py-3 px-4 border-2 border-secondary text-secondary hover:bg-secondary hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-clipboard-list"></i>
                        Processo Seletivo
                    </a>
                </div>
            </div>

            <!-- Seção de Alunos -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="bg-primary/10 p-3 rounded-xl mr-4">
                        <i class="fas fa-user-graduate text-primary text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Alunos</h2>
                </div>
                <div class="space-y-4">
                    <a href="../views/cadastroaluno.php" class="block w-full py-3 px-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        Cadastrar Aluno
                    </a>
                    <a href="../views/perfildoaluno.php" class="block w-full py-3 px-4 border-2 border-primary text-primary hover:bg-primary hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-user-circle"></i>
                        Ver Perfil do Aluno
                    </a>
                </div>
            </div>

            <!-- Seção de Empresa -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center mb-6">
                    <div class="bg-tertiary/10 p-3 rounded-xl mr-4">
                        <i class="fas fa-building text-tertiary text-xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Empresa</h2>
                </div>
                <div class="space-y-4">
                    <a href="../views/cadastrodaempresa.php" class="block w-full py-3 px-4 bg-tertiary hover:bg-tertiary-dark text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i>
                        Nova Empresa
                    </a>
                    <a href="../views/dadosempresa.php" class="block w-full py-3 px-4 border-2 border-tertiary text-tertiary hover:bg-tertiary hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>
                        Editar Empresa
                    </a>
                </div>
            </div>
        </div>

        <!-- Seção de Estatísticas (Visível apenas em desktop) -->
        <div class="hidden sm:grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total de Alunos</p>
                        <h3 class="text-3xl font-bold text-gray-800">124</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-xl">
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Empresas Parceiras</p>
                        <h3 class="text-3xl font-bold text-gray-800">45</h3>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-xl">
                        <i class="fas fa-building text-orange-500 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Estágios Ativos</p>
                        <h3 class="text-3xl font-bold text-gray-800">89</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-xl">
                        <i class="fas fa-briefcase text-blue-500 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="bg-white shadow-lg mt-12">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-0">© 2023 Sistema de Gestão de Estágio. Todos os direitos reservados.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>