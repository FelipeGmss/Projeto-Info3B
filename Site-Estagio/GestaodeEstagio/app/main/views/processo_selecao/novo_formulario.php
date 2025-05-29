<?php
// Adicionar busca de concedente via AJAX
if (isset($_GET['buscar_concedente']) && isset($_GET['id_concedente'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=estagio', 'root', '');
    $id = intval($_GET['id_concedente']);
    $stmt = $pdo->prepare('SELECT nome, numero_vagas, perfil, endereco FROM concedentes WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($dados ? $dados : []);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Seleção de Estágio</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/img/Design sem nome.svg" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #F5F5F5; }
        .input-group { position: relative; margin-bottom: 1.5rem; }
        .input-group input, .input-group select { transition: all 0.3s ease; }
        .input-group input:focus, .input-group select:focus { box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1); }
        .input-group label { transition: all 0.3s ease; }
        .error-message { display: none; color: #ff4444; font-size: 0.8rem; margin-top: 0.25rem; }
        .input-group.error .error-message { display: block; }
        .input-group.error input, .input-group.error select { border-color: #ff4444; }
        .input-group.error label { color: #ff4444; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-3xl flex bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="w-full p-8">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-4">
                <i class="fas fa-arrow-left"></i>
                <span>Voltar</span>
            </a>
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Cadastro de Seleção de Estágio</h2>
                <p class="text-gray-600">Preencha os dados da seleção</p>
            </div>
            <form method="POST" action="../controllers/Controller-form_selecao.php" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                        <input type="datetime-local" id="hora" name="hora" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300">
                        <span class="error-message" id="horaError">Por favor, insira a data e hora</span>
                    </div>
                    <div class="input-group">
                        <label for="local" class="block text-sm font-medium text-gray-700 mb-1">Local</label>
                        <input type="text" id="local" name="local" maxlength="100" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o local">
                        <span class="error-message" id="localError">Por favor, insira o local</span>
                    </div>
                    <div class="input-group">
                        <label for="id_concedente" class="block text-sm font-medium text-gray-700 mb-1">ID Concedente</label>
                        <input type="number" id="id_concedente" name="id_concedente" required
                            class="w-full input-field px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-[#005A24] transition-all duration-300"
                            placeholder="Digite o ID do concedente">
                        <span class="error-message" id="id_concedenteError">Por favor, insira o ID do concedente</span>
                        <div id="concedente_info" class="mt-2 text-sm text-green-700"></div>
                    </div>
                </div>
                <input type="submit" name="btn" value="Cadastrar Seleção"
                    class="w-full bg-[#005A24] hover:bg-[#004A1D] text-white py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#005A24] transition-all duration-300 font-semibold text-lg">
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const inputs = form.querySelectorAll('input[required]');
                inputs.forEach(input => {
                    if (!input.value) {
                        input.parentElement.classList.add('error');
                        document.getElementById(input.id + 'Error').textContent = 'Por favor, preencha este campo';
                        isValid = false;
                    } else {
                        input.parentElement.classList.remove('error');
                    }
                });
                if (!isValid) {
                    e.preventDefault();
                }
            });
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', function() {
                    this.parentElement.classList.remove('error');
                });
            });

            const idConcedenteInput = document.getElementById('id_concedente');
            const localInput = document.getElementById('local');
            const infoDiv = document.getElementById('concedente_info');
            idConcedenteInput.addEventListener('input', function() {
                const id = this.value;
                if (id) {
                    fetch(`?buscar_concedente=1&id_concedente=${id}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data && data.nome) {
                                infoDiv.innerHTML = `<b>Nome:</b> ${data.nome}<br><b>Perfil:</b> ${data.perfil}<br><b>Vagas:</b> ${data.numero_vagas}`;
                                if (data.endereco) {
                                    localInput.value = data.endereco;
                                }
                            } else {
                                infoDiv.textContent = 'Concedente não encontrado.';
                                localInput.value = '';
                            }
                        });
                } else {
                    infoDiv.textContent = '';
                    localInput.value = '';
                }
            });
        });
    </script>
</body>
</html>
