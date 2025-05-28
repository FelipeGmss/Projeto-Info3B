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
        $this->Cell(0, 10, 'Relatório de Alunos', 0, 1, 'C');
        
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
    $filtro = $_POST['filtro_aluno'] ?? 'todos';
    $curso = $_POST['curso'] ?? '';
    $nome = $_POST['nome_aluno'] ?? '';
    $local = $_POST['local_aluno'] ?? '';

    // Construir a query base
    $sql = "SELECT * FROM aluno WHERE 1=1";
    
    if ($filtro === 'curso' && !empty($curso)) {
        $sql .= " AND curso = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $curso);
    } elseif ($filtro === 'nome' && !empty($nome)) {
        $sql .= " AND nome LIKE ?";
        $nome = "%$nome%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome);
    } elseif ($filtro === 'local' && !empty($local)) {
        $sql .= " AND endereco LIKE ?";
        $local = "%$local%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $local);
    } else {
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Criar PDF
    $pdf = new PDF('L'); // Landscape
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Configurar informação do filtro
    if ($filtro !== 'todos') {
        switch ($filtro) {
            case 'curso':
                $pdf->filtro_info = 'Filtrado por Curso: ' . $curso;
                break;
            case 'nome':
                $pdf->filtro_info = 'Filtrado por Nome: ' . $nome;
                break;
            case 'local':
                $pdf->filtro_info = 'Filtrado por Local: ' . $local;
                break;
        }
    }

    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 140, 69); // Verde
    $pdf->SetTextColor(255, 255, 255); // Branco
    
    $pdf->Cell(60, 10, 'Nome', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Matrícula', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Curso', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Email', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Contato', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Endereço', 1, 1, 'C', true);

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        $pdf->SetFillColor(242, 242, 242); // Cinza claro
        $pdf->Cell(60, 8, utf8_decode($row['nome']), 1, 0, 'L', $fill);
        $pdf->Cell(30, 8, utf8_decode($row['matricula']), 1, 0, 'C', $fill);
        $pdf->Cell(40, 8, utf8_decode($row['curso']), 1, 0, 'C', $fill);
        $pdf->Cell(60, 8, utf8_decode($row['email']), 1, 0, 'L', $fill);
        $pdf->Cell(30, 8, utf8_decode($row['contato']), 1, 0, 'C', $fill);
        $pdf->Cell(60, 8, utf8_decode($row['endereco']), 1, 1, 'L', $fill);
        $fill = !$fill;
    }

    // Nome do arquivo
    $filename = 'relatorio_alunos_' . date('Y-m-d_H-i-s') . '.pdf';

    // Enviar o PDF para o navegador
    $pdf->Output('I', $filename);

} catch (Exception $e) {
    die('Erro ao gerar relatório: ' . $e->getMessage());
}
?> 