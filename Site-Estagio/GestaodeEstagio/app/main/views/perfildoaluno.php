<?php
require("../models/model-function.php");
$x = new Cadastro();
$pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");

// Verifica se há mensagem de resultado
if (isset($_GET['resultado'])) {
    $mensagem = '';
    $tipo = '';
    
    switch($_GET['resultado']) {
        case 'excluir':
            $mensagem = 'Aluno excluído com sucesso!';
            $tipo = 'success';
            break;
        case 'erro':
            $mensagem = 'Ocorreu um erro ao processar a operação.';
            $tipo = 'error';
            break;
        case 'editar':
            $mensagem = 'Aluno atualizado com sucesso!';
            $tipo = 'success';
            break;
    }
}
?>
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
        /* Estilos do arquivo original mantidos */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f3f4f6;
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
        }
    </style>
</head>
<body class="min-h-screen font-['Roboto'] select-none">
    <!-- Cabeçalho -->
    <header class="header w-full mb-4">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
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

    <!-- Mensagens de resultado -->
    <?php if (isset($mensagem)): ?>
        <div class="container mx-auto px-4 mb-4">
            <div class="p-4 rounded-lg <?php echo $tipo === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                <?php echo htmlspecialchars($mensagem); ?>
            </div>
        </div>
    <?php endif; ?>

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
        function showStudentDetails(student) {
            // Implementar modal de detalhes se necessário
            console.log('Detalhes do aluno:', student);
        }
    </script>
</body>
</html>
