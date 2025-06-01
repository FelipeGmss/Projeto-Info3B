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
        $this->Cell(0, 15, utf8_decode('Relatório de Empresas Concedentes'), 0, 1, 'C');
        
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
    $filtro = $_POST['filtro_concedente'] ?? 'todos';
    $perfil = $_POST['perfil'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    // Construir a query base
    $sql = "SELECT c.*, 
            GROUP_CONCAT(DISTINCT s.perfis_selecionados) as perfis_selecionados
            FROM concedentes c 
            LEFT JOIN selecao s ON c.id = s.id_concedente
            GROUP BY c.id
            ORDER BY c.nome ASC";
    
    if ($filtro === 'perfil' && !empty($perfil)) {
        $sql .= " HAVING perfis_selecionados LIKE ?";
        $perfil = "%$perfil%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $perfil);
    } elseif ($filtro === 'endereco' && !empty($endereco)) {
        $sql .= " WHERE c.endereco LIKE ?";
        $endereco = "%$endereco%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $endereco);
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
                // Formatar nome do curso se o perfil for um curso
                $curso_formatado = isset($cursos[$perfil]) ? $cursos[$perfil] : $perfil;
                $pdf->filtro_info = 'Filtrado por Perfil: ' . $curso_formatado;
                break;
            case 'endereco':
                $pdf->filtro_info = 'Filtrado por Endereço: ' . $endereco;
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
    $pdf->CellUTF8(80, 10, 'Empresa', 1, 0, 'C', true);
    $pdf->CellUTF8(60, 10, 'Perfis', 1, 0, 'C', true);
    $pdf->CellUTF8(30, 10, 'Vagas', 1, 0, 'C', true);
    $pdf->CellUTF8(60, 10, 'Contato', 1, 0, 'C', true);
    $pdf->CellUTF8(80, 10, 'Endereço', 1, 1, 'C', true);

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        // Processar perfis selecionados
        $perfis = [];
        if (!empty($row['perfis_selecionados'])) {
            $perfis_array = explode(',', $row['perfis_selecionados']);
            foreach ($perfis_array as $p) {
                $p = trim($p, '[]"');
                if (!empty($p)) {
                    // Formatar nome do curso se o perfil for um curso
                    $p = isset($cursos[$p]) ? $cursos[$p] : $p;
                    if (!in_array($p, $perfis)) {
                        $perfis[] = $p;
                    }
                }
            }
        }
        $perfis_text = !empty($perfis) ? implode(', ', $perfis) : 'Nenhum';

        // Alternar cores das linhas
        if ($fill) {
            $pdf->SetFillColor(245, 245, 245); // Cinza muito claro
        } else {
            $pdf->SetFillColor(255, 255, 255); // Branco
        }

        $pdf->CellUTF8(80, 8, $row['nome'], 1, 0, 'L', $fill);
        $pdf->CellUTF8(60, 8, $perfis_text, 1, 0, 'L', $fill);
        $pdf->CellUTF8(30, 8, $row['numero_vagas'], 1, 0, 'C', $fill);
        $pdf->CellUTF8(60, 8, $row['contato'], 1, 0, 'L', $fill);
        $pdf->CellUTF8(80, 8, $row['endereco'], 1, 1, 'L', $fill);
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