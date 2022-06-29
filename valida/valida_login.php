<?php

session_start();

include_once '../adm/config/conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // faz limpeza geral dados armazena
var_dump($dados); // estrutura suporta vários dados

// 1 valida se chegou dados do bt_login, pega informações junto valida
if(!empty($dados['bt_login'])){
    
    // mostra estrutura, valores recebidos
    $query_usuarios = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, "
            . "cep_id, created, modified FROM usuarios WHERE email =:usuario LIMIT 1";
    $result_usuario = $conn->prepare($query_usuarios); // recebe informações ao executar query
    $result_usuario->bindparam(':usuario',$dados['email']); // acessa banco, informa conforme usuario
    // método se refere array dentro usuarios
    $result_usuario->execute();
    
    // 2 verifica se tem algo e se é mais de 0 linhas      
    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){ 
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        // indica de onde pega conteúdo, busca dentro BD e associa linha por linha id
        var_dump($row_usuario);
        $usuario = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);
       
        // 3 analisa se senha digitada é igual a que veio do banco
        if ($dados['senha'] == $row_usuario['senha']){ 
            $_SESSION['id'] = $row_usuario['id'];
            $_SESSION['nome'] = $row_usuario['nome']; 
            $_SESSION['email'] = $row_usuario['email']; 
            $_SESSION['senha'] = $row_usuario['senha'];
            $_SESSION['nivel_acesso_id'] = $row_usuario['nivel_acesso_id'];
            //header("Location:../adm/dashboard.php"); 

            if ($_SESSION['nivel_acesso_id'] == '1') {
                header("Location:../pags/clientelogged.php");
            } elseif ($_SESSION['nivel_acesso_id'] == '2') {
                header("Location:../pags/colaborador.php");
            } elseif ($_SESSION['nivel_acesso_id'] == '3') {
                header("Location:../pags/admin.php");
            } else {
                $_SESSION['msg'] = "<p style= 'color:red' >Entre em contato com o administrador!</p>";
                header("Location:../index.php");
            }
        // 3 se senha for diferente informa que é inválida
        } else {
            if(password_verify($senha, $row_usuario['senha'])){ //verifica se a senha criptografada do banco corresponde a senha digitada
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                $_SESSION['email'] = $row_usuario['id'];
                $_SESSION['senha'] = $row_usuario['senha'];
                $_SESSION['nivel_acesso_id'] = $row_usuario['nivel_acesso_id'];
                //header("Location:../adm/dashboard.php");
                        
                if ($_SESSION['nivel_acesso_id'] == '1') {
                    header("Location:../pags/clientelogged.php");
                } elseif ($_SESSION['nivel_acesso_id'] == '2') {
                    header("Location:../pags/colaborador.php");
                } elseif ($_SESSION['nivel_acesso_id'] == '3') {
                    header("Location:../pags/admin.php");
                } else {
                    $_SESSION['msg'] = "<p style= 'color:red' >Entre em contato com o administrador!</p>";
                    //header("Location:../index.php");
                }
            
            }else{
                $_SESSION['msg'] = "<p style= 'color:red' >Usuário ou Senha Incorretos!</p>";
                header("Location:../index.php");
            }
        }  
        
    // 2 se não tiver encontrado do result_usuario, usuário inesistente             
    } else {
        $_SESSION['msg'] = "<p style= 'color:red'> Usuário não encontrado!</p>"; 
        // cria sessão variável global recebe linha
        header("Location:../index.php"); // mantém index
    }
// se não veio dados, vazio do bt_login
} else {
    $_SESSION['msg'] = "<p style = 'color:red'> Não recebi valores do formulário!</p>"; 
    header("Location:../adm/dashboard.php");
}

