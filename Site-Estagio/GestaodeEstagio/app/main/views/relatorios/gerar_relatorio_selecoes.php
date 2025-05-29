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
        $this->Cell(0, 10, 'Relatório de Seleções', 0, 1, 'C');
        
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

    function TableHeader($tipo_relatorio) {
        $this->SetFillColor(0, 90, 36); // Verde escuro
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 90, 36);
        $this->SetLineWidth(0.2);
        $this->SetFont('Arial', 'B', 10);

        switch ($tipo_relatorio) {
            case 'processo_seletivo':
                $header = array('Concedente', 'Perfil', 'Data', 'Hora', 'Local');
                $w = array(60, 60, 40, 40, 40);
                break;
            case 'inscricoes':
                $header = array('Aluno', 'Curso', 'Concedente', 'Data Inscrição', 'Status');
                $w = array(60, 40, 60, 40, 40);
                break;
            case 'alunos_alocados':
                $header = array('Aluno', 'Curso', 'Concedente', 'Perfil', 'Data Alocação');
                $w = array(60, 40, 60, 40, 40);
                break;
        }

        for($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        }
        $this->Ln();
    }

    function TableContent($data, $tipo_relatorio) {
        $this->SetFillColor(200, 230, 200); // Verde claro
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 9);
        $this->SetDrawColor(0, 90, 36);

        switch ($tipo_relatorio) {
            case 'processo_seletivo':
                $w = array(60, 60, 40, 40, 40);
                break;
            case 'inscricoes':
            case 'alunos_alocados':
                $w = array(60, 40, 60, 40, 40);
                break;
        }

        $fill = false;
        foreach($data as $row) {
            if($this->GetY() > 260) {
                $this->AddPage();
                $this->TableHeader($tipo_relatorio);
            }

            switch ($tipo_relatorio) {
                case 'processo_seletivo':
                    $this->Cell($w[0], 8, utf8_decode($row['nome_empresa']), 1, 0, 'L', $fill);
                    $this->Cell($w[1], 8, utf8_decode($row['perfil']), 1, 0, 'L', $fill);
                    $this->Cell($w[2], 8, $row['data_formatada'], 1, 0, 'C', $fill);
                    $this->Cell($w[3], 8, $row['hora_formatada'], 1, 0, 'C', $fill);
                    $this->Cell($w[4], 8, utf8_decode($row['local']), 1, 1, 'L', $fill);
                    break;
                case 'inscricoes':
                    $this->Cell($w[0], 8, utf8_decode($row['aluno_nome']), 1, 0, 'L', $fill);
                    $this->Cell($w[1], 8, utf8_decode($row['curso']), 1, 0, 'L', $fill);
                    $this->Cell($w[2], 8, utf8_decode($row['concedente_nome']), 1, 0, 'L', $fill);
                    $this->Cell($w[3], 8, $row['data_formatada'], 1, 0, 'C', $fill);
                    $this->Cell($w[4], 8, utf8_decode($row['status_alocacao']), 1, 1, 'C', $fill);
                    break;
                case 'alunos_alocados':
                    $this->Cell($w[0], 8, utf8_decode($row['aluno_nome']), 1, 0, 'L', $fill);
                    $this->Cell($w[1], 8, utf8_decode($row['curso']), 1, 0, 'L', $fill);
                    $this->Cell($w[2], 8, utf8_decode($row['concedente_nome']), 1, 0, 'L', $fill);
                    $this->Cell($w[3], 8, utf8_decode($row['perfil']), 1, 0, 'L', $fill);
                    $this->Cell($w[4], 8, $row['data_formatada'], 1, 1, 'C', $fill);
                    break;
            }
            $fill = !$fill;
        }
    }
}

try {
    // Conexão com o banco de dados
    $conn = getConnection();

    // Processar filtros
    $tipo_relatorio = $_POST['tipo_relatorio'] ?? 'processo_seletivo';
    $curso = $_POST['curso_selecao'] ?? 'todos';

    // Validar curso
    $cursos_validos = ['todos', 'enfermagem', 'informatica', 'administracao', 'edificacoes', 'meio_ambiente'];
    if (!in_array($curso, $cursos_validos)) {
        throw new Exception("Curso inválido selecionado");
    }

    // Construir a query base de acordo com o tipo de relatório
    switch ($tipo_relatorio) {
        case 'processo_seletivo':
            $sql = 'SELECT s.*, c.nome as nome_empresa, c.perfil,
                   DATE_FORMAT(s.data, \'%d/%m/%Y\') as data_formatada
                   FROM selecao s
                   JOIN concedentes c ON s.id_concedente = c.id
                   WHERE s.id_aluno IS NULL';
            break;
        case 'inscricoes':
            $sql = 'SELECT s.*, a.nome as aluno_nome, a.curso, c.nome as concedente_nome, c.perfil,
                   DATE_FORMAT(s.data, \'%d/%m/%Y\') as data_formatada,
                   CASE 
                       WHEN s.id_aluno IS NOT NULL THEN \'Alocado\'
                       ELSE \'Pendente\'
                   END as status_alocacao
                   FROM selecao s
                   JOIN aluno a ON s.id_aluno = a.id 
                   JOIN concedentes c ON s.id_concedente = c.id';
            break;
        case 'alunos_alocados':
            $sql = 'SELECT s.*, a.nome as aluno_nome, a.curso, c.nome as concedente_nome, c.perfil,
                   DATE_FORMAT(s.data, \'%d/%m/%Y\') as data_formatada
                   FROM selecao s
                   JOIN aluno a ON s.id_aluno = a.id 
                   JOIN concedentes c ON s.id_concedente = c.id
                   WHERE s.id_aluno IS NOT NULL';
            break;
    }

    if ($curso !== 'todos') {
        $sql .= " AND a.curso = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a query: " . $conn->error);
        }
        $stmt->bind_param("s", $curso);
    } else {
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a query: " . $conn->error);
        }
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
    $pdf->filtro_info = 'Tipo de Relatório: ' . ucfirst(str_replace('_', ' ', $tipo_relatorio));
    if ($curso !== 'todos') {
        $pdf->filtro_info .= ' | Curso: ' . ucfirst($curso);
    }

    // Adicionar tabela
    $pdf->TableHeader($tipo_relatorio);
    $pdf->TableContent($result, $tipo_relatorio);

    // Nome do arquivo
    $filename = 'relatorio_selecoes_' . date('Y-m-d_H-i-s') . '.pdf';

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