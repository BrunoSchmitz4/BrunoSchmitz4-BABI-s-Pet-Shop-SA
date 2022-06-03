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
        <link rel='stylesheet' href='../css/sobre.css'>
        <title> Sobre</title>
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
                <h1 class="conteudo_principal_escrito_titulo">Sobre nós</h1>
                <h2 class="conteudo_principal_escrito_subtitulo">Quem somos?</h2>
            </div>
            <img src="../css/imgs/Equipo-de-Clinica-Veterinaria-Ejea.jpg" alt="Imagem: Conteúdo Principal/Centro" class="conteudo_principal_imagem">
        </section>
        <div class="conteudo_secundario_escrito">
            <div class="text">
                <p>
                    Somos uma equipe de profissionais dedicados a trazer o tratamento ideal para seu pet. Acreditamos que todo animal de estimação merece ser tratado com respeito, amor e carinho, por isso estamos dispostos a ajudar seu pet a ter uma vida saudável! 
                </p>
            </div>
            
        </div>
    </main>
    <footer class="rodape">
        <img class="rodape_imagem" src="../css/imgs/Rodape2_img.png" alt="Nome do pet shop">
    </footer>
    </body>
</html>
