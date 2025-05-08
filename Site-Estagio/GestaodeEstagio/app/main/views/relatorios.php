<!-- 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Estágio - Relatórios</title>
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
            max-width: 90%; /* Largura máxima em porcentagem */
            width: 600px; /* Largura fixa para telas grandes */
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px; /* Aumentei o padding */
            text-align: left;
            overflow: auto; /* Permite rolagem se o conteúdo exceder a altura */
            max-height: 90vh; /* Altura máxima em porcentagem */
        }

        h1 {
            font-size: 28px; /* Aumentei o tamanho da fonte */
            color: var(--text-color);
            margin-bottom: 30px; /* Aumentei a margem */
        }

        .filter-section {
            margin-bottom: 30px; /* Aumentei a margem */
        }

        .filter-section h2 {
            font-size: 20px; /* Aumentei o tamanho da fonte */
            color: var(--text-color);
            margin-bottom: 15px; /* Aumentei a margem */
        }

        .filter-section label {
            font-size: 16px; /* Aumentei o tamanho da fonte */
            color: #666;
            display: block;
            margin-bottom: 8px; /* Aumentei a margem */
        }

        .filter-section input, .filter-section select {
            width: 100%;
            padding: 12px; /* Aumentei o padding */
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px; /* Aumentei o tamanho da fonte */
            margin-bottom: 20px; /* Aumentei a margem */
            box-sizing: border-box;
        }

        .filter-section .button-group {
            display: flex;
            justify-content: flex-end;
        }

        .button {
            padding: 14px 24px; /* Aumentei o padding */
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Adicionei uma transição suave */
        }

        .button-gerar {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .button-gerar:hover {
            background-color: #43a047; /* Cor ligeiramente mais escura */
        }

        .report-section {
            margin-bottom: 30px; /* Aumentei a margem */
        }

        .report-section h2 {
            font-size: 20px; /* Aumentei o tamanho da fonte */
            color: var(--text-color);
            margin-bottom: 15px; /* Aumentei a margem */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-baixar {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 10px 20px; /* Aumentei o padding */
            font-size: 16px; /* Aumentei o tamanho da fonte */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Adicionei uma transição suave */
        }

        .button-baixar:hover {
            background-color: #43a047; /* Cor ligeiramente mais escura */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px; /* Aumentei o tamanho da fonte */
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        th, td {
            padding: 15px; /* Aumentei o padding */
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: #f9f9f9;
            color: var(--text-color);
            font-weight: bold;
        }

        td {
            color: #666;
        }

        .status {
            display: inline-block;
            padding: 8px 12px; /* Aumentei o padding */
            border-radius: 5px;
            font-size: 14px; /* Aumentei o tamanho da fonte */
        }

        .status-suporte {
            background-color: #d4edda;
            color: #155724;
        }

        .status-contador {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cartorio {
            background-color: #f8d7da;
            color: #721c24;
        }

        .visualizar {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease; /* Adicionei uma transição suave */
        }

        .visualizar:hover {
            color: #43a047; /* Cor ligeiramente mais escura */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Estágio - Relatórios</h1>

        <div class="filter-section">
            <h2>Filtros do Relatório</h2>
            <label for="nome-aluno">Nome do Aluno:</label>
            <input type="text" id="nome-aluno" placeholder="Nome Completo do Aluno">

            <label for="tipo-relatorio">Tipo de Relatório:</label>
            <select id="tipo-relatorio">
                <option value="geral">Geral</option>
                <option value="turma-curso">Turma/Curso</option>
            </select>

            <div class="button-group">
                <button class="button button-gerar">Gerar Relatório</button>
            </div>
        </div>

        <div class="report-section">
            <h2>
                Relatório
                <button class="button button-baixar">Baixar PDF</button>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>NOME DO ALUNO</th>
                        <th>CURSO</th>
                        <th>VAGA</th>
                        <th>EMPRESA</th>
                        <th>STATUS</th>
                        <th>DETALHES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Felipe Gomes</td>
                        <td>Enfermagem</td>
                        <td>Informática</td>
                        <td>Empresa A</td>
                        <td><span class="status status-suporte">Suporte</span></td>
                        <td><a href="#" class="visualizar">Visualizar</a></td>
                    </tr>
                    <tr>
                        <td>Marcus Luan</td>
                        <td>Informática</td>
                        <td>Suporte</td>
                        <td>Empresa B</td>
                        <td><span class="status status-suporte">Suporte</span></td>
                        <td><a href="#" class="visualizar">Visualizar</a></td>
                    </tr>
                    <tr>
                        <td>Ramon Nunes</td>
                        <td>Administração</td>
                        <td>Contador</td>
                        <td>Empresa C</td>
                        <td><span class="status status-contador">Contador</span></td>
                        <td><a href="#" class="visualizar">Visualizar</a></td>
                    </tr>
                    <tr>
                        <td>Lavoisier</td>
                        <td>Direito</td>
                        <td>Cartório</td>
                        <td>Empresa D</td>
                        <td><span class="status status-cartorio">Cartório</span></td>
                        <td><a href="#" class="visualizar">Visualizar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> -->