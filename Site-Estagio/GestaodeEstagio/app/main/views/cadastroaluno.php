<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição do Candidato</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4caf50',
                        'primary-dark': '#43a047',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 md:p-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-6 md:p-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-8">Inscrição do Candidato</h1>

        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div class="form-group">
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div class="form-group">
                    <label for="curso" class="block text-sm font-medium text-gray-700 mb-1">Curso</label>
                    <input type="text" id="curso" name="curso" placeholder="Nome do curso" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div class="form-group">
                    <label for="periodo" class="block text-sm font-medium text-gray-700 mb-1">Período</label>
                    <select id="periodo" name="periodo" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        <option value="">Selecione o Período</option>
                        <option value="1">1º Período</option>
                        <option value="2">2º Período</option>
                        <option value="3">3º Período</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="empresa" class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                    <input type="text" id="empresa" name="empresa" placeholder="Nome da empresa" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                </div>
            </div>

            <div class="form-group">
                <label for="vaga" class="block text-sm font-medium text-gray-700 mb-1">Vaga de Interesse</label>
                <input type="text" id="vaga" name="vaga" placeholder="Descreva a vaga de interesse" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
            </div>

            <div class="form-group">
                <label for="motivacao" class="block text-sm font-medium text-gray-700 mb-1">Motivação</label>
                <textarea id="motivacao" name="motivacao" placeholder="Descreva sua motivação para a vaga" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors h-32 resize-none"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" 
                        class="w-full md:w-auto px-8 py-3 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    Inscrever
                </button>
            </div>
        </form>
    </div>
</body>
</html>