<?php

// iniciar sessão
session_start();

// define uma constante de controle
define('CONTROL', true);

// verifica se existe um usuário logado
$usuario_logado = $_SESSION['usuario'] ?? null;

// verifa qual a rota na URL
if (empty($usuario_logado)){
    $rota = 'login';
}else{
    $rota = $_GET['rota'] ?? 'home';
}

// se o usuário esta logado, mas a rota é login, vai redirecionar para a home
if(!empty($usuario_logado) && $rota == 'login'){
    $rota = 'home';
}

// analisa a rota
$rotas = [
    'login' => 'login.php',
    'home' => 'home.php',
    'page1' => 'page1.php',
    'page2' => 'page2.php',
    'page3' => 'page3.php',
    'logout' => 'logout.php'
];

if(!key_exists($rota, $rotas)){
    die('Acesso negado');
}

require_once $rotas[$rota];

?>
