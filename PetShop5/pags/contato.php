<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/contato.css'>
        <title> Contato</title>
    </head>
    <body>

        <header class="cabecalho">
        <img class="cabecalho_imagem" src="../css/imgs/Logo_SA.png" alt="Logo do pet shop">
        <nav class="cabecalho_menu">
            <!--<a class="cabecalho_menu_item" href="../index.php">Login</a> Antigo botão login, agora substituído por uma condicional.--> 
            <div class="cl-log">
                <?php
                    echo "<h2>Bem vindo(a) ".$_SESSION['nome']."!</h2>"; 
                ?>
            </div>
            <a class="cabecalho_menu_item" href="clientelogged.php">Landing Page</a>
            <a class="cabecalho_menu_item" href="contato.php">Contato</a>
            <a class="cabecalho_menu_item" href="sobre.php">Sobre</a>
            <a class="cabecalho_menu_item" href="../adm/cadastrar.php">Sair</a>
        </nav>
    </header>

    <main class="conteudo">
        <section class="conteudo_principal">
            <div class="conteudo_principal_escrito">
                <h1 class="conteudo_principal_escrito_titulo">Contato</h1><br>
                <h2 class="conteudo_principal_escrito_subtitulo">Contate-nos em caso de dúvidas!</h2>
            </div>
            <div class="list_contatos">
                <ul class="list_main"> <!--Cria lista-->
                    <li><address><a href="https://mail.google.com/mail/u/2/#inbox?compose=CllgCJfnbRXNXgBhWnRqJFWGCXwBMwszXqLfJjxMLrPCgCVNqndjqRLJbJHJGSHtWDmCQbpdgNB" class="list_cont_main">Bruno Schmitz da Silva</a></address></li> <!--Item da lista e tag de endereço-->
                    <br>
                    <li><address><a href="https://mail.google.com/mail/u/2/#inbox?compose=CllgCJfnbRXNXgBhWnRqJFWGCXwBMwszXqLfJjxMLrPCgCVNqndjqRLJbJHJGSHtWDmCQbpdgNB" class="list_cont_main">Beatriz Riscarolli Gamba</a></address></li>
                    <br>
                    <li><address><a href="https://mail.google.com/mail/u/2/#inbox?compose=CllgCJfnbRXNXgBhWnRqJFWGCXwBMwszXqLfJjxMLrPCgCVNqndjqRLJbJHJGSHtWDmCQbpdgNB" class="list_cont_main">Arthur Augusto Dias Alves de Lima</a></address></li>
                    <br>
                    <li><address><a href="https://mail.google.com/mail/u/2/#inbox?compose=CllgCJfnbRXNXgBhWnRqJFWGCXwBMwszXqLfJjxMLrPCgCVNqndjqRLJbJHJGSHtWDmCQbpdgNB" class="list_cont_main">Iasmin Westphal</a></address></li>
                    <br>
                </ul>
            </div>
            
        </section>
        <img class="conteudo_principal_imagem" src="../css/imgs/gato-usando-computador.jpg" alt="Logo do pet shop">

        <div class="text">
                <p>
                    Onde você pode nos encontrar fisicamente?<br><br>
                    <address>
                            Estado: Santa Catarina (SC)<br>
                            Cidade: Blumenau<br>
                            Bairro: Gato De Botas e Chapéu<br>
                            Rua: Petiscos<br>
                            N°: 7370<br><br>
                            Para mais informações:<br> <a>babipetshop@gmail.com</a>
                    </address>
                </p>
            </div>
    </main>
    <footer class="rodape">
        <img class="rodape_imagem" src="../css/imgs/Rodape2_img.png" alt="Nome do pet shop">
    </footer>
    </body>
</html>
