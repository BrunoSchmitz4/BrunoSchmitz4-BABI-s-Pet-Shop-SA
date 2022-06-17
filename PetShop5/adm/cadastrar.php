<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once './config/conexao.php'; // Explicado no index.php
    
if (isset($_SESSION['msg'])) { // explicado no index.php
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC"; 
// Cria uma variável que usa comandos MYSQL para, NESTE caso selecionar dados

$result_cep = $conn->prepare($query_ceps); // Faz a conexão da variável result coom a query_cep usando o conn, que a prepara
$result_cep->execute(); // Executa o comando com a conexão preparada

$query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC"; 
$result_nivel_acesso = $conn->prepare($query_niveis_acessos); 
$result_nivel_acesso->execute();
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/style.css'/><!--Conecta com o CSS. Diz que serão comandos usados (normalmente) com o stylesheet, enquanto que o href faz a busca do arquivo CSS nas pastas.-->
        <title>Cadastro</title>
    </head>
    <body>
        <div class ="center">
            <h1>Cadastro de usuário</h1> 
        
            <form method="POST" action="../valida/valida_cadastro.php">
                
            <div class="txt_field">
                
                <input type="text" name="nome" required>
                <label>Nome:</label>
            </div>
                
            <div class="txt_field">
                      
                <input type="email" name="email" required>
                <label>E-mail:</label>
                <!--<br><br> -->
            </div>
                
            <div class="txt_field">      
                
                <input type="password" name="senha" required>
                <label>Senha:</label>                           
            </div>
                
            <div class="txt_field">   
                
                <input type="tel" name="telefone" required>
                <label>Telefone:</label>                    
            </div>
                
            <div class="txt_field">
                
                <input type="text" name="complemento" required>
                <label>Complemento:</label>
            </div>
                
            <label>CEP:</label>
            <select name="cep_id" id="cep_id" disabled> 
                <?php // Inicia uma tag de comando php
                echo "<option value=''>'$id.1'</option>"; // Echo neste contexto é usado para poder escrever tags HTML em linhas PHP
                while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) { // Diz que enquanto que os dados de CEP estiverem na coluna e linha do CEP, elas serão selecionadas
                    extract($row_cep);// Extrai o que foi adicionado de ado na row_cep
                    echo "<option value = $id>$cep - $logradouro</option>"; // Concatenação de TAG HMTL e variáveis php ($)
                }
                ?>
            </select>
            <br><br>
            
            
            <select name="nivel_acesso_id" id="nivel_acesso_id">                                  
                                        <?php                
                                        echo "<option value=''>Selecione</option>"; 
                                        while($row_nivel_acesso = $result_nivel_acesso->fetch(PDO::FETCH_ASSOC)){ 
                                            extract($row_nivel_acesso); 
                                            echo "<option value = $id>$nome</option>"; 
                                        }
                        //                     <option value="1">Cliente</option>
                        //                     <option value="2">Colaborador</option>
                        //                     <option value="3">Administrador</option>;
                                    ?>
                                    
                                    </select>
                                    <label>Nível de acesso:</label>

            <br><br><br>

            <input type="submit" name="bt_cadastro" value="Cadastrar">

            <input type="reset" name="bt_reset" class="signup_link_apagar" value="Apagar">

            </form>
            
            <div>
                <a href="../index.php" ><button class="signup_link_voltar">Voltar ao login</button></a>
            </div>

        </div>
    </body>
</html>