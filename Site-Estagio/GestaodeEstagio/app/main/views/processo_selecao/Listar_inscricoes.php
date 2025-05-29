<?php
session_start();
require_once '../../models/model-function.php';

if (!isset($_SESSION['idAluno'])) {
    header("Location: ../Login_aluno.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscrições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-button {
            background: linear-gradient(to right, #FFA500, #008C45);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .gradient-button:hover {
            background: linear-gradient(to right, #008C45, #FFA500);
            transform: scale(1.05);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Processos Seletivos Disponíveis</h2>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Vagas Disponíveis</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="processosList">
                    <!-- Lista de processos será carregada via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Inscrição -->
    <div class="modal fade" id="inscricaoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inscrição no Processo Seletivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Empresa</h5>
                            <p><strong>Nome:</strong> <span id="modal-empresa-nome"></span></p>
                            <p><strong>Contato:</strong> <span id="modal-empresa-contato"></span></p>
                            <p><strong>Endereço:</strong> <span id="modal-empresa-endereco"></span></p>
                            <p><strong>Perfil:</strong> <span id="modal-empresa-perfil"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Informações do Processo</h5>
                            <p><strong>Vagas Disponíveis:</strong> <span id="modal-empresa-vagas"></span></p>
                            <p><strong>Data:</strong> <span id="modal-empresa-data"></span></p>
                            <p><strong>Local:</strong> <span id="modal-empresa-local"></span></p>
                            <p><strong>Hora:</strong> <span id="modal-empresa-hora"></span></p>
                        </div>
                    </div>
                    <hr>
                    <form id="form-inscricao">
                        <input type="hidden" id="id_formulario" name="id_formulario">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Ao confirmar sua inscrição, você estará se comprometendo a participar deste processo seletivo.
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmarInscricao()">Confirmar Inscrição</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Inscritos -->
    <div class="modal fade" id="inscritosModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alunos Inscritos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Data de Inscrição</th>
                                </tr>
                            </thead>
                            <tbody id="inscritosList">
                                <!-- Lista de inscritos será carregada via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Carregar lista de processos
        function loadProcessos() {
            fetch('../controllers/get_processos.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('processosList');
                    tbody.innerHTML = '';
                    
                    data.forEach(processo => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${processo.nome_empresa}</td>
                            <td>${processo.numero_vagas}</td>
                            <td>${processo.data}</td>
                            <td>
                                <button class="btn btn-sm gradient-button me-2" onclick="showInscricaoModal(${processo.id})">
                                    <i class="fas fa-user-plus"></i> Inscrever
                                </button>
                                <button class="btn btn-sm btn-info" onclick="showInscritosModal(${processo.id})">
                                    <i class="fas fa-users"></i> Ver Inscritos
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Erro:', error));
        }

        // Mostrar modal de inscrição
        function showInscricaoModal(id) {
            fetch(`../controllers/get_processo_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id_formulario').value = id;
                    document.getElementById('modal-empresa-nome').textContent = data.nome_empresa;
                    document.getElementById('modal-empresa-contato').textContent = data.contato;
                    document.getElementById('modal-empresa-endereco').textContent = data.endereco;
                    document.getElementById('modal-empresa-perfil').textContent = data.perfil;
                    document.getElementById('modal-empresa-vagas').textContent = data.numero_vagas;
                    document.getElementById('modal-empresa-data').textContent = data.data;
                    document.getElementById('modal-empresa-local').textContent = data.local;
                    document.getElementById('modal-empresa-hora').textContent = data.hora;
                    
                    new bootstrap.Modal(document.getElementById('inscricaoModal')).show();
                })
                .catch(error => console.error('Erro:', error));
        }

        // Mostrar modal de inscritos
        function showInscritosModal(id) {
            fetch(`../controllers/get_inscritos.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('inscritosList');
                    tbody.innerHTML = '';
                    
                    data.forEach(inscrito => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${inscrito.nome}</td>
                            <td>${inscrito.curso}</td>
                            <td>${inscrito.data_inscricao}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                    
                    new bootstrap.Modal(document.getElementById('inscritosModal')).show();
                })
                .catch(error => console.error('Erro:', error));
        }

        // Confirmar inscrição
        function confirmarInscricao() {
            const formData = new FormData(document.getElementById('form-inscricao'));
            
            fetch('../controllers/controller_inscrever.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inscrição realizada com sucesso!');
                    bootstrap.Modal.getInstance(document.getElementById('inscricaoModal')).hide();
                    loadProcessos();
                } else {
                    alert(data.message || 'Erro ao realizar inscrição');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao realizar inscrição');
            });
        }

        // Carregar processos ao iniciar
        document.addEventListener('DOMContentLoaded', loadProcessos);
    </script>
</body>
</html> 