<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empresas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#007A33',
                        'primary-dark': '#00662a',
                        secondary: '#FF8C00',
                        'secondary-dark': '#e67e00',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Use Roboto font */
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
            color: #333;
        }

        .header {
            background-color: #005A24;
            padding: 1rem; /* Tailwind-like padding */
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem; /* Tailwind-like padding */
        }

        h1 {
            margin: 0;
            font-size: 1.5rem; /* Tailwind-like font size */
            font-weight: 500; /* Medium font weight */
        }

        h3 {
            color: #FF8C00;
            margin: 0;
            font-size: 1rem; /* Tailwind-like font size */
        }

        .btn-cadastrar {
            padding: 0.5rem 1rem; /* Tailwind-like padding */
            background-color: #FF8C00;
            color: white;
            text-decoration: none;
            border-radius: 0.375rem; /* Tailwind-like rounded corners */
            transition: background-color 0.3s;
            font-weight: 500; /* Medium font weight */
        }

        .btn-cadastrar:hover {
            background-color: #e67e00;
        }

        .container {
            max-width: 1200px;
            margin: 1.5rem auto; /* Tailwind-like margin */
            padding: 0 1rem; /* Tailwind-like padding */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 0.5rem; /* Tailwind-like rounded corners */
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.8s forwards 0.2s;
        }

        th, td {
            padding: 0.5rem; /* Tailwind-like padding */
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #005A24;
            color: white;
            font-weight: 500;
        }

        tr {
            transition: background-color 0.2s ease;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        td:empty::before {
            content: "—";
            color: #999;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem; /* Tailwind-like gap */
            justify-content: center;
        }

        .action-btn {
            padding: 0.375rem 0.75rem; /* Tailwind-like padding */
            border: none;
            border-radius: 0.25rem; /* Tailwind-like rounded corners */
            cursor: pointer;
            transition: background-color 0.3s;
            color: white;
        }

        .edit-btn {
            background-color: #FF8C00;
        }

        .edit-btn:hover {
            background-color: #e67e00;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .action-btn i {
            font-size: 1rem; /* Tailwind-like font size */
        }
    </style>

    <script>
        // Aguarda o DOM carregar completamente
        document.addEventListener('DOMContentLoaded', function() {
            // Adiciona ordenação simples na tabela
            const headers = document.querySelectorAll('th');
            headers.forEach(header => {
                header.style.cursor = 'pointer';
                header.addEventListener('click', function() {
                    const index = Array.from(this.parentElement.children).indexOf(this);
                    sortTable(index);
                });
            });
        });

        function sortTable(n) {
            let table = document.querySelector('table');
            let rows = Array.from(table.querySelectorAll('tbody tr'));
            let direction = 'asc';

            rows.sort((a, b) => {
                let x = a.getElementsByTagName("TD")[n].innerHTML.toLowerCase();
                let y = b.getElementsByTagName("TD")[n].innerHTML.toLowerCase();
                return x.localeCompare(y);
            });

            if (direction === 'asc') {
                rows.reverse();
                direction = 'desc';
            }

            let tbody = table.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        }

        function confirmDelete(id) {
            if (confirm('Tem certeza que deseja excluir esta empresa?')) {
                window.location.href = 'excluir_empresa.php?id=' + id;
            }
        }
    </script>
</head>
<body class="bg-gray-100"> <!-- Tailwind background color -->
    <div class="header">
        <div class="header-content">
            <div>
                <h1 class="text-xl font-semibold">Dados de Empresas</h1>
            </div>
            <a href="../views/cadastrodaempresa.php" class="btn-cadastrar">Cadastrar Nova Empresa</a>
        </div>
    </div>

    <div class="container">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nome
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Contato
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Endereço
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Cidade
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Vagas
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                require("../models/Login_usuarios.class.php");
                $x = new Usuarios();
                $pdo = new PDO("mysql:host=localhost;dbname=teste","root","");
                $consulta = 'select * from cadastro_emp;';
                $query = $pdo->prepare($consulta);
                $query->execute();
                $result = $query->rowCount();

                if ($result > 0) {
                    foreach ($query as $value) {
                        echo "<tr>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>" . $value['nome'] . "</td>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>" . $value['contato'] . "</td>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>" . $value['endereco'] . "</td>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>" . $value['cidade'] . "</td>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>" . $value['vagas'] . "</td>";
                        echo "<td class='px-5 py-5 border-b border-gray-200 bg-white text-sm'>";
                        echo "<div class='action-buttons'>";
                        echo "<a href='editar_empresa.php?id=" . $value['id'] . "' class='action-btn edit-btn'><i class='fas fa-edit'></i></a>";
                        echo "<button onclick='confirmDelete(" . $value['id'] . ")' class='action-btn delete-btn'><i class='fas fa-trash'></i></button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhuma empresa cadastrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>