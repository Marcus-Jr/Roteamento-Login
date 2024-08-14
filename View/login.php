<?php
defined('CONTROL') or die('Acesso negado!');

// verifica se o formulário foi submetido
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // verifica se o usuário e a senha foram submetidos
    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $erro = null;

    if(empty($usuario) || empty($senha)){
        $erro = "Usuario e senha são obrigatórios!";
    }

    // verifica se o usuário e a senha são válidos
    if(empty($erro)){

        $usuarios = require_once __DIR__ . '/../Inc/usuarios.php';

        foreach($usuarios as $user){
            if($user['usuario'] == $usuario && password_verify($senha, $user['senha'])){

                //efetua o login 
                $_SESSION['usuario'] = $usuario;

                // voltar á pagina inicial
                header('location: index.php?rota=home');
            }
        }
        // login inválido
        $erro = "Usuario e/ou senha inválidos";
    }

}
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <form action="index.php?rota=login" method="post">
        <h1>Login</h1>
            <div>
                <label for="usuario">Usuário</label>
                <input type="email" id="usuario" name="usuario">
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha">
            </div>
            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>
        <?php if(!empty($erro)) : ?>
            <p style="color: red;"><?= $erro ?></p>
        <?php endif; ?>

    </div>
    
</body>
</html>