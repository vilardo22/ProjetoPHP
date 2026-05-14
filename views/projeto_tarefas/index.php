<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema de Tarefas - Dev 3</title>
</head>
<body>

    <header>
        <h1>Gerenciador de Tarefas Acadêmico</h1>
    </header>

    <?php include('nav.php'); ?>

    <main>
        <h2>Minhas Tarefas</h2>
        
        <section class="lista-tarefas">
            <!-- Article para card individual -->
            <article class="card-tarefa">
                <h3>Desenvolver Interface PHP</h3>
                <p>Status: <strong>Em andamento</strong></p>
                <p>Prazo: <input type="date" value="2026-05-23"></p>
            </article>

            <article class="card-tarefa">
                <h3>Criar Banco de Dados</h3>
                <p>Status: <strong>Pendente</strong></p>
                <p>Prazo: <input type="date" value="2026-05-30"></p>
            </article>
        </section>

        <hr style="margin: 30px 0;">

        <!-- Interface de Comentários - Demanda 3 -->
        <section class="discussao">
            <h3>Histórico e Comentários</h3>
            <div class="linha-tempo">
                <div class="item-comentario">
                    <strong>Davi:</strong> Estutura de Grid finalizada.
                </div>
                <div class="mensagem-sistema">
                    "O status foi alterado para Em Andamento"
                </div>
            </div>
        </section>
    </main>

</body>
</html>