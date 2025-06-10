<?php
require('../../models/model-function.php');
require('../../assets/fpdf/fpdf.php');

// Definir fuso horário para Brasil/São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Array com os cursos corretos
$cursos = [
    'enfermagem' => 'Enfermagem',
    'informatica' => 'Informática',
    'administracao' => 'Administração',
    'edificacoes' => 'Edificações',
    'meio_ambiente' => 'Meio Ambiente'
];

class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo
        $this->Image(__DIR__ . '/../../config/img/logo_Salaberga-removebg-preview.png', 10, 10, 30);
        
        // Title
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(45, 71, 57); // Verde musgo
        $this->Cell(0, 15, utf8_decode('Relatório de Alunos'), 0, 1, 'C');
        
        // Date
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(100, 100, 100); // Cinza
        $this->Cell(0, 8, utf8_decode('Data de geração: ' . date('d/m/Y H:i:s')), 0, 1, 'C');
        
        // Search term if exists
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 8, utf8_decode('Termo de busca: ' . htmlspecialchars($_GET['search'])), 0, 1, 'C');
        }
        
        // Linha decorativa
        $this->SetDrawColor(45, 71, 57); // Verde musgo
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY() + 5, $this->GetPageWidth() - 10, $this->GetY() + 5);
        $this->Ln(15);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100); // Cinza
        $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/{nb}'), 0, 0, 'C');
    }

    // Table header
    function TableHeader() {
        $this->SetFillColor(45, 71, 57); // Verde musgo
        $this->SetTextColor(255, 255, 255); // Branco
        $this->SetDrawColor(45, 71, 57); // Verde musgo
        $this->SetLineWidth(0.3);
        $this->SetFont('Arial', 'B', 10);

        // Ajustar larguras das colunas
        $this->CellUTF8(50, 10, 'Nome', 1, 0, 'C', true);
        $this->CellUTF8(30, 10, 'Matrícula', 1, 0, 'C', true);
        $this->CellUTF8(45, 10, 'Curso', 1, 0, 'C', true);
        $this->CellUTF8(75, 10, 'Email', 1, 0, 'C', true);
        $this->CellUTF8(30, 10, 'Contato', 1, 0, 'C', true);
        $this->CellUTF8(80, 10, 'Endereço', 1, 1, 'C', true);
    }

    // Table content
    function TableContent($data) {
        global $cursos; // Adicionar referência global para o array $cursos
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0); // Preto
        $fill = false;

        foreach($data as $row) {
            if($this->GetY() > 260) { // Check for page break
                $this->AddPage();
                $this->TableHeader();
            }

            // Formatar nome do curso
            $curso_formatado = isset($cursos[$row['curso']]) ? $cursos[$row['curso']] : ucfirst($row['curso']);

            // Alternar cores das linhas
            if ($fill) {
                $this->SetFillColor(245, 245, 245); // Cinza muito claro
            } else {
                $this->SetFillColor(255, 255, 255); // Branco
            }

            // Dados com UTF-8
            $this->CellUTF8(50, 8, $row['nome'], 1, 0, 'L', $fill);
            $this->CellUTF8(30, 8, $row['matricula'], 1, 0, 'C', $fill);
            $this->CellUTF8(45, 8, $curso_formatado, 1, 0, 'C', $fill);
            $this->CellUTF8(75, 8, $row['email'], 1, 0, 'L', $fill);
            $this->CellUTF8(30, 8, $row['contato'], 1, 0, 'C', $fill);
            $this->CellUTF8(80, 8, $row['endereco'], 1, 1, 'L', $fill);
            
            $fill = !$fill;
        }
    }

    // Função para célula com UTF-8
    function CellUTF8($w, $h, $txt, $border, $ln, $align, $fill) {
        $txt = utf8_decode($txt);
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill);
    }
}

// Create PDF document
$pdf = new PDF('L'); // Landscape
$pdf->SetMargins(10, 40, 10);
$pdf->AliasNbPages();
$pdf->AddPage();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=u750204740_gestaoestagio", "root", "");

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
                endereco LIKE :search
                ORDER BY nome ASC';
    $query = $pdo->prepare($consulta);
    $query->bindValue(':search', '%' . $search . '%');
} else {
    $consulta = 'SELECT * FROM aluno ORDER BY nome ASC';
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