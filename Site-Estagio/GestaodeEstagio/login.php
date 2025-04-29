<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Estágio</title>
    <link rel="icon" type="image/x-icon" href="app/main/views/logo_Salaberga-removebg-preview.png">
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
        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-container {
            padding: 2rem;
            border-radius: 0.5rem;
            background: white;
        }
        .form-title {
            color: #005A24;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .input-field {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .btn-login {
            background: #005A24;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: #004419;
            transform: translateY(-2px);
        }
        .divider {
            width: 2px;
            background: #ddd;
            margin: 0 2rem;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .divider {
                width: 100%;
                height: 2px;
                margin: 2rem 0;
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="card w-full max-w-4xl">
        <div class="text-center p-6">
            <img src="app/main/views/nome_Salaberga2.jpg" alt="Logo" class="mx-auto mb-4 w-48">
            <h1 class="text-2xl font-bold text-gray-800">Sistema de Estágio</h1>
        </div>

        <div class="login-container flex items-stretch">
            <!-- Formulário Aluno -->
            <div class="form-container flex-1">
                <div class="form-title">
                    <i class="fas fa-user-graduate mr-2"></i>
                    Login do Aluno
                </div>
                <form method="POST" action="app/main/controllers/Controller-login_alunos.php">
                    <input type="email" name="email" placeholder="Email do Aluno" class="input-field" required>
                    <input type="password" name="senha" placeholder="Senha" class="input-field" required>
                    <input type="hidden" name="userType" value="student">
                    <button type="submit" name="btn" class="btn-login">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Entrar como Aluno
                    </button>
                </form>
            </div>

            <div class="divider"></div>

            <!-- Formulário Professor -->
            <div class="form-container flex-1">
                <div class="form-title">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Login do Professor
                </div>
                <form method="POST" action="app/main/controllers/Controller-login_professores.php">
                    <input type="email" name="email" placeholder="Email do Professor" class="input-field" required>
                    <input type="password" name="senha" placeholder="Senha" class="input-field" required>
                    <input type="hidden" name="userType" value="professor">
                    <button type="submit" name="btn" class="btn-login">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Entrar como Professor
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html> 