<?php

// 1. Simulação da conexão com o banco (O DEV 1 fará esse arquivo database.php)
// Como estamos testando, vamos criar um PDO básico aqui no topo.
$host = 'localhost';
$dbname = "gerenciador_tarefas";
$user = "root";
$pass = '';

try {
    $pdo = new  PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4",$user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch (PDOException $e){
    die("Erro na conexão: " . $e->getMessage());
}

// 2. Lógica para processar o formulário quando o usuário clicar em "Cadastrar"

if($_SERVER["REQUEST_METHOD"] === "POST"){
    //Pegando dados do formulario

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Criptografando a senha com pdrão nativo e seguro do PHP

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // 3. Salvando no banco de dados com Segurança (Prepared Statements)
    // NUNCA coloque variáveis diretas no SQL (ex: VALUES ('$nome')). Isso causa SQL Injection!
    // Usamos 'marcadores' como :nome para proteger o banco.

    $sql = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)";
    $stmt = $pdo->prepare($sql);

    // Substituindo os marcadores pelos dados reais recebidos

    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha_hash", $senha_criptografada);

    try{
        $stmt->execute();
        echo "<p style='color: green;'><b>Usuário cadastrado com sucesso! Veja no phpMyAdmin como a senha ficou misturada.</b></p>";
    } catch (PDOException $e){
        echo "<p style='color: red;'>Erro ao cadastrar: O e-mail já pode estar em uso.</p>";
    }


}
?>
<!-- Formulário HTML Básico -->
<h2>Cadastro de Membro da Equipe</h2>
<form method="POST" action="cadastro.php">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>
    
    <label>E-mail:</label><br>
    <input type="email" name="email" required><br><br>
    
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    
    <button type="submit">Cadastrar</button>
</form>