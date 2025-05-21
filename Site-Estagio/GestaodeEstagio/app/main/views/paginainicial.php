<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estágio</title>
    <link rel="icon" type="image/png" href="../config/img/logo_Salaberga-removebg-preview.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ceara-green': '#008C45',
                        'ceara-orange': '#FFA500',
                        'ceara-white': '#FFFFFF',
                        'ceara-moss': '#2d4739',
                        primary: '#008C45',
                        secondary: '#FFA500',
                    }
                }
            }
        }
    </script>
    <style>
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        @media (prefers-contrast: high) {
            :root {
                --text-color: #000;
                --border-color: #000;
            }
        }

        *:focus {
            outline: 3px solid #FFA500;
            outline-offset: 2px;
        }

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

        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
        }

        .header-moss {
            background: #2d4739;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-moss * {
            color: #fff !important;
        }

        .school-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .school-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-container {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            margin: 2rem auto;
            max-width: 1200px;
            padding: 2rem;
        }

        .card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.1);
        }

        .card-icon {
            background: rgba(0, 140, 69, 0.1);
            padding: 1rem;
            border-radius: 0.75rem;
            color: #008C45;
        }

        .btn-primary {
            background: linear-gradient(to right, #008C45, #FFA500);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #FFA500, #008C45);
            transform: translateY(-1px);
        }

        .btn-secondary {
            border: 2px solid #008C45;
            color: #008C45;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(to right, #008C45, #FFA500);
            color: white;
            border-color: transparent;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Cabeçalho verde musgo -->
    <header class="header-moss" role="banner">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                    <div class="bg-white/10 p-2 rounded-xl">
                        <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="school-logo">
                    </div>
                    <div>
                        <span class="school-name">EEEP Salaberga</span>
                        <h1 class="text-xl sm:text-2xl font-bold">Sistema de Gestão de Estágio</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-medium">Acessibilidade</span>
                    <button class="text-sm px-1 hover:text-ceara-orange transition-colors" aria-label="Diminuir tamanho do texto">
                        <i class="fa-solid fa-a"></i><b>-</b>
                    </button>
                    <button class="text-sm px-1 hover:text-ceara-orange transition-colors" aria-label="Tamanho padrão do texto">
                        <i class="fa-solid fa-a"></i>
                    </button>
                    <button class="text-sm px-1 hover:text-ceara-orange transition-colors" aria-label="Aumentar tamanho do texto">
                        <i class="fa-solid fa-a"></i><b>+</b>
                    </button>
                    <button id="screenReaderBtn" class="text-sm px-1 hover:text-ceara-orange transition-colors flex items-center" aria-label="Ativar narração de tela">
                        <i class="fa-solid fa-ear-listen mr-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container mx-auto px-4 py-8 fade-in">
        <div class="main-container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Seção de Relatórios -->
                <div class="card p-6">
                    <div class="flex items-center mb-6">
                        <div class="card-icon mr-4">
                            <i class="fas fa-chart-bar text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Relatórios</h2>
                    </div>
                    <div class="space-y-4">
                        <a href="../views/relatorios.php" class="block w-full py-3 px-4 btn-primary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-file-alt"></i>
                            Gerar Relatório
                        </a>
                        <a href="../views/processoseletivo.php" class="block w-full py-3 px-4 btn-secondary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-clipboard-list"></i>
                            Processo Seletivo
                        </a>
                    </div>
                </div>

                <!-- Seção de Alunos -->
                <div class="card p-6">
                    <div class="flex items-center mb-6">
                        <div class="card-icon mr-4">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Alunos</h2>
                    </div>
                    <div class="space-y-4">
                        <a href="../views/cadastroaluno.php" class="block w-full py-3 px-4 btn-primary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            Cadastrar Aluno
                        </a>
                        <a href="../views/perfildoaluno.php" class="block w-full py-3 px-4 btn-secondary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-user-circle"></i>
                            Ver Perfil do Aluno
                        </a>
                    </div>
                </div>

                <!-- Seção de Empresa -->
                <div class="card p-6">
                    <div class="flex items-center mb-6">
                        <div class="card-icon mr-4">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Empresa</h2>
                    </div>
                    <div class="space-y-4">
                        <a href="../views/cadastrodaempresa.php" class="block w-full py-3 px-4 btn-primary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-plus"></i>
                            Nova Empresa
                        </a>
                        <a href="../views/dadosempresa.php" class="block w-full py-3 px-4 btn-secondary rounded-xl flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i>
                            Editar Empresa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="bg-ceara-moss text-white shadow-lg mt-12">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm sm:text-base mb-4 sm:mb-0">© 2025 Sistema de Gestão de Estágio. Todos os direitos reservados.</p>
                <div class="flex space-x-6">
                    <a href="https://www.instagram.com/eeepsalabergampe/" class="text-gray-400 hover:text-ceara-orange transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Screen Reader Script -->
    <script>
        // Controle de tamanho do texto
        let currentFontSize = 16; // Tamanho base em pixels
        const minFontSize = 12;
        const maxFontSize = 24;
        const step = 2;

        // Função para atualizar o tamanho do texto
        function updateFontSize(delta) {
            currentFontSize = Math.min(Math.max(currentFontSize + delta, minFontSize), maxFontSize);
            document.documentElement.style.fontSize = `${currentFontSize}px`;
            
            // Salvar preferência no localStorage
            localStorage.setItem('preferredFontSize', currentFontSize);
            
            // Feedback visual
            const feedback = document.createElement('div');
            feedback.textContent = `Tamanho do texto: ${currentFontSize}px`;
            feedback.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #2d4739;
                color: white;
                padding: 8px 16px;
                border-radius: 4px;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s;
            `;
            document.body.appendChild(feedback);
            
            // Mostrar feedback
            setTimeout(() => feedback.style.opacity = '1', 10);
            setTimeout(() => {
                feedback.style.opacity = '0';
                setTimeout(() => feedback.remove(), 300);
            }, 2000);
        }

        // Configurar botões de tamanho do texto
        document.querySelectorAll('button[aria-label*="tamanho do texto"]').forEach(button => {
            button.addEventListener('click', () => {
                const delta = button.textContent.includes('+') ? step : 
                            button.textContent.includes('-') ? -step : 0;
                if (delta !== 0) {
                    updateFontSize(delta);
                } else {
                    // Botão de tamanho padrão
                    currentFontSize = 16;
                    updateFontSize(0);
                }
            });
        });

        // Carregar preferência salva
        const savedFontSize = localStorage.getItem('preferredFontSize');
        if (savedFontSize) {
            currentFontSize = parseInt(savedFontSize);
            updateFontSize(0);
        }

        // Narração de tela
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
            const sections = document.querySelectorAll('main > div, header, footer');
            if (currentSection < sections.length) {
                const textToRead = sections[currentSection].innerText;
                speakText(textToRead);
            } else {
                stopReading();
            }
        }

        function handleScroll() {
            if (!isReading) return;

            const sections = document.querySelectorAll('main > div, header, footer');
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

            // Configurar voz em português
            const voices = synth.getVoices();
            const portugueseVoice = voices.find(voice => voice.lang === 'pt-BR');
            if (portugueseVoice) {
                utterance.voice = portugueseVoice;
            }

            // Configurar velocidade e tom
            utterance.rate = 1.0;
            utterance.pitch = 1.0;
            utterance.volume = 1.0;

            synth.speak(utterance);
        }

        // Configurar botão de narração
        const screenReaderBtn = document.getElementById('screenReaderBtn');
        screenReaderBtn.addEventListener('click', toggleScreenReader);

        // Atalho de teclado para narração (tecla 'N')
        document.addEventListener('keydown', function(event) {
            if (event.key === 'n' || event.key === 'N') {
                toggleScreenReader();
            }
        });

        // Garantir que as vozes estejam carregadas
        if (speechSynthesis.onvoiceschanged !== undefined) {
            speechSynthesis.onvoiceschanged = () => {
                const voices = synth.getVoices();
                const portugueseVoice = voices.find(voice => voice.lang === 'pt-BR');
                if (portugueseVoice) {
                    utterance = new SpeechSynthesisUtterance('');
                    utterance.voice = portugueseVoice;
                }
            };
        }
    </script>
</body>
</html>