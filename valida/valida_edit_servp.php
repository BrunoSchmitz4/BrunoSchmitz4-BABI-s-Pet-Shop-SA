// versão bia
<?php

session_start();

include_once '../adm/config/conexao.php';

if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}


$edita_cad_servp = filter_input(INPUT_POST, 'EditaServPrest', FILTER_SANITIZE_STRING);
var_dump($edita_cad_servp);


if(!empty($edita_cad_servp)){
    //echo '<br>Deu certo!';
    
    $query_edita_servps = "UPDATE servicos_prestados SET servico_id='$nome', pet_id='$pet_id', usuario_id='$usuario_id',
    preco_id='$preco_id', created='$created', modified='$modified' WHERE id='$id_servp' LIMIT 1"; // busca id atráves do valor que consta no banco
    
    $result_edita_servp = $conn->prepare($query_edita_servps);
    $result_edita_servp->execute();
    
    if(($result_edita_servp) AND ($result_edita_servp->rowCount() != 0)){ 
        $row_edita_servp = $result_edita_servp->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style='color:green'>Pedido atualizado com sucesso!</p>";
        header("Location:..\pags\admin.php");
        
    } else {
        $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar pedido!</p>";
        header("Location:..\pags\admin.php");
    }    
    
} else {
    $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar pedido!</p>";
    header("Location:..\pags\admin.php");
}

?>