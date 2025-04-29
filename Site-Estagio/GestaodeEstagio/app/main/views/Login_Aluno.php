<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aluno</title>
    <link rel="icon" type="image/x-icon" href="../views/logo_Salaberga-removebg-preview.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(45deg, #005A24, #FF8C00);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .gradient-bg {
            background: linear-gradient(45deg, #005A24, #FF8C00);
        }

        .shadow-glow {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, #005A24, #FF8C00);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #FF8C00, #005A24);
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 2px rgba(0, 90, 36, 0.2);
        }

        .title-icon {
            color: #005A24;
            margin-right: 10px;
            font-size: 1.5rem;
        }
    </style>
</head>

<body class="bg-gradient-bg flex items-center justify-center h-screen overflow-hidden">
    <div class="w-full max-w-3xl flex flex-col items-center justify-center px-12 py-10 card rounded-3xl shadow-2xl shadow-glow">
        <!-- Logo and Welcome Message -->
        <div class="w-full flex flex-col items-center mb-8">
            <img src="../views/nome_Salaberga2.jpg" alt="Logo" class="mb-6 rounded-full shadow-md w-56 h-auto transform hover:scale-105 transition-transform duration-300">
            <div class="flex items-center mb-2">
                <i class="fas fa-user-graduate title-icon"></i>
                <h2 class="text-2xl font-bold text-gray-800">Bem-vindo, Aluno!</h2>
            </div>
            <p class="text-gray-600 text-base text-center">Faça login para acessar sua área</p>
        </div>

        <!-- Login Form -->
        <div class="w-full max-w-xs">
            <form method="POST" action="../controllers/Controller-login_alunos.php" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                        placeholder="Digite seu email">
                </div>
                <div>
                    <label for="senha" class="block text-sm font-semibold text-gray-700 mb-1">Senha</label>
                    <input type="password" id="senha" name="senha" required
                        class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                        placeholder="Digite sua senha">
                </div>
                <input type="hidden" name="userType" value="student">
                <input type="submit" name="btn" value="Entrar"
                    class="w-full btn-primary text-white py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#005A24] transition-all duration-300 font-semibold text-lg">
            </form>
        </div>
    </div>
</body>

</html>