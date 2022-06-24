<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once '../adm/config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

// Query dos portes
$query_portes = "SELECT id, nome FROM portes ORDER BY nome ASC"; 
$result_portes = $conn->prepare($query_portes); 
$result_portes->execute();    
// var_dump($result_nivel_acesso);

// Query das espécies
$query_especies = "SELECT id, nome FROM especies ORDER BY nome ASC";
$result_especies = $conn->prepare($query_especies);
$result_especies->execute();

// Query dos serviços
$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();

// Query dos serviços prestados
$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();

// Query dos tosadores
$query_servicos = "SELECT id, tipo_servico, descricao, imagem FROM servicos ORDER BY id ASC";
$result_servicos = $conn->prepare($query_servicos);
$result_servicos->execute();
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/colab.css'/>
        <title>Formulário de Serviços</title>
    </head>
    <body class="escopo">
            <header class="cabecalho">

            <img class="cabecalho_imagem" src="../css/imgs/Logo_SA.png" alt="Logo do pet shop">

                <div class="cabecalho-titulo">
                    <h1>
                        Cadastro do Pet
                    </h1>
                </div>

               
        <nav class="cabecalho_menu">
            <!--<a class="cabecalho_menu_item" href="../index.php">Login</a>-->
            <div class="cl-log">
                <?php
                    echo "<h2>Bem vindo(a) ".$_SESSION['nome']."!</h2>"; 
                ?>
            </div>
            <a class="cabecalho_menu_item" href="../adm/cadastrar.php">Cadastro</a>
            <a class="cabecalho_menu_item" href="contato.php">Contato</a>
            <a class="cabecalho_menu_item" href="sobre.php">Sobre</a>
        </nav>

            </header>

            <main class="conteudo-principal">

                <!-- Formulário para cadastrar Pet-->
                <div class="all-forms">
                    <div class="form-1">
                        <form method="POST" action="../valida/valida_pet.php">

                        <h2 class="subtitulo">Insira os dados do seu pet</h2>

                        <div class="conteudo-form">
                            <div class="campo-form">
                                <label class="label-form" >Nome do pet:</label>
                                <input class="inserts-form" class="input-form" type="text" name="pet_nome" required>
                            </div>

                            <div class="campo-form">

                            <label class="label-form">Porte do pet</label>
                            <select name="porte_id" class="select-form" class="inserts-form">
                            <?php
                                    echo "<option value=''>Selecione</option>";
                                    while ($row_portes = $result_portes->fetch(PDO::FETCH_ASSOC)) {
                                        extract($row_portes);
                                        echo "<option value = $id>$id - $nome</option>";
                                    }
                                ?>
                            </select>

                            </div>

                            <div class="campo-form">

                            <label class="label-form">Espécie do pet</label>
                            <select name="especie_id" class="select-form" class="inserts-form">
                            <?php
                                    echo "<option value=''>Selecione</option>";
                                    while ($row_especies = $result_especies->fetch(PDO::FETCH_ASSOC)) {
                                        extract($row_especies);
                                        echo "<option value = $id>$id - $nome</option>";
                                    }
                                ?>
                            </select>

                            </div>
                        </div>
                            
                            <!-- Formulário para cadastrar servico do pet-->
                            <div class="form-2">

                                    <h2 class="subtitulo">Selecione o serviço que você deseja</h2>

                                <div class="conteudo-form">    
                                    <label 
                                    class="label-form">Serviços: </label>
                                    <select name="especie_id" class="select-form" class="inserts-form">
                                    <?php
                                        echo "<option value=''>Selecione</option>";
                                        while ($row_servicos = $result_servicos->fetch(PDO::FETCH_ASSOC)) {
                                            extract($row_servicos);
                                            echo "<option value = $id>$id - $tipo_servico - $descricao</option>";
                                        }
                                    ?>
                                    </select>
                                </div><br>
                            </div>
                            <input type="submit" name="bt_cadpet" value="Cadastrar">
                        </form>
                    </div>
                </div>
            </main>
        <footer class="rodape">
            <img class="rodape_imagem" src="../css/imgs/Rodape2_img.png" alt="Nome do pet shop">
        </footer>
    </body>
</html>


