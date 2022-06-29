<?php
session_start(); // Inicia a sessão do usuário, permitindo que ele possa se deslocar elas páginas sem que deslogue

include_once '../adm/config/conexao.php'; // faz a conexão com o banco de dados definido no conexão.php

if (isset($_SESSION['msg'])) { // Mostra mensagem caso: O usuário foi conectado ou não.
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/custom.css">
        <title>Atualizar Senha</title>
    </head>
    <body>

        <?php
        $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
        if(!empty($chave)){
        //var_dump($chave);

            $query_email = "SELECT id FROM usuarios WHERE recuperar_senha=:recuperar_senha LIMIT 1";
            $result_email = $conn->prepare($query_email);
            $result_email->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
            $result_email->execute();

            if (($result_email) AND ($result_email->rowCount() != 0)){
                $row_email = $result_email->fetch(PDO::FETCH_ASSOC);
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                //var_dump($dados);           
                if (!empty($dados['bt_nova_senha'])){
                    $senha = password_hash($dados['senha'], PASSWORD_DEFAULT); // criptografar a senha
                    $recuperar_senha = "NULL";

                    $query_up_email = "UPDATE usuarios SET senha =:senha, recuperar_senha =:recuperar_senha WHERE id=:id LIMIT 1";
                    $result_up_email = $conn->prepare($query_up_email);
                    $result_up_email->bindParam(':senha', $senha, PDO::PARAM_STR);
                    $result_up_email->bindParam(':recuperar_senha', $recuperar_senha);
                    $result_up_email->bindParam(':id', $row_email['id'], PDO::PARAM_INT);

                    if($result_up_email->execute()){ //verifica o update
                        $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                        header("Location:../index.php");
                    }else{
                        echo"<p style='color: #ff0000'>Erro: Tente Novamente!</p>";
                    }
                }

            }else{
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Link inválido! Solicite um novo link para atualizar a senha!</p>";
                header("Location:recuperar_senha.php");
            }
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Link inválido! Solicite um novo link para atualizar a senha!</p>";
             header("Location:recuperar_senha.php");

        }
        ?>

        <div class ="center">
            <h1>Atualizar Senha</h1>
            <form method ="POST" action=""> 
                <?php 
                $email = "";
                if(isset($dado['senha'])){
                    $email =  $dados['senha'];
                }           
                ?>     
                <div class="txt_field">
                    <input type="password" name="senha"  value="<?php echo $email?>" required>
                    <label>Senha</label>
                </div>
                
                <br>
                <input type="submit" name="bt_nova_senha" value="Atualizar"> <!--Envia formulário-->
                <div class="signup_link">
                    Lembrou?<a href="../index.php"> Clique aqui para Logar</a> 
                </div>
            </form>
        </div>
        
    </body>
</html>