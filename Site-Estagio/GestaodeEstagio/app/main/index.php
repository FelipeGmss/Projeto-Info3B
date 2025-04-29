<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecione seu Perfil</title>
    <link rel="icon" type="image/x-icon" href="views/logo_Salaberga-removebg-preview.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
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
    </style>
</head>

<body class="bg-gradient-bg flex items-center justify-center h-screen overflow-hidden">
    <div class="w-full max-w-3xl flex flex-col items-center justify-center px-12 py-10 card rounded-3xl shadow-2xl shadow-glow">
        <!-- Logo and Welcome Message -->
        <div class="w-full flex flex-col items-center mb-8">
            <img src="views/nome_Salaberga2.jpg" alt="Logo" class="mb-6 rounded-full shadow-md w-56 h-auto transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Bem-vindo ao Sistema de Estágio!</h2>
            <p class="text-gray-600 text-base text-center">Escolha como realizar o login!</p>
        </div>

        <!-- Buttons Section -->
        <div class="w-full flex flex-col space-y-4 max-w-xs">
            <form method="POST" action="controllers/Controller_Index.php" class="space-y-4">
                <input type="hidden" name="userType" value="student">
                <input type="submit" name="btn" value="Aluno" class="w-full btn-primary text-white py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#005A24] transition-all duration-300 font-semibold text-lg">
                
                <input type="hidden" name="userType" value="teacher">
                <input type="submit" name="btn" value="Professor" class="w-full btn-primary text-white py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#005A24] transition-all duration-300 font-semibold text-lg">
            </form>
        </div>
    </div>
</body>

</html>