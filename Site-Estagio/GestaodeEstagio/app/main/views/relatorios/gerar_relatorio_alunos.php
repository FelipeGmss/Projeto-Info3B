<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../assets/fpdf/fpdf.php';

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
    public $filtro_info;

    function Header() {
        // Logo
        $this->Image(__DIR__ . '/../../config/img/logo_Salaberga-removebg-preview.png', 10, 10, 30);
        
        // Título
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(45, 71, 57); // Verde musgo
        $this->Cell(0, 15, utf8_decode('Relatório de Alunos'), 0, 1, 'C');
        
        // Data
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(100, 100, 100); // Cinza
        $this->Cell(0, 8, utf8_decode('Data de geração: ' . date('d/m/Y H:i:s')), 0, 1, 'C');
        
        // Informação do filtro
        if (isset($this->filtro_info)) {
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 8, utf8_decode($this->filtro_info), 0, 1, 'C');
        }
        
        // Linha decorativa
        $this->SetDrawColor(45, 71, 57); // Verde musgo
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY() + 5, $this->GetPageWidth() - 10, $this->GetY() + 5);
        $this->Ln(15);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100); // Cinza
        $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/{nb}'), 0, 0, 'C');
    }

    // Função para converter texto para UTF-8
    function TextUTF8($x, $y, $txt) {
        $txt = utf8_decode($txt);
        $this->Text($x, $y, $txt);
    }

    // Função para célula com UTF-8
    function CellUTF8($w, $h, $txt, $border, $ln, $align, $fill) {
        $txt = utf8_decode($txt);
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill);
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
                $curso_formatado = isset($cursos[$curso]) ? $cursos[$curso] : ucfirst($curso);
                $pdf->filtro_info = 'Filtrado por Curso: ' . $curso_formatado;
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
    $pdf->SetFillColor(45, 71, 57); // Verde musgo
    $pdf->SetTextColor(255, 255, 255); // Branco
    $pdf->SetDrawColor(45, 71, 57); // Verde musgo
    $pdf->SetLineWidth(0.3);
    
    // Ajustar larguras das colunas
    $pdf->CellUTF8(50, 10, 'Nome', 1, 0, 'C', true);
    $pdf->CellUTF8(30, 10, 'Matrícula', 1, 0, 'C', true);
    $pdf->CellUTF8(45, 10, 'Curso', 1, 0, 'C', true);
    $pdf->CellUTF8(75, 10, 'Email', 1, 0, 'C', true);
    $pdf->CellUTF8(30, 10, 'Contato', 1, 0, 'C', true);
    $pdf->CellUTF8(80, 10, 'Endereço', 1, 1, 'C', true);

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        // Formatar nome do curso
        $curso_formatado = isset($cursos[$row['curso']]) ? $cursos[$row['curso']] : ucfirst($row['curso']);

        // Alternar cores das linhas
        if ($fill) {
            $pdf->SetFillColor(245, 245, 245); // Cinza muito claro
        } else {
            $pdf->SetFillColor(255, 255, 255); // Branco
        }
        
        // Dados com UTF-8
        $pdf->CellUTF8(50, 8, $row['nome'], 1, 0, 'L', $fill);
        $pdf->CellUTF8(30, 8, $row['matricula'], 1, 0, 'C', $fill);
        $pdf->CellUTF8(45, 8, $curso_formatado, 1, 0, 'C', $fill);
        $pdf->CellUTF8(75, 8, $row['email'], 1, 0, 'L', $fill);
        $pdf->CellUTF8(30, 8, $row['contato'], 1, 0, 'C', $fill);
        $pdf->CellUTF8(80, 8, $row['endereco'], 1, 1, 'L', $fill);
        
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