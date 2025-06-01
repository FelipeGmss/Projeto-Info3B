<?php
// Prevenir qualquer saída antes do PDF
ob_start();

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
        $this->Cell(0, 15, utf8_decode('Relatório de Processos Seletivos'), 0, 1, 'C');
        
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
    $tipo_relatorio = $_POST['tipo_relatorio'] ?? 'processo_seletivo';
    $curso = $_POST['curso_selecao'] ?? 'todos';

    // Construir a query base de acordo com o tipo de relatório
    switch ($tipo_relatorio) {
        case 'processo_seletivo':
            $sql = "SELECT c.*, 
                    GROUP_CONCAT(DISTINCT s.perfis_selecionados) as perfis_selecionados,
                    COUNT(DISTINCT CASE WHEN s.status = 'alocado' THEN s.id_aluno END) as total_alocados
                    FROM concedentes c 
                    LEFT JOIN selecao s ON c.id = s.id_concedente
                    GROUP BY c.id
                    ORDER BY c.nome ASC";
            if ($curso !== 'todos') {
                $sql .= " HAVING perfis_selecionados LIKE ?";
            }
            break;
        case 'inscricoes':
            $sql = "SELECT s.*, a.nome as aluno_nome, a.curso as aluno_curso,
                    c.nome as concedente_nome, s.perfis_selecionados
                    FROM selecao s 
                    JOIN aluno a ON s.id_aluno = a.id 
                    JOIN concedentes c ON s.id_concedente = c.id 
                    WHERE 1=1";
            if ($curso !== 'todos') {
                $sql .= " AND a.curso = ?";
            }
            $sql .= " ORDER BY s.hora DESC";
            break;
        case 'alunos_alocados':
            $sql = "SELECT a.nome as aluno_nome, a.curso as aluno_curso,
                    c.nome as concedente_nome, s.perfis_selecionados,
                    s.hora as data_selecao 
                    FROM aluno a 
                    JOIN selecao s ON a.id = s.id_aluno 
                    JOIN concedentes c ON s.id_concedente = c.id 
                    WHERE s.status = 'alocado'";
            if ($curso !== 'todos') {
                $sql .= " AND a.curso = ?";
            }
            $sql .= " ORDER BY s.hora DESC";
            break;
    }

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        throw new Exception("Erro ao preparar a query: " . $conn->error);
    }

    if ($curso !== 'todos') {
        $stmt->bind_param("s", $curso);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Criar PDF
    $pdf = new PDF('L'); // Landscape
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Configurar informação do filtro
    $pdf->filtro_info = 'Tipo de Relatório: ' . ucfirst(str_replace('_', ' ', $tipo_relatorio));
    if ($curso !== 'todos') {
        $curso_formatado = isset($cursos[$curso]) ? $cursos[$curso] : ucfirst($curso);
        $pdf->filtro_info .= ' | Curso: ' . $curso_formatado;
    }

    // Cabeçalho da tabela
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(45, 71, 57); // Verde musgo
    $pdf->SetTextColor(255, 255, 255); // Branco
    $pdf->SetDrawColor(45, 71, 57); // Verde musgo
    $pdf->SetLineWidth(0.3);

    // Definir colunas de acordo com o tipo de relatório
    switch ($tipo_relatorio) {
        case 'processo_seletivo':
            $pdf->CellUTF8(70, 10, 'Empresa', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Perfis', 1, 0, 'C', true);
            $pdf->CellUTF8(30, 10, 'Vagas', 1, 0, 'C', true);
            $pdf->CellUTF8(30, 10, 'Alocados', 1, 0, 'C', true);
            $pdf->CellUTF8(50, 10, 'Contato', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Endereço', 1, 1, 'C', true);
            break;
        case 'inscricoes':
            $pdf->CellUTF8(60, 10, 'Aluno', 1, 0, 'C', true);
            $pdf->CellUTF8(40, 10, 'Curso', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Empresa', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Perfis', 1, 0, 'C', true);
            $pdf->CellUTF8(40, 10, 'Data', 1, 0, 'C', true);
            $pdf->CellUTF8(40, 10, 'Status', 1, 1, 'C', true);
            break;
        case 'alunos_alocados':
            $pdf->CellUTF8(60, 10, 'Aluno', 1, 0, 'C', true);
            $pdf->CellUTF8(40, 10, 'Curso', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Empresa', 1, 0, 'C', true);
            $pdf->CellUTF8(60, 10, 'Perfis', 1, 0, 'C', true);
            $pdf->CellUTF8(40, 10, 'Data Alocação', 1, 1, 'C', true);
            break;
    }

    // Dados da tabela
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0); // Preto
    $fill = false;

    while ($row = $result->fetch_assoc()) {
        // Alternar cores das linhas
        if ($fill) {
            $pdf->SetFillColor(245, 245, 245); // Cinza muito claro
        } else {
            $pdf->SetFillColor(255, 255, 255); // Branco
        }
        
        // Processar perfis selecionados
        $perfis = [];
        if (!empty($row['perfis_selecionados'])) {
            $perfis_array = explode(',', $row['perfis_selecionados']);
            foreach ($perfis_array as $p) {
                $p = trim($p, '[]"');
                if (!empty($p) && !in_array($p, $perfis)) {
                    // Formatar nome do curso se o perfil for um curso
                    $p = isset($cursos[$p]) ? $cursos[$p] : $p;
                    $perfis[] = $p;
                }
            }
        }
        $perfis_text = !empty($perfis) ? implode(', ', $perfis) : 'Nenhum';
        
        // Formatar nome do curso apenas se existir
        $curso_formatado = '';
        if (isset($row['aluno_curso'])) {
            $curso_formatado = isset($cursos[$row['aluno_curso']]) ? $cursos[$row['aluno_curso']] : ucfirst($row['aluno_curso']);
        }
        
        switch ($tipo_relatorio) {
            case 'processo_seletivo':
                $pdf->CellUTF8(70, 8, $row['nome'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $perfis_text, 1, 0, 'L', $fill);
                $pdf->CellUTF8(30, 8, $row['numero_vagas'], 1, 0, 'C', $fill);
                $pdf->CellUTF8(30, 8, $row['total_alocados'] ?? '0', 1, 0, 'C', $fill);
                $pdf->CellUTF8(50, 8, $row['contato'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $row['endereco'], 1, 1, 'L', $fill);
                break;
            case 'inscricoes':
                $pdf->CellUTF8(60, 8, $row['aluno_nome'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(40, 8, $curso_formatado, 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $row['concedente_nome'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $perfis_text, 1, 0, 'L', $fill);
                $pdf->CellUTF8(40, 8, date('d/m/Y H:i', strtotime($row['hora'])), 1, 0, 'C', $fill);
                $pdf->CellUTF8(40, 8, $row['status'], 1, 1, 'C', $fill);
                break;
            case 'alunos_alocados':
                $pdf->CellUTF8(60, 8, $row['aluno_nome'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(40, 8, $curso_formatado, 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $row['concedente_nome'], 1, 0, 'L', $fill);
                $pdf->CellUTF8(60, 8, $perfis_text, 1, 0, 'L', $fill);
                $pdf->CellUTF8(40, 8, date('d/m/Y H:i', strtotime($row['data_selecao'])), 1, 1, 'C', $fill);
                break;
        }
        $fill = !$fill;
    }

    // Limpar qualquer saída anterior
    ob_clean();

    // Nome do arquivo
    $filename = 'relatorio_selecoes_' . date('Y-m-d_H-i-s') . '.pdf';

    // Enviar o PDF para o navegador
    $pdf->Output('I', $filename);

} catch (Exception $e) {
    // Limpar qualquer saída anterior em caso de erro
    ob_clean();
    die('Erro ao gerar relatório: ' . $e->getMessage());
}

// Limpar o buffer de saída
ob_end_flush();
?> 