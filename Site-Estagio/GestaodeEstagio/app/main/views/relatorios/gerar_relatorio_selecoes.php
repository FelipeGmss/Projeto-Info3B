<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../assets/fpdf/fpdf.php';

class PDF extends FPDF {
    public $filtro_info;

    function Header() {
        // Logo
        $this->Image(__DIR__ . '/../../config/img/logo_Salaberga-removebg-preview.png', 10, 10, 30);
        
        // Título
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Relatório de Seleções', 0, 1, 'C');
        
        // Data
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, 'Data de geração: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
        
        // Informação do filtro
        if (isset($this->filtro_info)) {
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 10, $this->filtro_info, 0, 1, 'C');
        }
        
        // Linha
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

try {
    // Conexão com o banco de dados
    $conn = getConnection();

    // Processar filtros
    $tipo_relatorio = $_POST['tipo_relatorio'] ?? 'processo_seletivo';
    $curso = $_POST['curso_selecao'] ?? 'todos';

    // Construir a query base de acordo com o tipo de relatório
    switch ($tipo_relatorio) {
        case 'processo_seletivo':
            $sql = "SELECT c.*, c.nome as concedente_nome, c.perfil as titulo
                    FROM concedentes c 
                    WHERE 1=1";
            if ($curso !== 'todos') {
                $sql .= " AND c.perfil = ?";
            }
            break;
        case 'inscricoes':
            $sql = "SELECT s.*, a.nome as aluno_nome, c.perfil as processo_titulo 
                    FROM selecao s 
                    JOIN aluno a ON s.id_aluno = a.id 
                    JOIN concedentes c ON s.id_concedente = c.id 
                    WHERE 1=1";
            if ($curso !== 'todos') {
                $sql .= " AND a.curso = ?";
            }
            break;
        case 'alunos_alocados':
            $sql = "SELECT a.nome as aluno_nome, c.nome as concedente_nome, 
                           c.perfil as processo_titulo, s.hora as data_selecao 
                    FROM aluno a 
                    JOIN selecao s ON a.id = s.id_aluno 
                    JOIN concedentes c ON s.id_concedente = c.id 
                    WHERE s.status = 'alocado'";
            if ($curso !== 'todos') {
                $sql .= " AND a.curso = ?";
            }
            break;
    }

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception("Erro ao preparar a query: " . $conn->error);
    }

    if ($curso !== 'todos') {
        $stmt->bind_param("s", $curso);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Criar PDF
    $pdf = new PDF('L'); // Landscape
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Configurar informação do filtro
    $pdf->filtro_info = 'Tipo de Relatório: ' . ucfirst(str_replace('_', ' ', $tipo_relatorio));
    if ($curso !== 'todos') {
        $pdf->filtro_info .= ' | Curso: ' . ucfirst($curso);
    }

    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 140, 69); // Verde
    $pdf->SetTextColor(255, 255, 255); // Branco

    // Definir colunas de acordo com o tipo de relatório
    switch ($tipo_relatorio) {
        case 'processo_seletivo':
            $pdf->Cell(60, 10, 'Perfil', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Concedente', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Vagas', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Status', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Local', 1, 1, 'C', true);
            break;
        case 'inscricoes':
            $pdf->Cell(60, 10, 'Aluno', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Perfil', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Data Seleção', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Status', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Local', 1, 1, 'C', true);
            break;
        case 'alunos_alocados':
            $pdf->Cell(60, 10, 'Aluno', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Concedente', 1, 0, 'C', true);
            $pdf->Cell(60, 10, 'Perfil', 1, 0, 'C', true);
            $pdf->Cell(40, 10, 'Data Seleção', 1, 1, 'C', true);
            break;
    }

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        $pdf->SetFillColor(242, 242, 242); // Cinza claro
        
        switch ($tipo_relatorio) {
            case 'processo_seletivo':
                $pdf->Cell(60, 8, utf8_decode($row['perfil']), 1, 0, 'L', $fill);
                $pdf->Cell(60, 8, utf8_decode($row['concedente_nome']), 1, 0, 'L', $fill);
                $pdf->Cell(40, 8, $row['vagas'] ?? '-', 1, 0, 'C', $fill);
                $pdf->Cell(40, 8, utf8_decode($row['status'] ?? 'Ativo'), 1, 0, 'C', $fill);
                $pdf->Cell(40, 8, utf8_decode($row['local'] ?? '-'), 1, 1, 'C', $fill);
                break;
            case 'inscricoes':
                $pdf->Cell(60, 8, utf8_decode($row['aluno_nome']), 1, 0, 'L', $fill);
                $pdf->Cell(60, 8, utf8_decode($row['processo_titulo']), 1, 0, 'L', $fill);
                $pdf->Cell(40, 8, date('d/m/Y H:i', strtotime($row['hora'])), 1, 0, 'C', $fill);
                $pdf->Cell(40, 8, utf8_decode($row['status']), 1, 0, 'C', $fill);
                $pdf->Cell(40, 8, utf8_decode($row['local'] ?? '-'), 1, 1, 'C', $fill);
                break;
            case 'alunos_alocados':
                $pdf->Cell(60, 8, utf8_decode($row['aluno_nome']), 1, 0, 'L', $fill);
                $pdf->Cell(60, 8, utf8_decode($row['concedente_nome']), 1, 0, 'L', $fill);
                $pdf->Cell(60, 8, utf8_decode($row['processo_titulo']), 1, 0, 'L', $fill);
                $pdf->Cell(40, 8, date('d/m/Y H:i', strtotime($row['data_selecao'])), 1, 1, 'C', $fill);
                break;
        }
        $fill = !$fill;
    }

    // Nome do arquivo
    $filename = 'relatorio_selecoes_' . date('Y-m-d_H-i-s') . '.pdf';

    // Enviar o PDF para o navegador
    $pdf->Output('I', $filename);

} catch (Exception $e) {
    die('Erro ao gerar relatório: ' . $e->getMessage());
}
?> 