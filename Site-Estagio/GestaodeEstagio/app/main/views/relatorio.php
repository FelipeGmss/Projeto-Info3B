<?php
require('../models/cadastros.class.php');
require('../assets/fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        // Set font for title
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 90, 36); // Dark green
        // Title
        $this->Cell(0, 10, 'Relatorio de Empresas', 0, 1, 'C');
        
        // Date
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 8, 'Data: ' . date('d/m/Y H:i'), 0, 1, 'C');
        
        // Search term if exists
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(0, 90, 36);
            $this->Cell(0, 8, 'Termo de busca: ' . htmlspecialchars($_GET['search']), 0, 1, 'C');
        }
        
        // Divider line
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(0.3);
        $this->Line(20, $this->GetY() + 5, $this->w - 20, $this->GetY() + 5);
        
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Table header
    function TableHeader() {
        $this->SetFillColor(0, 90, 36); // Dark green
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 10);

        $header = array('Empresa', 'Contato', 'Endereco', 'Perfil', 'Vagas');
        $w = array(40, 30, 50, 40, 20); // Adjusted for A4 portrait
        for($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
    }

    // Table content
    function TableContent($data) {
        $this->SetFillColor(200, 230, 200); // Light green
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);
        $this->SetDrawColor(0, 90, 36);

        $w = array(40, 30, 50, 40, 20);
        $fill = false;
        foreach($data as $row) {
            if($this->GetY() > 260) { // Check for page break
                $this->AddPage();
                $this->TableHeader();
            }

            // Prepare texts
            $empresa = utf8_decode($row['nome']);
            $contato = utf8_decode($row['contato']);
            $endereco = utf8_decode($row['endereco']);
            $perfil = utf8_decode($row['perfil']);
            $vagas = utf8_decode($row['numero_vagas']);

            // Truncate long texts
            $endereco = (strlen($endereco) > 30) ? substr($endereco, 0, 27) . '...' : $endereco;

            // Calculate height for profile
            $perfilAltura = $this->NbLines($w[3], $perfil) * 5;
            $altura = max(7, $perfilAltura);

            // Save position
            $x = $this->GetX();
            $y = $this->GetY();

            // Draw cells
            $this->Cell($w[0], $altura, $empresa, 1, 0, 'L', $fill);
            $this->Cell($w[1], $altura, $contato, 1, 0, 'L', $fill);
            $this->Cell($w[2], $altura, $endereco, 1, 0, 'L', $fill);
            $this->SetXY($x + $w[0] + $w[1] + $w[2], $y);
            $this->MultiCell($w[3], 7, $perfil, 1, 'J', $fill); // Justified text
            $this->SetXY($x + $w[0] + $w[1] + $w[2] + $w[3], $y);
            $this->Cell($w[4], $altura, $vagas, 1, 0, 'C', $fill);
            $this->Ln($altura);
            $fill = !$fill;
        }
    }

    // Calculate number of lines for MultiCell
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i < $nb) {
            $c = $s[$i];
            if($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax) {
                if($sep == -1) {
                    if($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

// Create PDF document
$pdf = new PDF();
$pdf->SetMargins(20, 20, 20); // Standard Word-like margins
$pdf->AliasNbPages();
$pdf->AddPage(); // A4 portrait
$pdf->SetFont('Arial', '', 12);

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");

// Get search term
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare SQL query
if (!empty($search)) {
    $consulta = 'SELECT * FROM concedentes WHERE 
                 LOWER(nome) LIKE LOWER(:search) OR 
                 LOWER(contato) LIKE LOWER(:search) OR 
                 LOWER(endereco) LIKE LOWER(:search) OR 
                 LOWER(perfil) LIKE LOWER(:search) 
                 ORDER BY nome ASC';
    $query = $pdo->prepare($consulta);
    $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
} else {
    $consulta = 'SELECT * FROM concedentes ORDER BY nome ASC';
    $query = $pdo->prepare($consulta);
}

// Execute query
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Add table
$pdf->TableHeader();
$pdf->TableContent($result);

// Output PDF
$pdf->Output('I', 'relatorio_empresas.pdf');
?>