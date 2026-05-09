<?php
// public/teste_historico.php

// 1. Simulação da conexão PDO (O DEV 1 fará o arquivo oficial depois)
$host = 'localhost';
$dbname = 'gerenciador_tarefas';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// ---------------------------------------------------------
// INÍCIO DA SUA LÓGICA DE AUDITORIA (DEV 2)
// ---------------------------------------------------------

// 2. Simulando os dados da tarefa ANTES e DEPOIS da edição
// Imagine que o usuário mudou o status de "pendente" para "concluida"
$dados_antigos = [
    'titulo' => 'Fazer o relatório de PHP',
    'status' => 'pendente'
];

$dados_novos = [
    'titulo' => 'Fazer o relatório de PHP',
    'status' => 'concluida'
];

// 3. A MÁGICA: Convertendo os arrays do PHP para texto JSON
$json_antigo = json_encode($dados_antigos);
$json_novo   = json_encode($dados_novos);

// 4. Inserindo na tabela historico_tarefas com segurança
// Vamos simular que a tarefa alterada é a de ID 1, feita pelo usuário de ID 1
$tarefa_id = 1;
$usuario_id = 1; 
$acao = 'ATUALIZACAO_STATUS'; // Nome da ação padronizada 

$sql = "INSERT INTO historico_tarefas (tarefa_id, usuario_id, acao, dados_antigos, dados_novos) 
        VALUES (:tarefa_id, :usuario_id, :acao, :dados_antigos, :dados_novos)";
        
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tarefa_id', $tarefa_id);
$stmt->bindValue(':usuario_id', $usuario_id);
$stmt->bindValue(':acao', $acao);
$stmt->bindValue(':dados_antigos', $json_antigo);
$stmt->bindValue(':dados_novos', $json_novo);

try {
    // ATENÇÃO: Para este teste funcionar, você precisa ter pelo menos 
    // um usuário (ID 1) e uma tarefa (ID 1) cadastrados no seu banco local!
    $stmt->execute();
    echo "<h2 style='color: blue;'>Histórico de Auditoria salvo com sucesso!</h2>";
    echo "<p><b>Dados Antigos:</b> " . htmlspecialchars($json_antigo) . "</p>";
    echo "<p><b>Dados Novos:</b> " . htmlspecialchars($json_novo) . "</p>";
    echo "<p>Vá até o phpMyAdmin e veja como os dados ficaram registrados na tabela <i>historico_tarefas</i>.</p>";
} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Erro ao salvar histórico:</h2>";
    echo "<p>Lembre-se: Você precisa criar um usuário e uma tarefa manualmente no phpMyAdmin primeiro, por causa das chaves estrangeiras (ON DELETE CASCADE).</p>";
    echo "<p>Detalhe do erro: " . $e->getMessage() . "</p>";
}
?>