<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
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
        <div class="max-w-md mx-auto">
            <!-- Botão Voltar -->
            <div class="mb-6">
                <a href="login_aluno.php" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#005A24] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#005A24] text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-arrow-left"></i>
                    Voltar para Login
                </a>
            </div>

            <!-- Formulário de Recuperação de Senha -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Recuperar Senha</h1>
                
                <form action="../controllers/Controller-recuperar_senha.php" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email ou Matrícula
                        </label>
                        <input type="text" 
                               id="email" 
                               name="email" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Digite seu email ou matrícula"
                               required>
                    </div>

                    <div>
                        <label for="nova_senha" class="block text-sm font-medium text-gray-700 mb-1">
                            Nova Senha
                        </label>
                        <input type="password" 
                               id="nova_senha" 
                               name="nova_senha" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Digite sua nova senha"
                               required>
                    </div>

                    <div>
                        <label for="confirmar_senha" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirmar Nova Senha
                        </label>
                        <input type="password" 
                               id="confirmar_senha" 
                               name="confirmar_senha" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Confirme sua nova senha"
                               required>
                    </div>

                    <input type="submit" name="btn" 
                            class="w-full py-3 px-4 bg-gradient-to-r from-[#005A24] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#005A24] text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-key"></i>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validação de senha
        document.querySelector('form').addEventListener('submit', function(e) {
            const novaSenha = document.getElementById('nova_senha').value;
            const confirmarSenha = document.getElementById('confirmar_senha').value;

            if (novaSenha !== confirmarSenha) {
                e.preventDefault();
                alert('As senhas não coincidem. Por favor, verifique e tente novamente.');
            }
        });
    </script>
</body>
</html>
