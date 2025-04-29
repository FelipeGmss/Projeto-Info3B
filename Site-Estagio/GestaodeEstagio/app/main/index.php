<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gestão de Estágio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/img/Design sem nome.svg" type="image/x-icon">
    <?
     require_once('autenticar.php');
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #4CAF50;
            --secondary-color: #FFB74D;
            --text-color: #333333;
            --bg-color: #F0F2F5;
            --input-bg: #FFFFFF;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-color);
            line-height: 1.6;
        }

        .main-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: auto;
            min-height: 550px;
            background-color: var(--bg-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px var(--shadow-color);
            margin: 20px;
        }

        .image-container {
            flex: 1;
            background: linear-gradient(40deg, #007A33, #FF8C00);
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 300px;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.366), rgba(0, 0, 0, 0.355));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
            color: #FFFFFF;
        }

        .image-overlay h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .image-overlay p {
            font-size: 1rem;
            max-width: 80%;
        }

        .form-container {
            flex: 1;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #FFFFFF;
            position: relative;
        }

        .login-form {
            width: 100%;
            transition: all 0.3s ease;
            opacity: 1;
            transform: translateY(0);
        }

        .login-form.hidden {
            display: none;
            opacity: 0;
            transform: translateY(-20px);
        }

        .role-selector {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .role-btn {
            padding: 10px 25px;
            border: 2px solid var(--primary-color);
            border-radius: 8px;
            background: transparent;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
        }

        .role-btn:focus {
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.2);
        }

        .role-btn.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        .role-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px var(--shadow-color);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 150px;
            height: auto;
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 1px;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--input-bg);
            color: var(--text-color);
            outline: none;
        }

        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 0.8rem;
            color: var(--primary-color);
            background-color: var(--input-bg);
            padding: 0 5px;
        }

        .input-group label {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
            padding: 0 5px;
            background-color: var(--input-bg);
        }

        .input-group i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .btn-confirmar {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .btn-confirmar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px var(--shadow-color);
        }

        .btn-confirmar:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.2);
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background-color: #e0e0e0;
            margin-top: 1rem;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress {
            width: 0;
            height: 100%;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .strength-meter {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            font-size: 0.7rem;
            color: #999;
        }

        .forgot-password {
            text-align: right;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                height: auto;
                max-width: 100%;
                margin: 10px;
            }

            .image-container {
                height: 200px;
            }

            .form-container {
                padding: 1.5rem;
            }

            .role-selector {
                flex-direction: column;
                gap: 0.5rem;
            }

            .role-btn {
                width: 100%;
            }
        }

        /* Acessibilidade */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        /* Feedback visual para erros */
        .input-group.error input {
            border-color: #ff4444;
        }

        .input-group.error label {
            color: #ff4444;
        }

        .error-message {
            color: #ff4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .input-group.error .error-message {
            display: block;
        }
    </style>
</head>

<body>
    
    <div class="main-container">
        <div class="image-container">
            <div class="image-overlay">
                <h1>EEEP Salaberga</h1>
                <p>Transformando o futuro através da educação e inovação</p>
            </div>
        </div>
        <div class="form-container">
            <div class="logo-container">
                <img src="https://i.postimg.cc/ryxHRNkj/lavosier-nas-2.png" alt="Logo EEEP Salaberga" class="logo">
            </div>
            <h2>Login</h2>

            <div class="role-selector">
                <button type="button" class="role-btn active" data-role="aluno">Aluno</button>
                <button type="button" class="role-btn" data-role="professor">Professor</button>
            </div>

            <!-- Formulário de Aluno -->
            <form id="formAluno" class="login-form" action="../controllers/Controller-login_aluno.php" method="POST" aria-labelledby="alunoFormTitle">
                <h3 id="alunoFormTitle" class="sr-only">Formulário de Login para Alunos</h3>
                <div class="input-group">
                    <input type="email" name="email" id="emailAluno" placeholder=" " required aria-required="true" aria-label="E-mail Institucional do Aluno">
                    <label for="emailAluno">E-mail Institucional</label>
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <span class="error-message" id="emailAlunoError"></span>
                </div>
                <div class="input-group">
                    <input type="password" name="senha" id="senhaAluno" placeholder=" " required aria-required="true" aria-label="Senha do Aluno">
                    <label for="senhaAluno">Senha</label>
                    <i class="fas fa-eye toggle-password" role="button" aria-label="Mostrar senha" tabindex="0"></i>
                    <span class="error-message" id="senhaAlunoError"></span>
                </div>
                <input type="submit" class="btn-confirmar" name="btn" value="Entrar" aria-label="Entrar como Aluno">
            </form>

            <!-- Formulário de Professor -->
            <form id="formProfessor" class="login-form hidden" action="../controllers/Controller-login_professor.php" method="POST" aria-labelledby="professorFormTitle">
                <h3 id="professorFormTitle" class="sr-only">Formulário de Login para Professores</h3>
                <div class="input-group">
                    <input type="email" name="email" id="emailProfessor" placeholder=" " required aria-required="true" aria-label="E-mail Institucional do Professor">
                    <label for="emailProfessor">E-mail Institucional</label>
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <span class="error-message" id="emailProfessorError"></span>
                </div>
                <div class="input-group">
                    <input type="password" name="senha" id="senhaProfessor" placeholder=" " required aria-required="true" aria-label="Senha do Professor">
                    <label for="senhaProfessor">Senha</label>
                    <i class="fas fa-eye toggle-password" role="button" aria-label="Mostrar senha" tabindex="0"></i>
                    <span class="error-message" id="senhaProfessorError"></span>
                </div>
                <input type="submit" class="btn-confirmar" name="btn" value="Entrar" aria-label="Entrar como Professor">
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleButtons = document.querySelectorAll('.role-btn');
            const forms = {
                aluno: document.getElementById('formAluno'),
                professor: document.getElementById('formProfessor')
            };

            // Função para alternar entre os formulários
            function switchForm(role) {
                Object.values(forms).forEach(form => {
                    form.classList.add('hidden');
                    form.setAttribute('aria-hidden', 'true');
                });
                forms[role].classList.remove('hidden');
                forms[role].setAttribute('aria-hidden', 'false');
                
                // Focar no primeiro campo do formulário ativo
                const firstInput = forms[role].querySelector('input[type="email"]');
                if (firstInput) {
                    firstInput.focus();
                }
            }

            roleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    roleButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.setAttribute('aria-pressed', 'false');
                    });
                    this.classList.add('active');
                    this.setAttribute('aria-pressed', 'true');
                    
                    const role = this.dataset.role;
                    switchForm(role);
                });

                // Adiciona suporte a teclado
                button.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(icon => {
                icon.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                    this.setAttribute('aria-label', type === 'password' ? 'Mostrar senha' : 'Ocultar senha');
                });

                // Adiciona suporte a teclado
                icon.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            // Validação de formulário
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    const emailInput = form.querySelector('input[type="email"]');
                    const passwordInput = form.querySelector('input[type="password"]');
                    
                    if (!emailInput.value) {
                        emailInput.parentElement.classList.add('error');
                        isValid = false;
                    }
                    
                    if (!passwordInput.value) {
                        passwordInput.parentElement.classList.add('error');
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });

                // Limpa erros quando o usuário começa a digitar
                form.querySelectorAll('input').forEach(input => {
                    input.addEventListener('input', function() {
                        this.parentElement.classList.remove('error');
                    });
                });
            });
        });
    </script>
</body>

</html>