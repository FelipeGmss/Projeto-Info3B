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
                        primary: '#005A24',
                        'primary-dark': '#004a1d',
                        secondary: '#FF8C00',
                        'secondary-dark': '#e67e00',
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
            outline: 3px solid #005A24;
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-['Roboto']">
    <div class="container mx-auto px-4 py-4 md:py-8">
        <!-- Header Section -->
        <header class="bg-white rounded-2xl shadow-lg p-4 md:p-6 mb-4 md:mb-8">
            <div class="flex flex-col gap-4">
                <div class="mobile-text-center">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Dados dos Alunos</h1>
                    <p class="text-gray-600">Gerencie e visualize os dados dos alunos estagiários</p>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <form action="" method="GET" class="relative w-full md:w-64" role="search">
                        <label for="search" class="sr-only">Pesquisar alunos</label>
                        <input type="text" 
                               id="search"
                               name="search"
                               class="w-full px-4 py-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Pesquisar alunos..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                               aria-label="Pesquisar alunos">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                    </form>
                    <button class="w-full md:w-auto bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        <a href="../views/cadastroaluno.php" class="focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary">Novo Aluno</a>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 md:gap-8">
            <!-- Students List -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto mobile-table">
                        <table class="min-w-full" role="grid">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aluno</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                                    <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
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
                                    $consulta = 'SELECT * FROM aluno WHERE nome LIKE :search';
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
                                        echo "<tr class='hover:bg-gray-50 transition-colors cursor-pointer' onclick='showStudentDetails(" . json_encode($value) . ")' role='row'>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell'>";
                                        echo "<div class='flex items-center'>";
                                        echo "<div class='flex-shrink-0 h-8 w-8 md:h-10 md:w-10'>";
                                        echo "<img class='h-8 w-8 md:h-10 md:w-10 rounded-full' src='https://ui-avatars.com/api/?name=" . urlencode($value['nome']) . "' alt='Foto do aluno " . htmlspecialchars($value['nome']) . "'>";
                                        echo "</div>";
                                        echo "<div class='ml-2 md:ml-4'>";
                                        echo "<div class='text-sm font-medium text-gray-900'>" . htmlspecialchars($value['nome']) . "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['matricula']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['contato']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap' role='cell'>";
                                        echo "<div class='text-sm text-gray-900'>" . htmlspecialchars($value['curso']) . "</div>";
                                        echo "</td>";
                                        echo "<td class='px-4 md:px-6 py-3 md:py-4 whitespace-nowrap text-sm font-medium' role='cell'>";
                                        echo "<div class='flex items-center gap-2'>";
                                        echo "<form action='editar_aluno.php' method='GET' style='display: inline;'>";
                                        echo "<input type='hidden' name='btn' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-secondary hover:text-secondary-dark' aria-label='Editar aluno " . htmlspecialchars($value['nome']) . "'>";
                                        echo "<i class='fas fa-edit' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "<form action='../controllers/Controller-excluir_alunos.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir este aluno?\");'>";
                                        echo "<input type='hidden' name='btn' value='" . htmlspecialchars($value['id']) . "'>";
                                        echo "<button type='submit' class='text-red-600 hover:text-red-800' aria-label='Excluir aluno " . htmlspecialchars($value['nome']) . "'>";
                                        echo "<i class='fas fa-trash' aria-hidden='true'></i>";
                                        echo "</button>";
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='px-4 md:px-6 py-3 md:py-4 text-center text-gray-500' role='cell'>Nenhum aluno cadastrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Student Details Sidebar -->
            <div class="lg:col-span-1">
                <div id="studentDetails" class="bg-white rounded-2xl shadow-lg p-4 md:p-6 sticky top-4 md:top-8 hidden" role="complementary" aria-label="Detalhes do aluno">
                    <div class="flex justify-between items-center mb-4 md:mb-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-800">Detalhes do Aluno</h2>
                        <button onclick="closeDetails()" class="text-gray-500 hover:text-gray-700" aria-label="Fechar detalhes">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        <div class="flex justify-center">
                            <img id="studentImage" class="h-16 w-16 md:h-24 md:w-24 rounded-full" src="" alt="" role="img">
                        </div>
                        <div>
                            <h3 id="studentName" class="text-base md:text-lg font-semibold text-gray-800 mb-2"></h3>
                            <p id="studentCourse" class="text-sm md:text-base text-gray-600"></p>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Matrícula</label>
                                <p id="studentRegistration" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Contato</label>
                                <p id="studentContato" class="mt-1 text-sm text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showStudentDetails(student) {
            const detailsDiv = document.getElementById('studentDetails');
            detailsDiv.classList.remove('hidden');
            
            document.getElementById('studentImage').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(student.nome)}`;
            document.getElementById('studentImage').alt = `Foto do aluno ${student.nome}`;
            document.getElementById('studentName').textContent = student.nome;
            document.getElementById('studentCourse').textContent = student.curso;
            document.getElementById('studentRegistration').textContent = student.matricula;
            document.getElementById('studentContato').textContent = student.contato;
        }

        function closeDetails() {
            document.getElementById('studentDetails').classList.add('hidden');
        }

        // Adiciona suporte a teclado para navegação
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetails();
            }
        });
    </script>
</body>
</html>