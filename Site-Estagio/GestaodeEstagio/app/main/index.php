<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Professores e Alunos</title>
    <link rel="icon" type="image/x-icon" href="views/logo_Salaberga.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .rotate-scale {
            animation: rotateScale 0.3s ease-in-out;
        }

        @keyframes rotateScale {
            0% {
                transform: rotate(0deg) scale(1);
            }

            50% {
                transform: rotate(180deg) scale(1.2);
            }

            100% {
                transform: rotate(360deg) scale(1);
            }
        }

        .swap-animation {
            transition: transform 0.7s cubic-bezier(0.4, 0.0, 0.2, 1);
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gradient-bg {
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .shadow-glow {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #formSection {
            position: relative;
            z-index: 1;
        }

        #phraseSection {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="bg-gradient-bg flex items-center justify-center h-screen overflow-hidden">
    <div class="w-full max-w-6xl flex items-center justify-between px-16 py-12 bg-white rounded-3xl shadow-2xl shadow-glow">
        <!-- Left Side: Phrase and Logo -->
        <div id="phraseSection" class="swap-animation">
            <div class="w-full max-w-md flex flex-col items-center">
                <img src="views/nome_Salaberga.jpg" alt="Logo" class="mb-6 rounded-full shadow-md w-64 h-auto">
                <h2 id="phraseText" class="text-3xl font-bold text-gray-800 mb-4">Bem-vindo, Aluno!</h2>
                <p class="text-gray-600 text-lg">Acesse sua área e comece a aprender!</p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div id="formSection" class="swap-animation">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-900">Login</h2>
                <form id="loginForm" method="POST" action="controllers/Controller_login.php" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-2 w-full px-4 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="email" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700">Senha</label>
                        <input type="password" id="senha" name="senha"
                            class="mt-2 w-full px-4 py-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="********" required>
                    </div>
                    <input type="hidden" id="userType" name="userType" value="student">
                    <input type="submit" id="loginBtn" name="btn"
                        class="w-full bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300 font-semibold">
                </form>
                <div class="flex justify-center mt-8">
                    <button id="toggleBtn" type="button"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300 font-semibold rotate-scale">Professor</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedRole = 'student';
        let isSwapped = false;

        const toggleBtn = document.getElementById('toggleBtn');
        const phraseSection = document.getElementById('phraseSection');
        const formSection = document.getElementById('formSection');
        const phraseText = document.getElementById('phraseText');
        const userTypeInput = document.getElementById('userType');

        const validateEmail = (email) => {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        };

        // const handleLogin = (userType, credentials) => {
        //     if (!validateEmail(credentials.email)) {
        //         alert(`Email inválido para ${userType === 'teacher' ? 'professor' : 'aluno'}`);
        //         return;
        //     }
        //     if (credentials.password.length < 6) {
        //         alert(`A senha deve ter pelo menos 6 caracteres para ${userType === 'teacher' ? 'professor' : 'aluno'}`);
        //         return;
        //     }
        //     alert(`Login bem-sucedido para ${userType === 'teacher' ? 'professor' : 'aluno'}: ${credentials.email}`);
        // };

        const swapSections = () => {
            isSwapped = !isSwapped;
            if (isSwapped) {
                phraseSection.style.transform = 'translateX(150%)';
                formSection.style.transform = 'translateX(-150%)';
            } else {
                phraseSection.style.transform = 'translateX(0)';
                formSection.style.transform = 'translateX(0)';
            }
        };

        const updateUI = () => {
            toggleBtn.classList.add('rotate-scale');
            setTimeout(() => toggleBtn.classList.remove('rotate-scale'), 300);

            if (selectedRole === 'student') {
                phraseText.textContent = 'Bem-vindo, Aluno!';
                toggleBtn.textContent = 'Professor';
                userTypeInput.value = 'student';
            } else {
                phraseText.textContent = 'Bem-vindo, Professor!';
                toggleBtn.textContent = 'Aluno';
                userTypeInput.value = 'teacher';
            }
            swapSections();
        };

        toggleBtn.addEventListener('click', () => {
            selectedRole = selectedRole === 'student' ? 'teacher' : 'student';
            updateUI();
        });

        // const loginForm = document.getElementById('loginForm');
        // loginForm.addEventListener('submit', (e) => {
        //     e.preventDefault();
        //     const email = document.getElementById('email').value;
        //     const password = document.getElementById('senha').value;
        //     handleLogin(selectedRole, { email, password });
        // });

        // Initialize UI
        updateUI();
    </script>
</body>

</html>