<?php
require('../models/cadastros.class.php');
require('../assets/fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Relatorio de Empresas', 0, 1, 'C');
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
        $header = array('Empresa', 'Contato', 'Endereco', 'Perfil', 'Vagas');
        $w = array(45, 35, 60, 30, 20);
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

        $w = array(45, 35, 60, 30, 20); // Larguras das colunas
        $fill = false;
        foreach($data as $row) {
            if($this->GetY() > 250) {
                $this->AddPage('L');
                $this->TableHeader();
            }

            // Prepara os textos
            $empresa = utf8_decode($row['nome']);
            $contato = utf8_decode($row['contato']);
            $endereco = utf8_decode($row['endereco']);
            $perfil = utf8_decode($row['perfil']);
            $vagas = utf8_decode($row['numero_vagas']);

            // Quebra de texto para endereço e perfil
            $endereco = (strlen($endereco) > 40) ? substr($endereco, 0, 37) . '...' : $endereco;

            // Calcula a altura necessária para o campo perfil
            $perfilAltura = $this->NbLines($w[3], $perfil) * 6;
            $altura = max(6, $perfilAltura);

            // Salva a posição inicial
            $x = $this->GetX();
            $y = $this->GetY();

            // Empresa
            $this->Cell($w[0], $altura, $empresa, 'LR', 0, 'L', $fill);
            // Contato
            $this->Cell($w[1], $altura, $contato, 'LR', 0, 'L', $fill);
            // Endereço
            $this->Cell($w[2], $altura, $endereco, 'LR', 0, 'L', $fill);
            // Perfil (MultiCell)
            $this->SetXY($x + $w[0] + $w[1] + $w[2], $y);
            $this->MultiCell($w[3], 6, $perfil, 0, 'L', $fill);
            // Volta para a posição da próxima célula
            $this->SetXY($x + $w[0] + $w[1] + $w[2] + $w[3], $y);
            // Vagas
            $this->Cell($w[4], $altura, $vagas, 'LR', 0, 'C', $fill);
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

// Verifica se o termo de busca foi passado via GET
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Prepara a consulta SQL
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
    // Se não houver termo de busca, retorna todas as empresas
    $consulta = 'SELECT * FROM concedentes ORDER BY nome ASC';
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
$pdf->Output('I', 'relatorio_empresas.pdf');
?>