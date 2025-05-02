<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresa</title>
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

        /* Mensagem de Sucesso */
        .success-message {
            background-color: var(--success-color);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
            animation: fadeIn 0.5s ease-out;
        }

        .success-message.show {
            display: block;
        }

        /* Animações */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            animation: fadeIn 0.5s ease-out;
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

        /* Alto Contraste */
        @media (prefers-contrast: high) {
            :root {
                --text-color: #000;
                --border-color: #000;
            }

            .form-group input:focus,
            .form-group select:focus,
            .form-group textarea:focus {
                border-width: 3px;
            }
        }

        /* Redução de Movimento */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }

        /* Estilo para Checkboxes */
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            background-color: var(--light-bg);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .checkbox-option:hover {
            background-color: #e8f5e9;
        }

        .checkbox-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
            cursor: pointer;
        }

        .checkbox-option label {
            margin: 0;
            cursor: pointer;
            font-size: 15px;
            color: var(--text-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cadastro de Empresa</h1>
            <p>Preencha os dados da sua empresa para começar</p>
        </div>

        <form action="../controllers/Controller-cadastro_empresa.php" method="POST" autocomplete="off" id="empresaForm" aria-label="Formulário de cadastro de empresa">
            <div class="form-grid">
                <div class="form-group">
                    <label for="nome-empresa">Nome da Empresa</label>
                    <div class="input-wrapper">
                        <input type="text" id="nome-empresa" name="nome" 
                               placeholder="Digite o nome da empresa" 
                               required
                               aria-required="true" 
                               aria-label="Nome da empresa">
                    </div>
                    <span class="help-text">Nome completo da empresa conforme registro</span>
                </div>

                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-wrapper">
                        <input type="tel" id="contato" name="contato" 
                               placeholder="Digite o número de telefone"
                               aria-label="Informações de contato">
                    </div>
                    <span class="help-text">Digite apenas números (DDD + número)</span>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-wrapper">
                        <input type="text" id="endereco" name="endereco" 
                               placeholder="Endereço completo"
                               aria-label="Endereço da empresa">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="perfil">Perfil da Empresa</label>
                    <div class="input-wrapper">
                        <input type="text" id="perfil" name="perfil" 
                               placeholder="Descreva o perfil da empresa"
                               required
                               aria-required="true"
                               minlength="3"
                               maxlength="200">
                    </div>
               </div>

                <div class="form-group">
                    <label for="vagas">Número de Vagas</label>
                    <div class="input-wrapper">
                        <input type="number" id="vagas" name="numero_vagas" 
                               placeholder="Quantidade de vagas disponíveis"
                               required
                               aria-required="true"
                               min="1"
                               max="100">
                    </div>
                    </div>
             </div>

            <input type="submit" class="submit-button" name="btn" 
                   value="Cadastrar Empresa"
                   aria-label="Cadastrar empresa">
        </form>
    </div>
</body>
</html>