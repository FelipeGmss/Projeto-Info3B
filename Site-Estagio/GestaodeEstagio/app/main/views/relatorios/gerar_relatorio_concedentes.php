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
        $this->Cell(0, 10, 'Relatório de Concedentes', 0, 1, 'C');
        
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

    // Criar PDF
    $pdf = new PDF('L'); // Landscape
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

    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(0, 140, 69); // Verde
    $pdf->SetTextColor(255, 255, 255); // Branco
    
    $pdf->Cell(70, 10, 'Nome', 1, 0, 'C', true);
    $pdf->Cell(45, 10, 'Perfil', 1, 0, 'C', true);
    $pdf->Cell(65, 10, 'Contato', 1, 0, 'C', true);
    $pdf->Cell(45, 10, 'Vagas', 1, 0, 'C', true);
    $pdf->Cell(65, 10, 'Endereço', 1, 1, 'C', true);

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        $pdf->SetFillColor(242, 242, 242); // Cinza claro
        $pdf->Cell(70, 8, utf8_decode($row['nome']), 1, 0, 'L', $fill);
        $pdf->Cell(45, 8, utf8_decode($row['perfil']), 1, 0, 'C', $fill);
        $pdf->Cell(65, 8, utf8_decode($row['contato']), 1, 0, 'L', $fill);
        $pdf->Cell(45, 8, utf8_decode($row['numero_vagas']), 1, 0, 'C', $fill);
        $pdf->Cell(65, 8, utf8_decode($row['endereco']), 1, 1, 'L', $fill);
        $fill = !$fill;
    }

    // Nome do arquivo
    $filename = 'relatorio_concedentes_' . date('Y-m-d_H-i-s') . '.pdf';

    // Enviar o PDF para o navegador
    $pdf->Output('I', $filename);

} catch (Exception $e) {
    die('Erro ao gerar relatório: ' . $e->getMessage());
}
?> 