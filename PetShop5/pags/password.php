<?php
session_start(); // Inicia a sessão do usuário, permitindo que ele possa se deslocar elas páginas sem que deslogue

include_once '../adm/config/conexao.php'; // faz a conexão com o banco de dados definido no conexão.php

if (isset($_SESSION['msg'])) { // Mostra mensagem caso: O usuário foi conectado ou não.
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


$query_users_a = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created, modified FROM usuarios ORDER BY nome ASC";
$result_users_a = $conn->prepare($query_users_a); 
$result_users_a->execute();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/custom.css">
        <title>Recuperção de Login</title>
    </head>
    <body>
        <div class ="center">
            <h1>Esqueceu sua senha?</h1>
            <form method ="POST" action="valida/valida_login.php"> 
                <!--O metodo post não permite que as informações sejam expostas na url do site-->
                <!--A ação, NESTE CASO é feita para enviar os dados para a página valida_login.php, a fim de validar os dados e se condizem com os do banco-->
                <div class="txt_field">
                    <label>Nome do Usuário</label>
                    <input type="text" name="nome" placeholder='Usuário inserido no cadastro' required> <!--O required torna o campo obrigatório-->
                    
                </div>                
                <div class="txt_field">
                    <label>Número de telefone</label>
                    <input type="password" name="senha" placeholder='Número de telefone inserido no cadastro' required>
                </div>
                <br>
                <input type='submit' name='bt_login' value='Login'>
            </form>
        </div>
    </body>
</html>