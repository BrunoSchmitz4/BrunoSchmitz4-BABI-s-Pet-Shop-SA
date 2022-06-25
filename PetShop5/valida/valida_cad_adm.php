<?php

session_start();

include_once '../adm/config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Faz um filtro dos itens de imput e define que é um filtro padrãp
var_dump($dados); // Mostra dados buscados e diz seu tipo

if(!empty($dados['tb_cadastro'])){ // Caso os dados estejam diferentes de vazio dentro do formulário que tiver o botão de submit "tb_cadastro"

    $query_cadastro = "INSERT INTO usuarios(nome, email, senha, telefone, complemento, nivel_acesso_id, cep_id, created) "
            . "VALUES ('".$dados['nome']."', '".$dados['email']."', '".$dados['senha']."', "
            . "'".$dados['telefone']."', '".$dados['complemento']."', '".$dados['nivel_acesso_id']."', "
            . "'".$dados['cep_id']."', NOW())"; 
            // Cria uma query uma query que pega os dados do formulário e os adiciona nos campos do banco de dado. O NOW() é usado para definir a data do campo created como o horário atual da inserção
    
    $result_usuario = $conn->prepare($query_cadastro);
    $result_usuario->execute();
    
    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){ 
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<h2><p style='color:green'>Cadastrado com sucesso!</p></h2>";
        header("Location:..\pags\admin.php");
        // Se o cadastro der certo ele avisa e manda pra página acima
    } else {
        $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível inserir usuário!</p></h2>";
        header("Location:..\adm\admin.php");
        // Se o cadastro der errado ele também avisa e manda pra página acima
    }    
    
} else {
    $_SESSION['msg'] = "<h2><p style='color:red'>Não foi possível cadastrar!</p></h2>";
    header("Location:..\adm\admin.php");
    // Caso o cadastro de diferente de bem sucedido ou mostrar um erro diferente do else acima, ele simplesmente repetirá a condição do else, também  impedindo que os dados sejam inseridos
}
