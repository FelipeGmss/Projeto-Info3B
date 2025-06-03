<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados dos Alunos</title>
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
                        'ceara-moss': '#2d4739',
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
            background: #f3f4f6;
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
            gap: 6px;
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #FFFFFF;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            backdrop-filter: blur(4px);
        }
        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .back-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
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

        .header-moss {
            background: #2d4739;
        }
        .header-moss * {
            color: #fff !important;
        }
        .header-moss input,
        .header-moss input:focus {
            color: #222 !important;
            background: #fff !important;
        }
        .header-moss .fa-search {
            color: #888 !important;
        }

        .main-list-container {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            margin: 0 auto;
            max-width: 1200px;
            padding: 2rem;
        }

        .table th, .table td {
            white-space: normal !important;
        }

        @media (max-width: 900px) {
            .main-list-container {
                padding: 1rem;
            }
        }
        @media (max-width: 600px) {
            .main-list-container {
                padding: 0.5rem;
            }
        }

        .header {
            background: #2d4739;
            padding: 0.5rem 0;
        }

        .header * {
            color: #ffffff !important;
        }

        .transparent-button {
            background: none;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
            color: #ffffff;
        }

        .transparent-button:hover {
            color: #FFA500;
            transform: translateY(-1px);
        }

        .search-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            margin: 0.75rem 0;
        }

        .search-input {
            background: #ffffff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.3);
        }

        .table-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-header {
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        .action-button {
            padding: 0.4rem;
            border-radius: 0.4rem;
            transition: all 0.2s ease;
            border: none;
            background: none;
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .card {
            display: none;
        }

        @media (max-width: 768px) {
            .table-container {
                display: none;
            }

            .card {
                display: block;
                background: white;
                border-radius: 0.75rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                margin-bottom: 1rem;
                padding: 1rem;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .card-content {
                padding: 0.5rem;
            }

            .card-actions {
                display: flex;
                justify-content: flex-end;
                gap: 0.5rem;
                margin-top: 0.75rem;
            }
        }
    </style>
</head>
<body class="min-h-screen font-['Roboto'] select-none">
    <!-- Cabeçalho -->
    <header class="header w-full mb-4">
        <div class="container mx-auto px-4">
            <!-- Main header content -->
            <div class="flex items-center justify-between">
                <!-- Left section with back button, logo and school name -->
                <div class="flex items-center gap-3">
                    <a href="javascript:history.back()" class="transparent-button">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <img src="../config/img/logo_Salaberga-removebg-preview.png" alt="Logo EEEP Salaberga" class="w-10 h-10 object-contain">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium">EEEP Salaberga</span>
                        <h1 class="text-lg font-bold">Dados dos Alunos</h1>
                    </div>
                </div>

                <!-- Right section with action buttons -->
                <div class="flex gap-2">
                    <a href="../views/relatorios/relatorio_alunos.php" class="transparent-button">
                        <i class="fas fa-file-pdf"></i> Gerar PDF
                    </a>
                    <a href="../views/cadastroaluno.php" class="transparent-button">
                        <i class="fas fa-plus"></i> Novo Aluno
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="container mx-auto px-4">
        <div class="search-container">
            <form action="" method="GET" class="relative" role="search">
                <label for="search" class="sr-only">Pesquisar alunos</label>
                <input type="text" 
                       id="search"
                       name="search"
                       class="search-input"
                       placeholder="Pesquisar por nome, matrícula, curso..."
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                       aria-label="Pesquisar alunos">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-4">
        <!-- Table View (Desktop) -->
        <div class="table-container">
            <table class="min-w-full">
                <thead class="table-header">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aluno</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Matrícula</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Contato</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Curso</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Endereço</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    require("../models/model-function.php");
                    $x = new Cadastro();
                    $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                    
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    if (!empty($search)) {
                        $consulta = 'SELECT * FROM aluno WHERE 
                                    nome LIKE :search OR 
                                    matricula LIKE :search OR 
                                    curso LIKE :search OR 
                                    email LIKE :search OR 
                                    contato LIKE :search OR 
                                    endereco LIKE :search';
                        $query = $pdo->prepare($consulta);
                        $query->bindValue(':search', '%' . $search . '%');
                    } else {
                        $consulta = 'SELECT * FROM aluno';
                        $query = $pdo->prepare($consulta);
                    }
                    
                    $query->execute();
                    $result = $query->rowCount();

                    if ($result > 0) {
                        foreach ($query as $value) {
                            echo "<tr class='table-row cursor-pointer hover:bg-gray-50' onclick='showStudentDetails(" . json_encode($value) . ")'>";
                            echo "<td class='px-4 py-3'>";
                            echo "<div class='flex items-center'>";
                            echo "<div class='flex-shrink-0 h-8 w-8'>";
                            echo "<img class='h-8 w-8 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Foto do aluno " . htmlspecialchars($value['nome']) . "'>";
                            echo "</div>";
                            echo "<div class='ml-3'>";
                            echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['nome']) . "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['matricula']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['contato']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['curso']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['email']) . "</td>";
                            echo "<td class='px-4 py-3 text-sm text-gray-900'>" . htmlspecialchars($value['endereco']) . "</td>";
                            echo "<td class='px-4 py-3 text-center' onclick='event.stopPropagation();'>";
                            echo "<div class='flex justify-center gap-2'>";
                            echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                            echo "<input type='hidden' name='btn-editar' value='" . htmlspecialchars($value['id']) . "'>";
                            echo "<button type='submit' class='text-ceara-orange hover:text-ceara-green' aria-label='Editar aluno " . htmlspecialchars($value['nome']) . "'>";
                            echo "<i class='fas fa-edit'></i>";
                            echo "</button>";
                            echo "</form>";
                            echo "<form action='../controllers/Controller-Exclusoes.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir este aluno?\");'>";
                            echo "<input type='hidden' name='tipo' value='aluno'>";
                            echo "<button type='submit' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "' class='text-red-600 hover:text-red-800 bg-red-50 rounded-full p-2 transition-colors' title='Excluir aluno' aria-label='Excluir aluno'><i class='fas fa-trash'></i></button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='px-4 py-3 text-center text-gray-500'>Nenhum aluno cadastrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Card View (Mobile) -->
        <div class="md:hidden">
            <?php
            if ($result > 0) {
                foreach ($query as $value) {
                    echo "<div class='card'>";
                    echo "<div class='card-content'>";
                    echo "<div class='flex items-center gap-3 mb-2'>";
                    echo "<img class='h-10 w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Foto do aluno " . htmlspecialchars($value['nome']) . "'>";
                    echo "<div>";
                    echo "<p class='text-lg font-semibold text-gray-800'>" . htmlspecialchars($value['nome']) . "</p>";
                    echo "<p class='text-sm text-gray-600'>" . htmlspecialchars($value['matricula']) . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-phone mr-2'></i>" . htmlspecialchars($value['contato']) . "</p>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-graduation-cap mr-2'></i>" . htmlspecialchars($value['curso']) . "</p>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-envelope mr-2'></i>" . htmlspecialchars($value['email']) . "</p>";
                    echo "<p class='text-sm text-gray-600'><i class='fas fa-map-marker-alt mr-2'></i>" . htmlspecialchars($value['endereco']) . "</p>";
                    echo "</div>";
                    echo "<div class='card-actions'>";
                    echo "<form action='../controllers/Controller-botao_acao.php' method='GET' style='display: inline;'>";
                    echo "<input type='hidden' name='btn-editar' value='" . htmlspecialchars($value['id']) . "'>";
                    echo "<button type='submit' class='bg-gradient-to-r from-ceara-orange to-ceara-green hover:from-ceara-green hover:to-ceara-orange text-white px-3 py-1 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-1 text-sm whitespace-nowrap' aria-label='Editar aluno " . htmlspecialchars($value['nome']) . "'>";
                    echo "<i class='fas fa-edit'></i> Editar";
                    echo "</button>";
                    echo "</form>";
                    echo "<form action='../controllers/Controller-Exclusoes.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir este aluno?\");'>";
                    echo "<input type='hidden' name='tipo' value='aluno'>";
                    echo "<button type='submit' name='btn-excluir' value='" . htmlspecialchars($value['id']) . "' class='action-button text-red-600 hover:text-red-800 bg-red-50' title='Excluir aluno' aria-label='Excluir aluno'><i class='fas fa-trash'></i></button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<div class='card'><div class='card-content'><p class='text-center text-gray-500'>Nenhum aluno cadastrado</p></div></div>";
            }
            ?>
        </div>
    </div>

    <script>
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
            document.addEventListener('click', handleElementClick);
            document.addEventListener('focus', handleElementFocus, true);
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