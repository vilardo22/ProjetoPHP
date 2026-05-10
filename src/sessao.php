<?php

session_start();

function exigir_login() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

function fazer_login($id, $nome) {
    session_regenerate_id(true);
    $_SESSION['usuario_id'] = $id;
    $_SESSION['nome']       = $nome;
}

function fazer_logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}

function pode_alterar_tarefa($tarefa) {
    return $_SESSION['usuario_id'] == $tarefa['criador_id'] 
        || $_SESSION['usuario_id'] == $tarefa['responsavel_id'];
}