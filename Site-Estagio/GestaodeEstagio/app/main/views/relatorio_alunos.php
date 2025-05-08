<?php
require('../models/cadastros.class.php');
require('../assets/fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Relatorio de Alunos', 0, 1, 'C');
        // Subtitle with date
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, 'Data: ' . date('d/m/Y H:i'), 0, 1, 'C');
        
        // Search term if exists
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 10, 'Termo de busca: ' . $_GET['search'], 0, 1, 'C');
        }
        
        // Line break
        $this->Ln(5);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Table header
    function TableHeader() {
        // Colors, line width and bold font
        $this->SetFillColor(0, 90, 36); // Verde escuro
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 10);

        // Header
        $header = array('Nome', 'Matrícula', 'Contato', 'Curso', 'E-mail', 'Endereço');
        $w = array(50, 25, 30, 40, 50, 50);
        for($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
    }

    // Table content
    function TableContent($data) {
        // Colors, line width and normal font
        $this->SetFillColor(240, 240, 240);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);

        $w = array(50, 25, 30, 40, 50, 50); // Larguras das colunas
        $fill = false;
        foreach($data as $row) {
            if($this->GetY() > 250) {
                $this->AddPage('L');
                $this->TableHeader();
            }

            // Prepara os textos
            $nome = utf8_decode($row['nome']);
            $matricula = utf8_decode($row['matricula']);
            $contato = utf8_decode($row['contato']);
            $curso = utf8_decode($row['curso']);
            $email = utf8_decode($row['email']);
            $endereco = utf8_decode($row['endereco']);

            // Calcula a altura necessária para o campo nome
            $nomeAltura = $this->NbLines($w[0], $nome) * 6;
            $altura = max(6, $nomeAltura);

            // Salva a posição inicial
            $x = $this->GetX();
            $y = $this->GetY();

            // Nome (MultiCell)
            $this->SetXY($x, $y);
            $this->MultiCell($w[0], 6, $nome, 0, 'L', $fill);
            // Volta para a posição da próxima célula
            $this->SetXY($x + $w[0], $y);
            
            // Matrícula
            $this->Cell($w[1], $altura, $matricula, 'LR', 0, 'C', $fill);
            // Contato
            $this->Cell($w[2], $altura, $contato, 'LR', 0, 'C', $fill);
            // Curso
            $this->Cell($w[3], $altura, $curso, 'LR', 0, 'L', $fill);
            // Email
            $this->Cell($w[4], $altura, $email, 'LR', 0, 'L', $fill);
            // Endereço
            $this->Cell($w[5], $altura, $endereco, 'LR', 0, 'L', $fill);
            
            // Nova linha
            $this->Ln($altura);
            $fill = !$fill;
        }
        // Linha de fechamento
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Função auxiliar para contar linhas necessárias para o MultiCell
    function NbLines($w, $txt) {
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb) {
            $c = $s[$i];
            if($c=="\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax) {
                if($sep==-1) {
                    if($i==$j)
                        $i++;
                } else
                    $i = $sep+1;
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

// Create new PDF document
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // Landscape orientation
$pdf->SetFont('Arial', '', 12);

// Get data from database with search filter
$pdo = new PDO("mysql:host=localhost;dbname=estagio", "root", "");
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepara a consulta SQL
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
    // Se não houver termo de busca, retorna todos os alunos
    $consulta = 'SELECT * FROM aluno';
    $query = $pdo->prepare($consulta);
}

// Executa a consulta
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Add table header
$pdf->TableHeader();

// Add table content
$pdf->TableContent($result);

// Output PDF
$pdf->Output('I', 'relatorio_alunos.pdf');
?> 