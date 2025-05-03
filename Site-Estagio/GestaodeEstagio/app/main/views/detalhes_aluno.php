<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Aluno</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#005A24',
                        'primary-dark': '#004a1d',
                        secondary: '#FF8C00',
                        'secondary-dark': '#e67e00',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen font-['Roboto']">
    <div class="container mx-auto px-4 py-8">
        <!-- Botão Voltar -->

        <!-- Detalhes do Aluno -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            <?php
            require("../models/cadastros.class.php");
            $pdo = new PDO("mysql:host=localhost;dbname=estagio","root","");
            
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $consulta = 'SELECT * FROM aluno WHERE id = :id';
                $query = $pdo->prepare($consulta);
                $query->bindValue(':id', $id);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    $aluno = $query->fetch();
                    ?>
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Foto e Informações Básicas -->
                        <div class="md:w-1/3">
                            <div class="flex flex-col items-center">
                                <img class="h-32 w-32 md:h-48 md:w-48 rounded-full mb-4" 
                                     src="https://ui-avatars.com/api/?name=<?php echo urlencode($aluno['nome']); ?>" 
                                     alt="Foto do aluno <?php echo htmlspecialchars($aluno['nome']); ?>">
                                <h1 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($aluno['nome']); ?></h1>
                                <p class="text-gray-600"><?php echo htmlspecialchars($aluno['curso']); ?></p>
                            </div>
                        </div>

                        <!-- Informações Detalhadas -->
                        <div class="md:w-2/3">
                            <div class="space-y-6">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informações Pessoais</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Matrícula</label>
                                            <p class="mt-1 text-gray-900"><?php echo htmlspecialchars($aluno['matricula']); ?></p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Contato</label>
                                            <p class="mt-1 text-gray-900"><?php echo htmlspecialchars($aluno['contato']); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Marcação de Tempo -->
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tempo de Estágio</h2>
                                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                                        <div class="mb-6">
                                            <div class="flex justify-between mb-2">
                                                <span class="text-sm font-medium text-gray-700">Horas Cumpridas</span>
                                                <span class="text-sm font-medium text-gray-700">0/400 horas</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-[#005A24] to-[#FF8C00] h-2 rounded-full" 
                                                     style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <form class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Registro de Horário
                                                </label>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                                    <div>
                                                        <label class="block text-xs text-gray-500 mb-1">Início</label>
                                                        <input type="time" 
                                                               id="hora_inicio" 
                                                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs text-gray-500 mb-1">Término</label>
                                                        <input type="time" 
                                                               id="hora_fim" 
                                                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                                    </div>
                                                </div>
                                                <div class="flex gap-2">
                                                    <button type="button" 
                                                            onclick="adicionarHoras()"
                                                            class="flex-1 px-4 py-2 bg-gradient-to-r from-[#005A24] to-[#FF8C00] hover:from-[#FF8C00] hover:to-[#005A24] text-white rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                                        <i class="fas fa-plus"></i>
                                                        Adicionar
                                                    </button>
                                                    <button type="button" 
                                                            onclick="removerHoras()"
                                                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2">
                                                        <i class="fas fa-minus"></i>
                                                        Remover
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Botões de Ação -->
                                <div class="flex gap-4">
                                    <a href="editar_aluno.php?btn=<?php echo htmlspecialchars($aluno['id']); ?>" 
                                       class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-xl transition-all duration-300 flex items-center gap-2">
                                        <i class="fas fa-edit"></i>
                                        Editar Aluno
                                    </a>
                                    <form action="../controllers/Controller-excluir_alunos.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                                        <input type="hidden" name="btn" value="<?php echo htmlspecialchars($aluno['id']); ?>">
                                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl transition-all duration-300 flex items-center gap-2">
                                            <i class="fas fa-trash"></i>
                                            Excluir Aluno
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<p class='text-center text-gray-600'>Aluno não encontrado.</p>";
                }
            } else {
                echo "<p class='text-center text-gray-600'>ID do aluno não fornecido.</p>";
            }
            ?>
        </div>
    </div>

    <script>
    let horasTotais = 0;
    const totalHorasNecessarias = 400;

    function calcularHoras(inicio, fim) {
        const [horaInicio, minutoInicio] = inicio.split(':').map(Number);
        const [horaFim, minutoFim] = fim.split(':').map(Number);
        
        let horas = horaFim - horaInicio;
        let minutos = minutoFim - minutoInicio;
        
        if (minutos < 0) {
            horas--;
            minutos += 60;
        }
        
        return horas + (minutos / 60);
    }

    function atualizarBarraProgresso() {
        const porcentagem = (horasTotais / totalHorasNecessarias) * 100;
        document.querySelector('.bg-gradient-to-r').style.width = `${porcentagem}%`;
        document.querySelector('.text-sm.font-medium.text-gray-700:last-child').textContent = 
            `${horasTotais.toFixed(1)}/${totalHorasNecessarias} horas`;
    }

    function adicionarHoras() {
        const inicio = document.getElementById('hora_inicio').value;
        const fim = document.getElementById('hora_fim').value;
        
        if (!inicio || !fim) {
            alert('Por favor, preencha os horários de início e término');
            return;
        }
        
        const horas = calcularHoras(inicio, fim);
        
        if (horas <= 0) {
            alert('O horário de término deve ser maior que o horário de início');
            return;
        }
        
        if (horasTotais + horas > totalHorasNecessarias) {
            alert('O total de horas não pode exceder 400 horas');
            return;
        }
        
        horasTotais += horas;
        atualizarBarraProgresso();
        
        // Limpa os campos
        document.getElementById('hora_inicio').value = '';
        document.getElementById('hora_fim').value = '';
    }

    function removerHoras() {
        const inicio = document.getElementById('hora_inicio').value;
        const fim = document.getElementById('hora_fim').value;
        
        if (!inicio || !fim) {
            alert('Por favor, preencha os horários de início e término');
            return;
        }
        
        const horas = calcularHoras(inicio, fim);
        
        if (horas <= 0) {
            alert('O horário de término deve ser maior que o horário de início');
            return;
        }
        
        if (horasTotais - horas < 0) {
            alert('Não é possível remover mais horas do que já foram registradas');
            return;
        }
        
        horasTotais -= horas;
        atualizarBarraProgresso();
        
        // Limpa os campos
        document.getElementById('hora_inicio').value = '';
        document.getElementById('hora_fim').value = '';
    }
    </script>
</body>
</html> 