-- Cria o banco de dados e define o uso
CREATE DATABASE gerenciador_tarefas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gerenciador_tarefas;

-- 1. Tabela de Usuários (Membros da equipe)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL, -- Aqui entra a criptografia que faremos depois
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabela de Tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    prazo DATE NOT NULL,
    -- O ENUM trava as opções, evitando que salvem status inválidos
    status ENUM('pendente', 'em andamento', 'concluida') DEFAULT 'pendente', 
    criador_id INT NOT NULL,
    responsavel_id INT NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Chaves Estrangeiras ligando a tarefa aos usuários
    FOREIGN KEY (criador_id) REFERENCES usuarios(id),
    FOREIGN KEY (responsavel_id) REFERENCES usuarios(id)
);

-- 3. Tabela de Comentários
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT NOT NULL,
    usuario_id INT NOT NULL,
    conteudo TEXT NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    -- ON DELETE CASCADE: Se a tarefa for apagada, os comentários somem junto
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 4. Tabela de Histórico de Alterações (Auditoria)
CREATE TABLE historico_tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tarefa_id INT NOT NULL,
    usuario_id INT NOT NULL, -- Quem fez a alteração
    dados_antigos TEXT, -- Vamos salvar os dados antigos em formato JSON (string) aqui
    dados_novos TEXT,   -- E os dados novos aqui
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (tarefa_id) REFERENCES tarefas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);