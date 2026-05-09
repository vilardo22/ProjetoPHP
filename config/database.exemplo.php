<?php

function conectar() {
    try {
        $pdo = new PDO(
            'mysql:host=SEU_HOST;dbname=SEU_BANCO;charset=utf8',
            'SEU_USUARIO',
            'SUA_SENHA',
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
        return $pdo;

    } catch (PDOException $e) {
        die('Não foi possível conectar ao banco de dados.');
    }
}