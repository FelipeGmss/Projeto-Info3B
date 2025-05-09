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
        $this->Cell(0, 10, 'Relatorio de Alunos', 0, 1, 'C');
        
        // Line break for spacing
        $this->Ln(5);

        // Date and time
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 8, 'Data: ' . date('d \d\e F \d\e Y, H:i'), 0, 1, 'C'); // e.g., "08 de Maio de 2025, 14:30"
        
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

        // Center table
        $tableWidth = array_sum(array(40, 20, 25, 30, 30, 35));
        $startX = ($this->w - $tableWidth) / 2;
        $this->SetX($startX);

        $header = array('Nome', 'Matricula', 'Contato', 'Curso', 'E-mail', 'Endereco');
        $w = array(35, 25, 25, 30, 30, 35);
        $align = array('J', 'C', 'C', 'L', 'L', 'J');
        for($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, $align[$i], true);
        }
        $this->Ln();
    }

    // Table content
    function TableContent($data) {
        $this->SetFillColor(200, 230, 200); // Light green
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);
        $this->SetDrawColor(0, 90, 36);

        $w = array(35, 25, 25, 30, 30, 35);
        $fill = false;
        foreach($data as $row) {
            if($this->GetY() > 260) { // Check for page break
                $this->AddPage();
                $this->TableHeader();
            }

            // Center table
            $tableWidth = array_sum($w);
            $startX = ($this->w - $tableWidth) / 2;
            $this->SetX($startX);

            // Prepare texts
            $nome = utf8_decode($row['nome']);
            $matricula = utf8_decode($row['matricula']);
            $contato = utf8_decode($row['contato']);
            $curso = utf8_decode($row['curso']);
            $email = utf8_decode($row['email']);
            $endereco = utf8_decode($row['endereco']);

            // Truncate long texts
            $endereco = (strlen($endereco) > 25) ? substr($endereco, 0, 22) . '...' : $endereco;

            // Calculate height for nome and endereco
            $nomeAltura = $this->NbLines($w[0], $nome) * 5;
            $enderecoAltura = $this->NbLines($w[5], $endereco) * 5;
            $altura = max(7, $nomeAltura, $enderecoAltura);

            // Save position
            $x = $this->GetX();
            $y = $this->GetY();

            // Nome (MultiCell)
            $this->SetXY($x, $y);
            $this->MultiCell($w[0], 7, $nome, 1, 'J', $fill);
            $this->SetXY($x + $w[0], $y);
            
            // Matrícula
            $this->Cell($w[1], $altura, $matricula, 1, 0, 'C', $fill);
            // Contato
            $this->Cell($w[2], $altura, $contato, 1, 0, 'C', $fill);
            // Curso
            $this->Cell($w[3], $altura, $curso, 1, 0, 'L', $fill);
            // Email
            $this->Cell($w[4], $altura, $email, 1, 0, 'L', $fill);
            // Endereço (MultiCell)
            $this->SetXY($x + $w[0] + $w[1] + $w[2] + $w[3] + $w[4], $y);
            $this->MultiCell($w[5], 7, $endereco, 1, 'J', $fill);
            
            // New line
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
$pdf->SetMargins(20, 20, 20); // Equal margins
$pdf->AliasNbPages();
$pdf->AddPage(); // A4 portrait
$pdf->SetFont('Arial', '', 12);

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");

// Get search term
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepare SQL query
if (!empty($search)) {
    $consulta = 'SELECT * FROM aluno WHERE 
                nome LIKE :search OR 
                matricula LIKE :search OR 
                curso LIKE :search OR 
                email LIKE :search OR 
                contato LIKE :search OR 
                endereco LIKE :search';
    $query = $pdo->prepare($consulta);
    $query->bindValue(':search', '%' . $search . '%');
} else {
    $consulta = 'SELECT * FROM aluno';
    $query = $pdo->prepare($consulta);
}

// Execute query
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Add table
$pdf->TableHeader();
$pdf->TableContent($result);

// Output PDF
$pdf->Output('I', 'relatorio_alunos.pdf');
?>