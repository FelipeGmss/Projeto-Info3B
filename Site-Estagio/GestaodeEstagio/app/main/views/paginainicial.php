<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Estágio</title>
    <link rel="icon" type="image/png" href="../config/img/logo_Salaberga-removebg-preview.png" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ceara-green': '#008C45',
                        'ceara-orange': '#FFA500',
                        'ceara-white': '#FFFFFF',
                        primary: '#008C45',
                        secondary: '#FFA500',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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
        .accessibility-btn {
            transition: all 0.3s ease;
        }
        .accessibility-btn:hover {
            color: #FFA500;
        }
        .modal-button {
            opacity: 0.7;
            transition: opacity 0.2s ease-in-out;
        }
        .modal-button:hover {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-ceara-green to-ceara-orange min-h-screen select-none">
    <div class="min-h-screen flex flex-col">
        <!-- Cabeçalho -->
        <header class="bg-ceara-white/90 backdrop-blur-sm shadow-lg sticky top-0 z-50">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="bg-primary/10 p-2 rounded-xl">
                            <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo" class="h-8 w-8 sm:h-10 sm:w-10">
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Sistema de Gestão de Estágio</h1>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-600"><b>Acessibilidade</b></span>
                        <button class="text-sm accessibility-btn text-gray-600 px-1" aria-label="Diminuir tamanho do texto">
                            <i class="fa-solid fa-a"></i><b>-</b>
                        </button>
                        <button class="text-sm accessibility-btn text-gray-600 px-1" aria-label="Tamanho padrão do texto">
                            <i class="fa-solid fa-a"></i>
                        </button>
                        <button class="text-sm accessibility-btn text-gray-600 px-1" aria-label="Aumentar tamanho do texto">
                            <i class="fa-solid fa-a"></i><b>+</b>
                        </button>
                        <button id="screenReaderBtn" class="text-sm accessibility-btn text-gray-600 px-1 flex items-center" aria-label="Ativar narração de tela">
                            <i class="fa-solid fa-ear-listen mr-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Conteúdo Principal -->
        <main class="flex-grow container mx-auto px-4 py-8 fade-in">
            <div class="w-full max-w-7xl mx-auto bg-ceara-white/90 backdrop-blur-sm rounded-3xl shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Seção de Relatórios -->
                    <div class="bg-ceara-white rounded-2xl shadow-lg p-6 hover:shadow-xl hover-scale transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-ceara-green/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-chart-bar text-ceara-green text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Relatórios</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/relatorios.php" class="block w-full py-3 px-4 bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-file-alt"></i>
                                Gerar Relatório
                            </a>
                            <a href="../views/processoseletivo.php" class="block w-full py-3 px-4 border-2 border-ceara-green text-ceara-green hover:bg-gradient-to-r hover:from-ceara-green hover:to-ceara-orange hover:text-ceara-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-clipboard-list"></i>
                                Processo Seletivo
                            </a>
                        </div>
                    </div>

                    <!-- Seção de Alunos -->
                    <div class="bg-ceara-white rounded-2xl shadow-lg p-6 hover:shadow-xl hover-scale transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-ceara-green/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-user-graduate text-ceara-green text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Alunos</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/cadastroaluno.php" class="block w-full py-3 px-4 bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-user-plus"></i>
                                Cadastrar Aluno
                            </a>
                            <a href="../views/perfildoaluno.php" class="block w-full py-3 px-4 border-2 border-ceara-green text-ceara-green hover:bg-gradient-to-r hover:from-ceara-green hover:to-ceara-orange hover:text-ceara-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                Ver Perfil do Aluno
                            </a>
                        </div>
                    </div>

                    <!-- Seção de Empresa -->
                    <div class="bg-ceara-white rounded-2xl shadow-lg p-6 hover:shadow-xl hover-scale transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="bg-ceara-green/10 p-3 rounded-xl mr-4">
                                <i class="fas fa-building text-ceara-green text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Empresa</h2>
                        </div>
                        <div class="space-y-4">
                            <a href="../views/cadastrodaempresa.php" class="block w-full py-3 px-4 bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white font-medium rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i>
                                Nova Empresa
                            </a>
                            <a href="../views/dadosempresa.php" class="block w-full py-3 px-4 border-2 border-ceara-green text-ceara-green hover:bg-gradient-to-r hover:from-ceara-green hover:to-ceara-orange hover:text-ceara-white font-medium rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-edit"></i>
                                Editar Empresa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Rodapé -->
        <footer class="bg-gradient-to-b from-black via-[#000] to-black text-ceara-white shadow-lg mt-12">
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
    </div>

    <!-- Screen Reader Script -->
    <script>
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
    </script>
</body>
</html>