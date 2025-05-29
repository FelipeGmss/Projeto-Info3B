<?php
// Prevenir qualquer saída antes do PDF
ob_start();

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../assets/fpdf/fpdf.php';

class PDF extends FPDF {
    public $filtro_info;

    function Header() {
        // Logo
        $this->Image(__DIR__ . '/../../config/img/logo_Salaberga-removebg-preview.png', 10, 10, 30);
        
        // Título
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 90, 36); // Verde escuro
        $this->Cell(0, 10, 'Relatório de Alunos', 0, 1, 'C');
        
        // Data
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 8, 'Data: ' . date('d \d\e F \d\e Y, H:i'), 0, 1, 'C');
        
        // Informação do filtro
        if (isset($this->filtro_info)) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(0, 90, 36);
            $this->Cell(0, 8, $this->filtro_info, 0, 1, 'C');
        }
        
        // Linha divisória
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(0.3);
        $this->Line(20, $this->GetY() + 5, $this->w - 20, $this->GetY() + 5);
        
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function TableHeader() {
        $this->SetFillColor(0, 90, 36); // Verde escuro
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 10);

        $header = array('Nome', 'Matrícula', 'Curso', 'Email', 'Contato', 'Endereço');
        $w = array(60, 30, 40, 60, 30, 60);

        for($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        }
        $this->Ln();
    }

    function TableContent($data) {
        $this->SetFillColor(200, 230, 200); // Verde claro
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);
        $this->SetDrawColor(0, 90, 36);

        $w = array(60, 30, 40, 60, 30, 60);
        $fill = false;

        foreach($data as $row) {
            if($this->GetY() > 260) {
                $this->AddPage();
                $this->TableHeader();
            }

            $this->Cell($w[0], 8, utf8_decode($row['nome']), 1, 0, 'L', $fill);
            $this->Cell($w[1], 8, utf8_decode($row['matricula']), 1, 0, 'C', $fill);
            $this->Cell($w[2], 8, utf8_decode($row['curso']), 1, 0, 'C', $fill);
            $this->Cell($w[3], 8, utf8_decode($row['email']), 1, 0, 'L', $fill);
            $this->Cell($w[4], 8, utf8_decode($row['contato']), 1, 0, 'C', $fill);
            $this->Cell($w[5], 8, utf8_decode($row['endereco']), 1, 1, 'L', $fill);
            $fill = !$fill;
        }
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

    // Limpar qualquer saída anterior
    ob_clean();

    // Criar PDF
    $pdf = new PDF('L');
    $pdf->SetMargins(20, 20, 20);
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Configurar informação do filtro
    if ($filtro !== 'todos') {
        switch ($filtro) {
            case 'curso':
                $pdf->filtro_info = 'Filtrado por Curso: ' . ucfirst($curso);
                break;
            case 'nome':
                $pdf->filtro_info = 'Filtrado por Nome: ' . $nome;
                break;
            case 'local':
                $pdf->filtro_info = 'Filtrado por Local: ' . $local;
                break;
        }
    }

    // Adicionar tabela
    $pdf->TableHeader();
    $pdf->TableContent($result);

    // Nome do arquivo
    $filename = 'relatorio_alunos_' . date('Y-m-d_H-i-s') . '.pdf';

    // Limpar qualquer saída anterior e enviar o PDF
    ob_clean();
    $pdf->Output('I', $filename);

} catch (Exception $e) {
    // Limpar qualquer saída anterior
    ob_clean();
    die('Erro ao gerar relatório: ' . $e->getMessage());
}
// Garantir que nenhum conteúdo seja enviado após o PDF
ob_end_flush();
?> 