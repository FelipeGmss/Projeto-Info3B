<?php
if (!isset(
    $dados_empresa) || empty($dados_empresa)) {
    header('Location: ../controllers/Controller-listar_empresa.php?error=dados_nao_encontrados');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/img/Design sem nome.svg" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F5F5F5;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        }

        .input-group label {
            transition: all 0.3s ease;
        }

        .error-message {
            display: none;
            color: #ff4444;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        .input-group.error .error-message {
            display: block;
        }

        .input-group.error input {
            border-color: #ff4444;
        }

        .input-group.error label {
            color: #ff4444;
        }

        .help-text {
            font-size: 0.8rem;
            color: #6B7280;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl flex bg-white rounded-3xl shadow-xl overflow-hidden">
        <!-- Right Side: Registration Form -->
        <div class="w-full p-8">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-4">
                <i class="fas fa-arrow-left"></i>
                <span>Voltar</span>
            </a>
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Editar Empresa</h2>
                <p class="text-gray-600">Atualize os dados da empresa</p>
            </div>

            <form action="../controllers/Controller-editar_empresa.php" method="POST" class="space-y-4">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($dados_empresa['id']) ?>">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome da Empresa</label>
                        <input type="text" id="nome" name="nome" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o nome da empresa"
                            value="<?php echo htmlspecialchars($dados_empresa['nome']) ?>">
                        <span class="error-message" id="nomeError">Por favor, insira um nome válido</span>
                    </div>

                    <div class="input-group">
                        <label for="contato" class="block text-sm font-medium text-gray-700 mb-1">Contato</label>
                        <input type="tel" id="contato" name="contato" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o contato"
                            value="<?php echo htmlspecialchars($dados_empresa['contato']) ?>">
                        <span class="help-text">Digite apenas números (DDD + número)</span>
                        <span class="error-message" id="contatoError">Por favor, insira um número válido</span>
                    </div>

                    <div class="input-group">
                        <label for="endereco" class="block text-sm font-medium text-gray-700 mb-1">Endereço</label>
                        <input type="text" id="endereco" name="endereco" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o endereço"
                            value="<?php echo htmlspecialchars($dados_empresa['endereco']) ?>">
                        <span class="error-message" id="enderecoError">Por favor, insira um endereço válido</span>
                    </div>

                    <div class="input-group">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade de Tipos de Perfil</label>
                        <div class="flex gap-4">
                            <?php
                            $perfis = json_decode($dados_empresa['perfis'], true);
                            $num_perfis = is_array($perfis) ? count($perfis) : 1;
                            ?>
                            <label class="inline-flex items-center">
                                <input type="radio" name="quantidade_perfis" value="1" class="form-radio" <?php echo $num_perfis == 1 ? 'checked' : ''; ?>>
                                <span class="ml-2">1</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="quantidade_perfis" value="2" class="form-radio" <?php echo $num_perfis == 2 ? 'checked' : ''; ?>>
                                <span class="ml-2">2</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="quantidade_perfis" value="3" class="form-radio" <?php echo $num_perfis == 3 ? 'checked' : ''; ?>>
                                <span class="ml-2">3</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="quantidade_perfis" value="4" class="form-radio" <?php echo $num_perfis == 4 ? 'checked' : ''; ?>>
                                <span class="ml-2">4</span>
                            </label>
                        </div>
                    </div>

                    <div id="perfis-container" class="col-span-2">
                        <?php
                        if (is_array($perfis)) {
                            foreach ($perfis as $index => $perfil) {
                                $i = $index + 1;
                                echo "<div class='input-group'>";
                                echo "<label for='perfil{$i}' class='block text-sm font-medium text-gray-700 mb-1'>Perfil {$i}</label>";
                                echo "<input type='text' id='perfil{$i}' name='perfis[]' required
                                    class='w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300'
                                    placeholder='Digite o perfil {$i}'
                                    value='" . htmlspecialchars($perfil) . "'>";
                                echo "<span class='error-message' id='perfil{$i}Error'>Por favor, insira um perfil válido</span>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='input-group'>";
                            echo "<label for='perfil1' class='block text-sm font-medium text-gray-700 mb-1'>Perfil 1</label>";
                            echo "<input type='text' id='perfil1' name='perfis[]' required
                                class='w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300'
                                placeholder='Digite o primeiro perfil'
                                value='" . htmlspecialchars($dados_empresa['perfis']) . "'>";
                            echo "<span class='error-message' id='perfil1Error'>Por favor, insira um perfil válido</span>";
                            echo "</div>";
                        }
                        ?>
                    </div>

                    <div class="input-group">
                        <label for="vagas" class="block text-sm font-medium text-gray-700 mb-1">Número de Vagas</label>
                        <input type="number" id="vagas" name="numero_vagas" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Quantidade de vagas disponíveis"
                            min="1" max="100"
                            value="<?php echo htmlspecialchars($dados_empresa['numero_vagas']) ?>">
                        <span class="error-message" id="vagasError">Por favor, insira um número válido de vagas</span>
                    </div>
                </div>

                <input type="submit" name="btn-editar" value="Atualizar Empresa"
                    class="w-full bg-[#005A24] hover:bg-[#004A1D] text-white py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#005A24] transition-all duration-300 font-semibold text-lg">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const perfisContainer = document.getElementById('perfis-container');
            const radioButtons = document.querySelectorAll('input[name="quantidade_perfis"]');

            function updatePerfisInputs() {
                const selectedValue = document.querySelector('input[name="quantidade_perfis"]:checked').value;
                perfisContainer.innerHTML = '';

                for (let i = 1; i <= selectedValue; i++) {
                    const div = document.createElement('div');
                    div.className = 'input-group';
                    div.innerHTML = `
                        <label for="perfil${i}" class="block text-sm font-medium text-gray-700 mb-1">Perfil ${i}</label>
                        <input type="text" id="perfil${i}" name="perfis[]" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o perfil ${i}">
                        <span class="error-message" id="perfil${i}Error">Por favor, insira um perfil válido</span>
                    `;
                    perfisContainer.appendChild(div);
                }
            }

            radioButtons.forEach(radio => {
                radio.addEventListener('change', updatePerfisInputs);
            });

            form.addEventListener('submit', function(e) {
                let isValid = true;
                const inputs = form.querySelectorAll('input[required]');

                inputs.forEach(input => {
                    if (!input.value) {
                        input.parentElement.classList.add('error');
                        const errorId = input.id + 'Error';
                        const errorElement = document.getElementById(errorId);
                        if (errorElement) {
                            errorElement.textContent = 'Por favor, preencha este campo';
                        }
                        isValid = false;
                    } else {
                        input.parentElement.classList.remove('error');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });

            // Clear errors on input
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', function() {
                    this.parentElement.classList.remove('error');
                });
            });
        });
    </script>
</body>
</html>