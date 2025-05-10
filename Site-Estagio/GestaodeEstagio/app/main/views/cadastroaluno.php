<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ceara-green': '#008C45',
                        'ceara-orange': '#FFCA28',
                        'ceara-white': '#FFFFFF',
                        'ceara-light': '#E8F5E9',
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --text-color: #1A3C34;
            --border-color: #D1D5DB;
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            --success-color: #2ECC71;
            --error-color: #EF4444;
            --focus-ring: 0 0 0 3px rgba(255, 202, 40, 0.3);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #FFFFFF;
            color: var(--text-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: var(--shadow);
            border: 1px solid #E5E7EB;
            padding: 40px;
            margin: 20px;
            position: relative;
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            font-size: 1.1rem;
            color: #6B7280;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #9CA3AF;
            transition: var(--transition);
            pointer-events: none;
            font-weight: 400;
        }

        .form-group input:not(:placeholder-shown) + label,
        .form-group input:focus + label,
        .form-group select:not(:placeholder-shown) + label,
        .form-group select:focus + label {
            top: -10px;
            left: 12px;
            font-size: 0.85rem;
            color: #008C45;
            background: #FFFFFF;
            padding: 0 6px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: #F9FAFB;
            color: var(--text-color);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #FFCA28;
            box-shadow: var(--focus-ring);
            background-color: #FFFFFF;
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: #008C45;
        }

        .help-text {
            font-size: 0.875rem;
            color: #6B7280;
            margin-top: 6px;
            display: block;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 6px;
            display: none;
        }

        .form-group.error input {
            border-color: var(--error-color);
        }

        .form-group.error .error-message {
            display: block;
        }

        .submit-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #008C45 0%, #FFCA28 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
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
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #FFCA28 0%, #008C45 100%);
        }

        .submit-button:focus {
            outline: none;
            box-shadow: var(--focus-ring);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
            pointer-events: none;
        }

        .submit-button:active::after {
            width: 300px;
            height: 300px;
            transition: width 0.4s ease, height 0.4s ease;
        }

        .submit-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #FFFFFF;
            border: 2px solid #008C45;
            border-radius: 12px;
            color: #008C45;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            margin-bottom: 20px;
        }

        .back-button:hover {
            background: #008C45;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .back-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 140, 69, 0.3);
        }

        .accessibility-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .accessibility-btn {
            background: none;
            border: none;
            color: #6B7280;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .accessibility-btn:hover {
            color: #FFCA28;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
                margin: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            .accessibility-controls {
                position: static;
                justify-content: center;
                margin-bottom: 20px;
            }
        }

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

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

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
            border: 3px solid #FFFFFF;
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
    
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>

        <div class="header">
            <h1>Cadastro de Aluno</h1>
            <p>Preencha os dados para começar</p>
        </div>

        <form action="../controllers/Controller-cadastro_aluno.php" method="POST" autocomplete="off" aria-label="Formulário de cadastro de aluno" id="cadastroForm">
            <div class="form-grid">
                <div class="form-group">
                    <input type="text" id="nome" name="nome" 
                           placeholder=" "
                           required
                           aria-required="true"
                           minlength="3"
                           maxlength="100">
                    <label for="nome">Nome Completo</label>
                    <span class="error-message" id="nomeError">Por favor, insira um nome válido</span>
                </div>

                <div class="form-group">
                    <input type="text" id="matricula" name="matricula" 
                           placeholder=" "
                           required
                           aria-required="true"
                           pattern="[0-9]+"
                           minlength="6"
                           maxlength="20">
                    <label for="matricula">Matrícula</label>
                    <span class="error-message" id="matriculaError">Por favor, insira uma matrícula válida</span>
                </div>

                <div class="form-group">
                    <input type="tel" id="contato" name="contato" 
                           placeholder=" "
                           pattern="[0-9]{10,11}"
                           title="Digite apenas números (10 ou 11 dígitos)"
                           required
                           aria-required="true">
                    <label for="contato">Contato</label>
                    <span class="help-text">Digite apenas números (DDD + número)</span>
                    <span class="error-message" id="contatoError">Por favor, insira um número válido</span>
                </div>

                <div class="form-group">
                    <input type="text" id="curso" name="curso" 
                           placeholder=" "
                           required
                           aria-required="true"
                           minlength="3"
                           maxlength="100">
                    <label for="curso">Curso</label>
                    <span class="error-message" id="cursoError">Por favor, insira um curso válido</span>
                </div>

                <div class="form-group">
                    <input type="email" id="email" name="email" 
                           placeholder=" "
                           required
                           aria-required="true"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <label for="email">E-mail</label>
                    <span class="error-message" id="emailError">Por favor, insira um e-mail válido</span>
                </div>

                <div class="form-group">
                    <input type="text" id="endereco" name="endereco" 
                           placeholder=" "
                           required
                           aria-required="true"
                           minlength="5"
                           maxlength="200">
                    <label for="endereco">Endereço</label>
                    <span class="error-message" id="enderecoError">Por favor, insira um endereço válido</span>
                </div>

                <div class="form-group">
                    <input type="password" id="senha" name="senha" 
                           placeholder=" "
                           required
                           aria-required="true"
                           minlength="6"
                           maxlength="20">
                    <label for="senha">Senha</label>
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

            // Screen Reader Support
            let isReading = false;
            let currentSection = 0;
            const synth = window.speechSynthesis;
            let utterance = null;

            function toggleScreenReader() {
                if (isReading) {
                    stopReading();
                } else {
                    startReading();
                }
            }

            function startReading() {
                isReading = true;
                currentSection = 0;
                readNextSection();
                updateButtonState();
                window.addEventListener('scroll', handleScroll);
                document.addEventListener('click', handleElementClick);
                document.addEventListener('focus', handleElementFocus, true);
                announceStatus('Narração ativada');
            }

            function stopReading() {
                if (synth.speaking) {
                    synth.cancel();
                }
                isReading = false;
                updateButtonState();
                window.removeEventListener('scroll', handleScroll);
                document.removeEventListener('click', handleElementClick);
                document.removeEventListener('focus', handleElementFocus, true);
                announceStatus('Narração desativada');
            }

            function readNextSection() {
                const sections = document.querySelectorAll('section, article, div.section');
                if (currentSection < sections.length) {
                    const textToRead = sections[currentSection].innerText;
                    speakText(textToRead);
                } else {
                    stopReading();
                }
            }

            function handleScroll() {
                if (!isReading) return;

                const sections = document.querySelectorAll('section, article, div.section');
                const scrollPosition = window.scrollY + window.innerHeight / 2;

                for (let i = 0; i < sections.length; i++) {
                    const section = sections[i];
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        if (i !== currentSection) {
                            currentSection = i;
                            if (synth.speaking) {
                                synth.cancel();
                            }
                            readNextSection();
                        }
                        break;
                    }
                }
            }

            function updateButtonState() {
                const btn = document.getElementById('screenReaderBtn');
                if (isReading) {
                    btn.classList.add('text-ceara-orange');
                    btn.setAttribute('aria-label', 'Desativar narração de tela');
                } else {
                    btn.classList.remove('text-ceara-orange');
                    btn.setAttribute('aria-label', 'Ativar narração de tela');
                }
            }

            function announceStatus(message) {
                speakText(message);
            }

            function handleElementClick(event) {
                if (!isReading) return;

                const element = event.target;
                const textToSpeak = getElementDescription(element);

                if (textToSpeak) {
                    speakText(textToSpeak);
                }
            }

            function handleElementFocus(event) {
                if (!isReading) return;

                const element = event.target;
                const textToSpeak = getElementDescription(element);

                if (textToSpeak) {
                    speakText(textToSpeak);
                }
            }

            function getElementDescription(element) {
                if (element.tagName === 'IMG') {
                    return element.alt || 'Imagem sem descrição';
                } else if (element.tagName === 'A') {
                    return `Link: ${element.textContent || element.href}`;
                } else if (element.tagName === 'BUTTON') {
                    return `Botão: ${element.textContent || element.value || 'Sem texto'}`;
                } else if (element.tagName === 'INPUT') {
                    return `Campo de entrada: ${element.placeholder || element.name || 'Sem descrição'}`;
                } else {
                    return element.textContent || 'Elemento sem texto';
                }
            }

            function speakText(text) {
                if (synth.speaking) {
                    synth.cancel();
                }
                utterance = new SpeechSynthesisUtterance(text);

                const voices = synth.getVoices();
                const portugueseVoice = voices.find(voice => voice.lang === 'pt-BR');
                if (portugueseVoice) {
                    utterance.voice = portugueseVoice;
                }

                synth.speak(utterance);
            }

            const screenReaderBtn = document.getElementById('screenReaderBtn');
            screenReaderBtn.addEventListener('click', toggleScreenReader);

            document.addEventListener('keydown', function(event) {
                if (event.key === 'n' || event.key === 'N') {
                    toggleScreenReader();
                }
            });
        });
    </script>
</body>
</html>