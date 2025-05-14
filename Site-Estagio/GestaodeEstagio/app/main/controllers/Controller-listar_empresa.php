<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados das Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        /* Melhorias de Acessibilidade */
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

        /* Estilos para foco visível */
        *:focus {
            outline: 3px solid #FFA500;
            outline-offset: 2px;
        }

        /* Melhor contraste para leitores de tela */
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

        /* Ajustes para mobile */
        @media (max-width: 768px) {
            .mobile-stack {
                display: flex;
                flex-direction: column;
            }
            
            .mobile-full {
                width: 100%;
            }
            
            .mobile-padding {
                padding: 1rem;
            }
            
            .mobile-text-center {
                text-align: center;
            }
            
            .mobile-margin {
                margin-bottom: 1rem;
            }
            
            .mobile-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .mobile-table th,
            .mobile-table td {
                min-width: 120px;
            }
            
            .mobile-hidden {
                display: none;
            }
            
            .mobile-visible {
                display: block;
            }
        }

        /* Estilos do EEEP Salaberga */
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
        .table-row:hover {
            background-color: rgba(255, 165, 0, 0.1);
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
            transition: all 0.3s ease;
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
    </style>
</head>
<body class="bg-gradient-to-br from-ceara-green to-ceara-orange min-h-screen font-['Roboto'] select-none">
    <div class="container mx-auto px-4 py-4 md:py-8 fade-in">
        <!-- Header Section -->
        <header class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 md:p-6 mb-4 md:mb-8">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col sm:flex-row justify-between items-center mobile-text-center">
                    <div>
                        <a href="javascript:history.back()" class="back-button">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Dados das Empresas</h1>
                        <p class="text-gray-600">Gerencie e visualize os dados das empresas parceiras</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <form action="" method="GET" class="relative w-full md:w-64" role="search">
                        <label for="search" class="sr-only">Pesquisar empresas</label>
                        <input type="text" 
                               id="search"
                               name="search"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-ceara-orange focus:border-transparent"
                               placeholder="Pesquisar empresas, contato, endereço ou perfil..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               aria-label="Pesquisar empresas">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                    </form>
                    <a href="../views/relatorio.php<?php echo isset($_GET['search']) && $_GET['search'] != '' ? '?search=' . urlencode($_GET['search']) : ''; ?>" class="w-full md:w-auto bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 hover-scale">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                        Gerar PDF
                    </a>
                    <a href="../views/cadastrodaempresa.php" class="w-full md:w-auto bg-gradient-to-r from-ceara-green to-ceara-orange hover:from-ceara-orange hover:to-ceara-green text-ceara-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 hover-scale">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        Nova Empresa
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Companies List -->
            <div class="lg:col-span-3">
                <div class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto mobile-table">
                        <table class="min-w-full" role="grid">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perfil</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vagas</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php
                                require("../models/cadastros.class.php");
                                $x = new Cadastro();
                                $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                                
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                if (!empty($search)) {
                                    $consulta = 'SELECT * FROM concedentes WHERE nome LIKE :search OR contato LIKE :search OR endereco LIKE :search OR perfil LIKE :search';
                                    $query = $pdo->prepare($consulta);
                                    $query->bindValue(':search', '%' . $search . '%');
                                } else {
                                    $consulta = 'SELECT * FROM concedentes';
                                    $query = $pdo->prepare($consulta);
                                }
                                
                                $query->execute();
                                $result = $query->rowCount();

                                if ($result > 0) {
                                    foreach ($query as $value) {
                                        echo "<tr class='table-row hover:bg-gray-50 transition-colors cursor-pointer' role='row'>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='flex items-center'>";
                                        echo "<div class='flex-shrink-0 h-8 w-8 md:h-10 md:w-10'>";
                                        echo "<img class='h-8 w-8 md:h-10 md:w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Logo da empresa " . htmlspecialchars($value['nome']) . "'>";
                                        echo "</div>";
                                        echo "<div class='ml-2 md:ml-4'>";
                                        echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['nome']) . "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['contato']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['endereco']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['perfil']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell' onclick='showCompanyDetails(" . json_encode($value) . ")'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['numero_vagas']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium' role='cell'>";
                                        echo "<div class='flex items-center gap-2'>";
                                        echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                                        echo "<input type='hidden' name='btn-editar' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar empresa " . htmlspecialchars($value['nome']) . "'>";
                                        echo "<i class='fas fa-edit' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "<form action='../controllers/Controller-excluir_empresa.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir esta empresa?\");'>";
                                        echo "<input type='hidden' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir empresa " . htmlspecialchars($value['nome']) . "'>";
                                        echo "<i class='fas fa-trash' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='px-4 md:px-6 py-3 md:py-4 text-center text-gray-500' role='cell'>Nenhuma empresa cadastrada</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Company Details Sidebar -->
            <div class="lg:col-span-1">
                <div id="companyDetails" class="bg-ceara-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-4 md:p-6 sticky top-4 md:top-8 hidden" role="complementary" aria-label="Detalhes da empresa">
                    <div class="flex justify-between items-center mb-4 md:mb-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Detalhes da Empresa</h2>
                        <button onclick="closeDetails()" class="text-gray-500 hover:text-ceara-orange" aria-label="Fechar detalhes">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        <div class="flex justify-center">
                            <img id="companyImage" class="h-16 w-16 md:h-24 md:w-24 rounded-full" src="" alt="" role="img">
                        </div>
                        <div>
                            <h3 id="companyName" class="text-base md:text-lg font-semibold text-gray-800 mb-2"></h3>
                            <p id="companyProfile" class="text-sm md:text-base text-gray-600"></p>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Contato</label>
                                <p id="companyContact" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Endereço</label>
                                <p id="companyAddress" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Vagas Ativas</label>
                                <p id="companyVacancies" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function showCompanyDetails(company) {
            const detailsDiv = document.getElementById('companyDetails');
            detailsDiv.classList.remove('hidden');
            
            document.getElementById('companyImage').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(company.nome)}`;
            document.getElementById('companyImage').alt = `Logo da empresa ${company.nome}`;
            document.getElementById('companyName').textContent = company.nome;
            document.getElementById('companyProfile').textContent = company.perfil;
            document.getElementById('companyContact').textContent = company.contato;
            document.getElementById('companyAddress').textContent = company.endereco;
            document.getElementById('companyVacancies').textContent = company.numero_vagas;
        }

        function generatePDF() {
            const element = document.querySelector('.overflow-x-auto');
            const opt = {
                margin: 1,
                filename: 'lista_empresas.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
            };

            html2pdf().set(opt).from(element).save();
        }

        function closeDetails() {
            document.getElementById('companyDetails').classList.add('hidden');
        }

        // Adiciona suporte a teclado para navegação
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetails();
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
    </script>
</body>
</html>