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
                        primary: '#007A33',
                        'primary-dark': '#00662a',
                        secondary: '#FF8C00',
                        'secondary-dark': '#e67e00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#005A24] to-[#FF8C00] min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Cabeçalho -->
        <header class="bg-[#F5F5F5]/90 backdrop-blur-sm shadow-lg sticky top-0 z-10">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="bg-primary/10 p-2 rounded-xl">
                            <img src="../views/logo_Salaberga-removebg-preview.png" alt="Logo" class="h-8 w-8 sm:h-10 sm:w-10">
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Sistema de Gestão de Estágio</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Conteúdo Principal -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <div class="w-full max-w-7xl mx-auto bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Seção de Relatórios -->
                    <div class="bg-[#F5F5F5] rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-secondary/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-chart-bar text-secondary text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Relatórios</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/relatorios.php" class="block w-full py-3 px-4 bg-gradient-to-r from-[#007A33] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#007A33] text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-file-alt"></i>
                                Gerar Relatório
                            </a>
                            <a href="../views/processoseletivo.php" class="block w-full py-3 px-4 border-2 border-[#007A33] text-[#007A33] hover:bg-gradient-to-r hover:from-[#007A33] hover:to-[#FF8C00] hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-clipboard-list"></i>
                                Processo Seletivo
                            </a>
                        </div>
                    </div>

                    <!-- Seção de Alunos -->
                    <div class="bg-[#F5F5F5] rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-primary/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-user-graduate text-primary text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Alunos</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/cadastroaluno.php" class="block w-full py-3 px-4 bg-gradient-to-r from-[#007A33] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#007A33] text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-user-plus"></i>
                                Cadastrar Aluno
                            </a>
                            <a href="../views/perfildoaluno.php" class="block w-full py-3 px-4 border-2 border-[#007A33] text-[#007A33] hover:bg-gradient-to-r hover:from-[#007A33] hover:to-[#FF8C00] hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                Ver Perfil do Aluno
                            </a>
                        </div>
                    </div>

                    <!-- Seção de Empresa -->
                    <div class="bg-[#F5F5F5] rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-tertiary/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-building text-tertiary text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Empresa</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/cadastrodaempresa.php" class="block w-full py-3 px-4 bg-gradient-to-r from-[#007A33] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#007A33] text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i>
                                Nova Empresa
                            </a>
                            <a href="../views/dadosempresa.php" class="block w-full py-3 px-4 border-2 border-[#007A33] text-[#007A33] hover:bg-gradient-to-r hover:from-[#007A33] hover:to-[#FF8C00] hover:text-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-edit"></i>
                                Editar Empresa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Rodapé -->
        <footer class="bg-[#F5F5F5] shadow-lg mt-12">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-gray-600 text-sm sm:text-base mb-4 sm:mb-0">© 2023 Sistema de Gestão de Estágio. Todos os direitos reservados.</p>
                    <div class="flex space-x-6">
                        <a href="https://www.instagram.com/eeepsalabergampe/" class="text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>