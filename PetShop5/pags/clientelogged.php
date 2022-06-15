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
        <title> Landing Page | Serviços</title>
    </head>
    <body>
        <header class="cabecalho">
        <img class="cabecalho_imagem" src="../css/imgs/Logo_SA.png" alt="Logo do pet shop">
        <nav class="cabecalho_menu">
            <!--<a class="cabecalho_menu_item" href="../index.php">Login</a> Antigo botão login, agora substituído por uma condicional.--> 
            <div class="cl-log">
                <?php
                    echo "<h2>Bem vindo(a) ".$_SESSION['nome']."!</h2>"; // Mostra o nome da pessoa que iniciou a sessão
                ?>
            </div>
            <a class="cabecalho_menu_item" href="../adm/cadastrar.php">Sair</a>
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
                <?php
                    echo "<option value=''></option>";
                    while ($row_servicos = $result_servicos->fetch(PDO::FETCH_ASSOC)){
                        extract($row_servicos);
                        /*(echo "<ul>
                        <li>ID: $id</li>
                        <li>Tipo de serviço: $tipo_servico</li>
                        <li>Descrição: $descricao</li>
                        </ul>";*/
                        echo "
                        <p class='conteudo_secundario_paragrafo'>$id. <strong>$tipo_servico</strong></p>
                        <span class='conteudo_secundario_paragrafo_span'>$descricao</span>
                        <img width='450px' height='250' src='../css/imgs/$id/$imagem' alt='Imagem do serviço: $tipo_servico' class='conteudo_secundario_paragrafo_img'>
                        ";
                    }
                
                
                     
                ?>
        
        </section>
    </main>
    <footer class="rodape">
        <img class="rodape_imagem" src="../css/imgs/Rodape2_img.png" alt="Nome do pet shop">
    </footer>
    </body>
</html>
