<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
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
            gap: 15px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        /* Campos do Formulário */
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            color: var(--text-color);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group .input-wrapper {
            position: relative;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: var(--light-bg);
        }

        /* Estados de Foco e Hover */
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: var(--focus-ring);
            background-color: var(--white);
        }

        .form-group input:hover,
        .form-group select:hover,
        .form-group textarea:hover {
            border-color: var(--primary-color);
        }

        /* Mensagens de Ajuda */
        .help-text {
            font-size: 14px;
            color: var(--text-light);
            margin-top: 6px;
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
            margin-top: 15px;
            transition: all 0.3s ease;
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

        /* Botão Voltar */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--white);
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            color: var(--primary-color);
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 25px 20px;
                margin: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .header {
                margin-bottom: 25px;
            }

            .header h1 {
                font-size: 26px;
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
            <h1>Editar Aluno</h1>
            <p>Atualize os dados do aluno</p>
        </div>

        <form action="../controllers/Controller-editar_alunos.php" method="POST" autocomplete="off" id="alunoForm" aria-label="Formulário de edição de aluno">
            <input type="hidden" name="id" value="<?php echo $dados_aluno['id'] ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <div class="input-wrapper">
                        <input type="text" id="nome" name="nome" 
                               value="<?php echo htmlspecialchars($dados_aluno['nome']) ?>"
                               placeholder="Digite o nome completo" 
                               required
                               aria-required="true"
                               minlength="3"
                               maxlength="100">
                    </div>
                </div>

                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <div class="input-wrapper">
                        <input type="text" id="matricula" name="matricula" 
                               value="<?php echo htmlspecialchars($dados_aluno['matricula']) ?>"
                               placeholder="Digite a matrícula"
                               required
                               aria-required="true"
                               pattern="[0-9]+"
                               minlength="6"
                               maxlength="20">
                    </div>
                </div>

                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-wrapper">
                        <input type="tel" id="contato" name="contato" 
                               value="<?php echo htmlspecialchars($dados_aluno['contato']) ?>"
                               placeholder="Digite o número de telefone"
                               required
                               aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="curso">Curso</label>
                    <div class="input-wrapper">
                        <input type="text" id="curso" name="curso" 
                               value="<?php echo htmlspecialchars($dados_aluno['curso']) ?>"
                               placeholder="Digite o curso"
                               required
                               aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" 
                               value="<?php echo htmlspecialchars($dados_aluno['email']) ?>"
                               placeholder="Digite o e-mail"
                               required
                               aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-wrapper">
                        <input type="text" id="endereco" name="endereco" 
                               value="<?php echo htmlspecialchars($dados_aluno['endereco']) ?>"
                               placeholder="Digite o endereço"
                               required
                               aria-required="true">
                    </div>
                </div>
            </div>

            <input type="submit" class="submit-button" name="btn-editar" 
                   value="Salvar Alterações"
                   aria-label="Salvar alterações do aluno">
        </form>
    </div>
</body>
</html> 