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
        $this->Cell(0, 10, 'Relatório de Concedentes', 0, 1, 'C');
        
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

        $header = array('Nome', 'Perfil', 'Contato', 'Vagas', 'Endereço');
        $w = array(70, 45, 65, 45, 65);

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

        $w = array(70, 45, 65, 45, 65);
        $fill = false;

        foreach($data as $row) {
            if($this->GetY() > 260) {
                $this->AddPage();
                $this->TableHeader();
            }

            $this->Cell($w[0], 8, utf8_decode($row['nome']), 1, 0, 'L', $fill);
            $this->Cell($w[1], 8, utf8_decode($row['perfil']), 1, 0, 'L', $fill);
            $this->Cell($w[2], 8, utf8_decode($row['contato']), 1, 0, 'L', $fill);
            $this->Cell($w[3], 8, utf8_decode($row['numero_vagas']), 1, 0, 'C', $fill);
            $this->Cell($w[4], 8, utf8_decode($row['endereco']), 1, 1, 'L', $fill);
            $fill = !$fill;
        }
    }
}

try {
    // Conexão com o banco de dados
    $conn = getConnection();

    // Processar filtros
    $filtro = $_POST['filtro_concedente'] ?? 'todos';
    $perfil = $_POST['perfil'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $vagas = $_POST['numero_vagas'] ?? '';

    // Construir a query base
    $sql = "SELECT c.* FROM concedentes c WHERE 1=1";
    
    if ($filtro === 'perfil' && !empty($perfil)) {
        $sql .= " AND c.perfil LIKE ?";
        $perfil = "%$perfil%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $perfil);
    } elseif ($filtro === 'endereco' && !empty($endereco)) {
        $sql .= " AND c.endereco LIKE ?";
        $endereco = "%$endereco%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $endereco);
    } elseif ($filtro === 'numero_vagas' && !empty($vagas)) {
        $sql .= " AND c.numero_vagas ";
        switch ($vagas) {
            case '1-5':
                $sql .= " BETWEEN 1 AND 5";
                break;
            case '6-10':
                $sql .= " BETWEEN 6 AND 10";
                break;
            case '11-20':
                $sql .= " BETWEEN 11 AND 20";
                break;
            case '21+':
                $sql .= " > 20";
                break;
        }
        $stmt = $conn->prepare($sql);
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
            case 'perfil':
                $pdf->filtro_info = 'Filtrado por Perfil: ' . $perfil;
                break;
            case 'endereco':
                $pdf->filtro_info = 'Filtrado por Endereço: ' . $endereco;
                break;
            case 'numero_vagas':
                $pdf->filtro_info = 'Filtrado por Quantidade de Vagas: ' . $vagas;
                break;
        }
    }

    // Adicionar tabela
    $pdf->TableHeader();
    $pdf->TableContent($result);

    // Nome do arquivo
    $filename = 'relatorio_concedentes_' . date('Y-m-d_H-i-s') . '.pdf';

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