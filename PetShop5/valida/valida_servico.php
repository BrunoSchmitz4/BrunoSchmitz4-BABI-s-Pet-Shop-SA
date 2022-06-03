<?php
// Vai iniciar a sessão
session_start();


// Faz a conexão. se der ruim, o problema é o conexao
include_once '../adm/config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


$dados = filter_input(INPUT_POST,'bt-servico', FILTER_SANITIZE_STRING);

if(!empty($dados)){
    
    // Aqui vai receber os dados do formulários
    $servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $imagem = $_FILES['imagem']['name'];
    
    echo $imagem;
    
    // Aqui vai enviar para o banco de dados as informações
    $query_servicos = "INSERT INTO servicos(tipo_servico, descricao, imagem, created) VALUES 
            ('$servico','$descricao','$imagem',NOW())";
    $result_cad_serv = $conn->prepare($query_servicos);
    $result_cad_serv->execute();
    
    // Aqui vai verificar se todos os dados foram inseridos
    if(($result_cad_serv) AND ($result_cad_serv->rowCount() != 0)){
        $row_cad = $result_cad_serv->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style = 'color:deepskyblue>Cadastro de serviço bem suscedido!</p>";
        //header('Location:\PetShop5\pags\cliente.php');
        
        
        // Este vai recuperar o último insert feito no cadastro do produto
        $last_insert = $conn->lastInsertId();
        
        // Aqui é a pasta onde todas as imagens serão salvas
        $pasta_img = "../css/imgs/".$last_insert.'/';
        
        // Dentro da pasta imagem, será feito esta pasta abaixo
        // Esta pasta terá como nome, o id do serviço cadastrado no banco
        mkdir('../css/imgs/'.$last_insert.'/');
       
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta_img.$imagem)) {
            $_SESSION['msg'] = "<h3 style= 'color:green'>Imagem salva!</h3><br><br>";
            echo "<br><br><p>Imagem salva.</p>";
           // header("Location:\projeto_login\adm\cadastrar_produto.php");
        } else {
            $_SESSION['msg'] = "<h3 style= 'color:red' >Imagem não foi salva!</h3><br><br>";
            echo "<br><br><p>Imagem não salva.</p>";           
//header("Location:\projeto_login\adm\cadastrar_produto.php");
        }
    }

// Se tudo der errado, é nesse else que o programa morre
}else{
    $_SESSION['msg'] = "<h2><p style='color:red'>Não foi adicionar o novo serviço!</p></h2>";
}
