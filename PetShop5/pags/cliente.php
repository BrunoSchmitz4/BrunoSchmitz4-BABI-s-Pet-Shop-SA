<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC"; 
$result_nivel_acesso = $conn->prepare($query_niveis_acessos); 
$result_nivel_acesso->execute();    
// var_dump($result_nivel_acesso);

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC";
$result_cep = $conn->prepare($query_ceps);
$result_cep->execute();

$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/cliente.css'>
        <title>Landing Page | Serviços</title>
    </head>
    <body>
        <header class="cabecalho">
        <img class="cabecalho_imagem" src="../css/imgs/Logo_SA.png" alt="Logo do pet shop">
        <nav class="cabecalho_menu">
            <a class="cabecalho_menu_item" href="../index.php">Login</a>
            <a class="cabecalho_menu_item" href="../adm/cadastrar.php">Cadastro</a>
            <a class="cabecalho_menu_item" href="contato.php">Contato</a>
            <a class="cabecalho_menu_item" href="sobre.php">Sobre</a>
        </nav>
    </header>
    <main class="conteudo">
        <section class="conteudo_principal">
            <div class="conteudo_principal_escrito">
                <h1 class="conteudo_principal_escrito_titulo">Serviços</h1>
                <h2 class="conteudo_principal_escrito_subtitulo">Tornando a vida do seu pet melhor!</h2>
                <button class="conteudo_principal_escrito_botao"><a href="formlogged.php" class="conteudo_principal_escrito_botao_link">Envie um formulário!</a></button>
            </div>
            <img src="../css/imgs/img_main_content_center.jpg" alt="Imagem: Conteúdo Principal/Centro" class="conteudo_principal_imagem">
        </section>
        <section class="conteudo_secundario">
            <h3 class="conteudo_secundario_titulo">O que podemos fazer pelo seu pet?</h3>
            <p class="conteudo_secundario_paragrafo">1. <strong>Banho</strong></p>
            <span class="conteudo_secundario_paragrafo_span">Nós nos encarregaremos de dar o banho necessário e adequado para seu pet, utilizando produtos 
                como shamppos e condicionadores dedicados à espécie.</span>
            <img width="450px" height="250" src="../css/imgs/1/img_banho.png" alt="Imagem do serviço: banho" class="conteudo_secundario_paragrafo_img">
            
            <p class="conteudo_secundario_paragrafo">2. <strong>Tosa</strong></p>
            <span class="conteudo_secundario_paragrafo_span">Faremos uma tosa, dado o pelo do pet, trazendo conforto e uma higienização adequada para seu pet.</span>
            <img width="450px" height="250" src="../css/imgs/2/img_tosa.jpg" alt="Imagem do serviço: tosa" class="conteudo_secundario_paragrafo_img">
            
            <p class="conteudo_secundario_paragrafo">3. <strong>Cuidados Especias</strong></p>
            <span class="conteudo_secundario_paragrafo_span">Iremos nos certificar que todo e qualquer cuidado especial necessário seja devidamente atendido sem retirar o conforto do pet no meio do processo.</span>
            <img width="450px" height="250" src="../css/imgs/3/img_cuidadosespeciais.png" alt="Imagem do serviço: cuidados especiais" class="conteudo_secundario_paragrafo_img">
        
        </section>
    </main>
    <footer class="rodape">
        <img class="rodape_imagem" src="../css/imgs/Rodape2_img.png" alt="Nome do pet shop">
    </footer>
    </body>
</html>
