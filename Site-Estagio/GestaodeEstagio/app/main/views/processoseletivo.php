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
        }
        .form-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 25px;
            margin-bottom: 25px;
        }
        .btn-primary {
            background-color: var(--button-green);
            border-color: var(--button-green);
            transition: all 0.3s ease;
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
        }
        .btn-accent:hover {
            background-color: #e03b3b;
            border-color: #e03b3b;
        }
        .form-label {
            color: var(--gray-dark);
            font-weight: 500;
        }
        .form-control, .form-select {
            border-color: #ced4da;
            transition: border-color 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(217, 79, 4, 0.25);
        }
        h2, h4 {
            color: var(--primary-color);
        }
        /* Estilos para feedback de erro */
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--button-red);
        }
        .invalid-feedback {
            color: var(--button-red);
        }
        /* Estilos para feedback de sucesso */
        .form-control.is-valid, .form-select.is-valid {
            border-color: var(--button-green);
        }
        .valid-feedback {
            color: var(--button-green);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-5">Processo Seletivo</h2>
        
        <!-- Formulário Principal -->
        <div class="form-container">
            <h4 class="mb-4">Dados do Processo Seletivo</h4>
            <form action="#" method="POST" id="processoSeletivoForm" novalidate>
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
                            <option value="1">Empresa A</option>
                            <option value="2">Empresa B</option>
                            <option value="3">Empresa C</option>
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
                            <option value="1">Aluno A</option>
                            <option value="2">Aluno B</option>
                            <option value="3">Aluno C</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione o aluno.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vaga_id" class="form-label">Vaga</label>
                        <select class="form-select" id="vaga_id" name="vaga_id" required>
                            <option value="">Selecione a vaga</option>
                            <option value="1">Vaga A</option>
                            <option value="2">Vaga B</option>
                            <option value="3">Vaga C</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione a vaga.</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>

        <!-- Formulário de Vagas -->
        <div class="form-container">
            <h4 class="mb-4">Cadastro de Vagas</h4>
            <form action="../controllers/Controller-vaga_selecao.php" method="POST" id="cadastroVagasForm" novalidate>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="num_vagas" class="form-label">Número de Vagas</label>
                        <input type="number" class="form-control" id="num_vagas" name="num_vagas" required>
                        <div class="invalid-feedback">Por favor, insira o número de vagas.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="concedente_id" class="form-label">Empresa Concedente</label>
                        <select class="form-select" id="concedente_id" name="id" required>
                            <option value="">Selecione a empresa</option>
                            <option value="1">Empresa A</option>
                            <option value="2">Empresa B</option>
                            <option value="3">Empresa C</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecione a empresa concedente.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="perfil" class="form-label">Perfil</label>
                        <textarea class="form-control" id="perfil" name="perfil" rows="4" required></textarea>
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

                const concedenteIdSelect = document.getElementById('concedente_id');
                applyValidationStyles(concedenteIdSelect, concedenteIdSelect.checkValidity());

                const perfilTextarea = document.getElementById('perfil');
                applyValidationStyles(perfilTextarea, perfilTextarea.checkValidity());
            }

            cadastroVagasForm.classList.add('was-validated');
        });
    </script>
</body>
</html>