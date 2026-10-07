<?php

// dados para conexão mysql
$host = "localhost";
$banco = "matheus315";
$usuario = "matheus315";
$senha = "315!@#";

// PDO = PHP DATA OBJECTS - É UMA FERRAMENTEA DO PHP PARA CONVERSAR COM BANCO DE DADOS
try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);

    // -> SERVE PARA PUXAR ALGO QUE PERTENCE AQUELE OBJETO
    // PDO:: ATTR_ERRMODE - É PARA CONFIGURAR O MODO DE ERROS DO PDO
    // PDO::ERRMODE_EXCEPTION - É PARA QUANDO ACONTECER ALGUM ERRO, TRANSFORMAR EM EXECUÇÃO
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "<h1> conectado com sucesso!";

} catch (PDOException $erro) {

    echo "Erro ao conectar:".$erro->getMessage();


}
