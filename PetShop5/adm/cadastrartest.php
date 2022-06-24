<?php

session_start();

// echo "Crie seu formulário Cadastrar<br>";

include_once './config/conexao.php';
    
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$query_ceps = "SELECT id, cep, logradouro FROM ceps ORDER BY cep ASC";
$result_cep = $conn->prepare($query_ceps);
$result_cep->execute();
?>

<html>
    <head> 
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../css/style.css'/>
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
            <select name="cep_id" id="cep_id"> 
                <?php
                echo "<option value=''>Selecione</option>";
                while ($row_cep = $result_cep->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_cep);
                    echo "<option value = $id>$cep - $logradouro</option>";
                }
                ?>
            </select>
<!--             <input type="number" name="cep_id" placeholder="Informe seu CEP"> -->
            <br><br>
            
            
            </select>
<!--             <input type="text" name="nivel_acesso_id" placeholder="Informe o nível de acesso"> -->
            <br><br><br>

            <input type="submit" name="bt_login" value="Cadastrar">

            <input type="reset" name="bt_reset" class="signup_link_apagar" value="Apagar">

<!--            <div class="signup_link">
            <a href='../index.php'>Voltar ao login</a>
            </div>-->

            </form>
            
            <div>
                <a href="../index.php" ><button class="signup_link_voltar">Voltar ao login</button></a>
            </div>
            
            <!--            <form method="GET" action="../index.php">
                <button type="submit" style="width: 100%; height: 50px; border: 1px solid; background: #2691d9; border-radius: 25px; font-size: 18px; color: #e9f4fb; font-weight: 700; cursor: pointer; outline: none;">Voltar ao login</button>
            </form>-->
        </div>
    </body>
</html>