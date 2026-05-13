<?php
// Ativando exibição de erros conforme a "Dica de Ouro" do professor
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="tela-login">

    <!-- Main para centralizar o formulário de login -->
    <main class="container-login">
        <header>
            <h2>Acesso ao Sistema</h2>
        </header>

        <!-- O Dev 4 vai configurar o action para validar no banco -->
        <form action="index.php" method="POST">
            <div class="campo-login">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="campo-login">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn-acessar">Entrar</button>
        </form>
    </main>

</body>
</html>