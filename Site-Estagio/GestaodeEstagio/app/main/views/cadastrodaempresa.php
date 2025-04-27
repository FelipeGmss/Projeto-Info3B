<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empresa</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Cores */
        :root {
            --primary-color: #4caf50;
            --text-color: #333;
            --light-bg: #f5f5f5;
            --white: #fff;
            --border-color: #ddd;
            --shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
        }

        .container {
            max-width: 600px; /* Aumentei a largura máxima */
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px; /* Aumentei o padding */
            text-align: left;
        }

        h1 {
            font-size: 28px; /* Aumentei o tamanho da fonte */
            color: var(--text-color);
            margin-bottom: 30px; /* Aumentei a margem */
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px; /* Aumentei a margem */
        }

        .form-group label {
            font-size: 16px; /* Aumentei o tamanho da fonte */
            color: #666;
            display: block;
            margin-bottom: 8px; /* Aumentei a margem */
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px; /* Aumentei o padding */
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px; /* Aumentei o tamanho da fonte */
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-group textarea {
            height: 120px; /* Aumentei a altura */
            resize: vertical; /* Permite redimensionar verticalmente */
        }

        .submit-button {
            width: 100%;
            padding: 14px; /* Aumentei o padding */
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 18px; /* Aumentei o tamanho da fonte */
            cursor: pointer;
            margin-top: 20px; /* Aumentei a margem */
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #43a047; /* Cor ligeiramente mais escura */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Empresa</h1>

        <form>
            <div class="form-group">
                <label for="nome-empresa">Nome da Empresa:</label>
                <input type="text" id="nome-empresa" name="nome-empresa" placeholder="Nome da Empresa">
            </div>

            <div class="form-group">
                <label for="contato">Contato:</label>
                <input type="text" id="contato" name="contato" placeholder="Contato">
            </div>

            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" placeholder="Endereço">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade">
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" placeholder="Estado">
            </div>

            <div class="form-group">
                <label for="areas-atuacao">Áreas de Atuação:</label>
                <textarea id="areas-atuacao" name="areas-atuacao" placeholder="Áreas de Atuação"></textarea>
            </div>

            <button type="submit" class="submit-button">Cadastrar Empresa</button>
        </form>
    </div>
</body>
</html>