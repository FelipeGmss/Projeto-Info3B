<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo Seletivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #2e4f4f; /* Verde musgo */
            --secondary-color: #1a3c34; /* Verde musgo escuro */
            --accent-color: #d94f04; /* Laranja escuro */
            --gray-dark: #333333; /* Cinza escuro */
            --button-green: #4CAF50; /* Verde para botão Salvar */
            --button-red: #ff4444; /* Vermelho para botão Cadastrar Vaga */
        }
        body {
            background-color: #e8ecef;
            color: var(--gray-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fonte mais moderna */
            line-height: 1.6;
        }
        .container {
            max-width: 960px; /* Largura máxima para melhor leitura */
        }
        .form-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 30px; /* Aumentei o padding */
            margin-bottom: 30px; /* Aumentei a margem */
            border: 1px solid #dee2e6; /* Adiciona uma borda sutil */
        }
        .btn-primary {
            background-color: var(--button-green);
            border-color: var(--button-green);
            transition: all 0.3s ease;
            padding: 10px 20px; /* Melhora o tamanho do botão */
            font-size: 1rem; /* Tamanho da fonte */
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .btn-accent {
            background-color: var(--button-red);
            border-color: var(--button-red);
            color: white;
            transition: all 0.3s ease;
            padding: 10px 20px; /* Melhora o tamanho do botão */
            font-size: 1rem; /* Tamanho da fonte */
        }
        .btn-accent:hover {
            background-color: #e03b3b;
            border-color: #e03b3b;
        }
        .form-label {
            color: var(--gray-dark);
            font-weight: 500;
            margin-bottom: 0.5rem; /* Espaçamento abaixo da label */
            display: block; /* Garante que a label ocupe toda a largura */
        }
        .form-control, .form-select {
            border-color: #ced4da;
            transition: border-color 0.3s ease;
            padding: 0.75rem; /* Aumenta o preenchimento interno */
            font-size: 1rem; /* Tamanho da fonte */
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(217, 79, 4, 0.25);
        }
        h2, h4 {
            color: var(--primary-color);
            margin-bottom: 1.5rem; /* Espaçamento abaixo dos títulos */
            font-weight: 600; /* Título mais destacado */
        }
        /* Estilos para feedback de erro */
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--button-red);
        }
        .invalid-feedback {
            color: var(--button-red);
            margin-top: 0.25rem; /* Espaçamento acima do feedback */
        }
        /* Estilos para feedback de sucesso */
        .form-control.is-valid, .form-select.is-valid {
            border-color: var(--button-green);
        }
        .valid-feedback {
            color: var(--button-green);
            margin-top: 0.25rem; /* Espaçamento acima do feedback */
        }
        /* Melhorias de responsividade */
        @media (max-width: 768px) {
            .col-md-6, .col-md-4, .col-md-3 {
                margin-bottom: 1rem; /* Espaçamento entre os campos em telas menores */
            }
        }
        /* Estilo para a textarea */
        textarea.form-control {
            resize: vertical; /* Permite redimensionamento vertical */
            height: 120px; /* Altura inicial */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5">Processo Seletivo</h2>
        
        <!-- Formulário Principal -->
        <div class="form-container">
            <h4 class="mb-4">Dados do Processo Seletivo</h4>
            <form action="../controllers/Controller-processo_seletivo.php" method="POST" id="processoSeletivoForm" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                        <div class="invalid-feedback">Por favor, insira a hora.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="local" class="form-label">Local</label>
                        <input type="text" class="form-control" id="local" name="local" required>
                        <div class="invalid-feedback">Por favor, insira o local.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="empresa_id" class="form-label">Empresa</label>
                        <select class="form-select" id="empresa_id" name="empresa_id" required>
                            <option value="">Selecione a empresa</option>
                            <?php
                            require_once "../models/cadastros.class.php";
                            $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
                            $consulta = 'SELECT * FROM concedentes ORDER BY nome ASC';
                            $query = $pdo->prepare($consulta);
                            $query->execute();
                            
                            while ($empresa = $query->fetch()) {
                                echo "<option value='" . htmlspecialchars($empresa['id']) . "'>" . htmlspecialchars($empresa['nome']) . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione a empresa.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                        <div class="invalid-feedback">Por favor, insira a data.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="aluno_id" class="form-label">Aluno</label>
                        <select class="form-select" id="aluno_id" name="aluno_id" required>
                            <option value="">Selecione o aluno</option>
                            <?php
                            $consulta = 'SELECT * FROM aluno ORDER BY nome ASC';
                            $query = $pdo->prepare($consulta);
                            $query->execute();
                            
                            while ($aluno = $query->fetch()) {
                                echo "<option value='" . htmlspecialchars($aluno['id']) . "'>" . htmlspecialchars($aluno['nome']) . " - " . htmlspecialchars($aluno['matricula']) . "</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione o aluno.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vaga_id" class="form-label">Vaga</label>
                        <select class="form-select" id="vaga_id" name="vaga_id" required>
                            <option value="">Selecione a vaga</option>
                            <?php
                            $consulta = 'SELECT id, nome, perfil, numero_vagas FROM concedentes WHERE numero_vagas > 0 ORDER BY nome ASC';
                            $query = $pdo->prepare($consulta);
                            $query->execute();
                            
                            while ($vaga = $query->fetch()) {
                                echo "<option value='" . htmlspecialchars($vaga['id']) . "'>" . 
                                     htmlspecialchars($vaga['nome']) . " - " . 
                                     htmlspecialchars($vaga['perfil']) . " (" . 
                                     htmlspecialchars($vaga['numero_vagas']) . " vagas)</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione a vaga.</div>
                    </div>
                </div>
                <button type="submit" name="btn" class="btn btn-primary">Salvar</button>
            </form>
        </div>

        <!-- Formulário de Vagas -->
        <div class="form-container">
            <h4 class="mb-4">Cadastro de Vagas</h4>
            <form action="../controllers/Controller-vaga_selecao.php" method="POST" id="cadastroVagasForm" novalidate>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="num_vagas" class="form-label">Número de Vagas</label>
                        <input type="number" class="form-control" id="num_vagas" name="num_vagas" value="" required>
                        <div class="invalid-feedback">Por favor, insira o número de vagas.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nome" class="form-label">Empresa Concedente</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                        <div class="invalid-feedback">Por favor, digite a empresa concedente.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="perfil" class="form-label">Perfil</label>
                        <textarea class="form-control" id="perfil" name="perfil" required></textarea>
                        <div class="invalid-feedback">Por favor, insira o perfil da vaga.</div>
                    </div>
                </div>
                <input type="submit" name="btn" class="btn btn-accent" value="Cadastrar Vagas">
            </form>
        </div>
    </div>

    <!-- Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Função para aplicar estilos de validação
        function applyValidationStyles(element, isValid) {
            if (isValid) {
                element.classList.remove('is-invalid');
                element.classList.add('is-valid');
            } else {
                element.classList.remove('is-valid');
                element.classList.add('is-invalid');
            }
        }

        // Validação do formulário de Processo Seletivo
        const processoSeletivoForm = document.getElementById('processoSeletivoForm');
        processoSeletivoForm.addEventListener('submit', function (event) {
            if (!processoSeletivoForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

                // Aplica estilos de validação para cada campo
                const horaInput = document.getElementById('hora');
                applyValidationStyles(horaInput, horaInput.checkValidity());

                const localInput = document.getElementById('local');
                applyValidationStyles(localInput, localInput.checkValidity());

                const empresaIdSelect = document.getElementById('empresa_id');
                applyValidationStyles(empresaIdSelect, empresaIdSelect.checkValidity());

                const dataInput = document.getElementById('data');
                applyValidationStyles(dataInput, dataInput.checkValidity());

                const alunoIdSelect = document.getElementById('aluno_id');
                applyValidationStyles(alunoIdSelect, alunoIdSelect.checkValidity());

                const vagaIdSelect = document.getElementById('vaga_id');
                applyValidationStyles(vagaIdSelect, vagaIdSelect.checkValidity());
            }

            processoSeletivoForm.classList.add('was-validated');
        });

        // Validação do formulário de Cadastro de Vagas
        const cadastroVagasForm = document.getElementById('cadastroVagasForm');
        cadastroVagasForm.addEventListener('submit', function (event) {
            if (!cadastroVagasForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();

                // Aplica estilos de validação para cada campo
                const numVagasInput = document.getElementById('num_vagas');
                applyValidationStyles(numVagasInput, numVagasInput.checkValidity());

                const nomeInput = document.getElementById('nome');
                applyValidationStyles(nomeInput, nomeInput.checkValidity());

                const perfilTextarea = document.getElementById('perfil');
                applyValidationStyles(perfilTextarea, perfilTextarea.checkValidity());
            }

            cadastroVagasForm.classList.add('was-validated');
        });
    </script>

    <?php
    // Exibe mensagens de erro/sucesso
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        $message = '';
        $type = 'danger';

        switch ($error) {
            case 'campos_vazios':
                $message = 'Por favor, preencha todos os campos.';
                break;
            case 'vaga_indisponivel':
                $message = 'Esta vaga não está mais disponível.';
                break;
            case 'aluno_ja_inscrito':
                $message = 'Este aluno já está inscrito nesta vaga.';
                break;
            case 'erro_criacao':
                $message = 'Erro ao criar o processo seletivo.';
                break;
            default:
                $message = 'Ocorreu um erro.';
        }

        echo "<div class='alert alert-$type alert-dismissible fade show mt-3' role='alert'>
                $message
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }

    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        $message = '';
        $type = 'success';

        switch ($success) {
            case 'processo_criado':
                $message = 'Processo seletivo criado com sucesso!';
                break;
            default:
                $message = 'Operação realizada com sucesso.';
        }

        echo "<div class='alert alert-$type alert-dismissible fade show mt-3' role='alert'>
                $message
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>
</body>
</html>