// versão bia
<?php

session_start();

include_once '../adm/config/conexao.php';

if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}


$edita_cad_pet = filter_input(INPUT_POST, 'editaPet', FILTER_SANITIZE_STRING);
var_dump($edita_cad_pet);


if(!empty($edita_cad_pet)){
    //echo '<br>Deu certo!';
    
    $query_edita_pets = "UPDATE pets SET nome='$nome', especie_id='$especie_id', porte_id='$porte_id',
    created='$created', modified='$modified' WHERE id='$id_pet' LIMIT 1"; // busca id atráves do valor que consta no banco
    
    $result_edita_pet = $conn->prepare($query_edita_pets);
    $result_edita_pet->execute();
    
    if(($result_edita_pet) AND ($result_edita_pet->rowCount() != 0)){ 
        $row_edita_pet = $result_edita_pet->fetch(PDO::FETCH_ASSOC);
        $_SESSION['msg'] = "<p style='color:green'>Pet atualizado com sucesso!</p>";
        header("Location:..\pags\admin.php");
        
    } else {
        $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar pet!</p>";
        header("Location:..\pags\admin.php");
    }    
    
} else {
    $_SESSION['msg'] = "<p style='color:red'>Não foi possível atualizar pet!</p>";
    header("Location:..\pags\admin.php");
}

?>