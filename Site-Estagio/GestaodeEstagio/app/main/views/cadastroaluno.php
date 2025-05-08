<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Cores e Variáveis */
        :root {
            --primary-color: #4caf50;
            --secondary-color: #e65100;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --light-bg: #f8f9fa;
            --white: #fff;
            --border-color: #e0e0e0;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --success-color: #2ecc71;
            --error-color: #e74c3c;
            --focus-ring: 0 0 0 3px rgba(76, 175, 80, 0.3);
            --transition: all 0.3s ease;
        }

        /* Reset e Estilos Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container Principal */
        .container {
            width: 100%;
            max-width: 800px;
            background-color: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Cabeçalho */
        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .header h1 {
            font-size: 32px;
            color: var(--text-color);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: var(--text-light);
            font-size: 16px;
        }

        /* Layout em Duas Colunas */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Campos do Formulário */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            color: var(--text-color);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group .input-wrapper {
            position: relative;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            transition: var(--transition);
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        /* Estados de Foco e Hover */
        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: var(--focus-ring);
            background-color: var(--white);
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: var(--primary-color);
        }

        /* Mensagens de Ajuda e Erro */
        .help-text {
            font-size: 14px;
            color: var(--text-light);
            margin-top: 6px;
            display: block;
        }

        .error-message {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 6px;
            display: none;
        }

        .form-group.error input {
            border-color: var(--error-color);
        }

        .form-group.error .error-message {
            display: block;
        }

        /* Botão de Envio */
        .submit-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .submit-button:focus {
            outline: none;
            box-shadow: var(--focus-ring);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 25px 20px;
                margin: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .header {
                margin-bottom: 25px;
            }

            .header h1 {
                font-size: 26px;
            }
        }

        /* Alto Contraste */
        @media (prefers-contrast: high) {
            :root {
                --text-color: #000;
                --border-color: #000;
            }

            .form-group input:focus,
            .form-group select:focus {
                border-width: 3px;
            }
        }

        /* Redução de Movimento */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        /* Feedback Visual
        .success-message {
            background-color: var(--success-color);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
            text-align: center;
        } */

        /* Indicador de Carregamento */
        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .loading::after {
            content: "";
            width: 30px;
            height: 30px;
            border: 3px solid var(--white);
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Botão Voltar -->
        <a href="paginainical.php" 
           class="inline-flex items-center text-primary hover:text-primary-dark mb-6 transition-colors duration-300"
           aria-label="Voltar para a página inicial">
            <i class="fas fa-arrow-left mr-2" aria-hidden="true"></i>
            Voltar
        </a>

        <div class="header">
            <h1>Cadastro de Aluno</h1>
            <p>Preencha os dados para começar</p>
        </div>

        <form action="../controllers/Controller-cadastro_aluno.php" method="POST" autocomplete="off" aria-label="Formulário de cadastro de aluno" id="cadastroForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <div class="input-wrapper">
                        <input type="text" id="nome" name="nome" 
                               placeholder="Digite seu nome completo"
                               required
                               aria-required="true"
                               minlength="3"
                               maxlength="100">
                    </div>
                    <span class="error-message" id="nomeError">Por favor, insira um nome válido</span>
                </div>

                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <div class="input-wrapper">
                        <input type="text" id="matricula" name="matricula" 
                               placeholder="Digite sua matrícula"
                               required
                               aria-required="true"
                               pattern="[0-9]+"
                               minlength="6"
                               maxlength="20">
                    </div>
                    <span class="error-message" id="matriculaError">Por favor, insira uma matrícula válida</span>
                </div>

                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-wrapper">
                        <input type="tel" id="contato" name="contato" 
                               placeholder="(00) 00000-0000"
                               pattern="[0-9]{10,11}"
                               title="Digite apenas números (10 ou 11 dígitos)"
                               required
                               aria-required="true">
                    </div>
                    <span class="help-text">Digite apenas números (DDD + número)</span>
                    <span class="error-message" id="contatoError">Por favor, insira um número válido</span>
                </div>

                <div class="form-group">
                    <label for="curso">Curso</label>
                    <div class="input-wrapper">
                        <input type="text" id="curso" name="curso" 
                               placeholder="Nome do curso"
                               required
                               aria-required="true"
                               minlength="3"
                               maxlength="100">
                    </div>
                    <span class="error-message" id="cursoError">Por favor, insira um curso válido</span>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               placeholder="Digite seu e-mail"
                               required
                               aria-required="true"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <span class="error-message" id="emailError">Por favor, insira um e-mail válido</span>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-wrapper">
                        <input type="text" id="endereco" name="endereco" 
                               placeholder="Digite seu endereço completo"
                               required
                               aria-required="true"
                               minlength="5"
                               maxlength="200">
                    </div>
                    <span class="error-message" id="enderecoError">Por favor, insira um endereço válido</span>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-wrapper">
                        <input type="password" id="senha" name="senha" 
                               placeholder="Digite sua senha"
                               required
                               aria-required="true"
                               minlength="6"
                               maxlength="20">
                    </div>
                    <span class="help-text">A senha deve ter entre 6 e 20 caracteres</span>
                    <span class="error-message" id="senhaError">Por favor, insira uma senha válida</span>
                </div>
            </div>

            <input type="submit" name="btn" class="submit-button" id="submitButton" value="Cadastrar Aluno">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cadastroForm');
            const submitButton = document.getElementById('submitButton');

            // Validação em tempo real
            form.addEventListener('input', function(e) {
                const input = e.target;
                const errorMessage = document.getElementById(input.id + 'Error');
                
                if (input.checkValidity()) {
                    input.parentElement.parentElement.classList.remove('error');
                } else {
                    input.parentElement.parentElement.classList.add('error');
                }
            });

            // Validação no envio
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    // Mostrar mensagens de erro
                    const inputs = form.querySelectorAll('input[required]');
                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.parentElement.parentElement.classList.add('error');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>