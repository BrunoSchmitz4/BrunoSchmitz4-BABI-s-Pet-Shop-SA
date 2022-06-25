<?php

include_once '../adm/config/conexao.php';
// fim da conexão com banco de dados usando PDO

echo "<h1>Usuários Cadastrados</h1>";

// exemplo query indicando quais colunas devem retornar valor
$query_users_b = "SELECT id, nome, email, senha, telefone, complemento, nivel_acesso_id, "
        . "cep_id, created, modified FROM usuarios"; 

// realiza busca otimizada
// limit cláusula de limite usada especificar nº de registros a serem retornados
// offset usado para selecionar registros específicos
// ex.: select * from nome_tabela limit 2 offset 10 (traz 2 registros, começando da posição 10)


$result_users_b = $conn->prepare($query_users_b); 
$result_users_b->execute();
echo "<br>";

while($row_user_b = $result_users_b->fetch(PDO::FETCH_ASSOC)){ // outro método extração
    extract($row_user_b); // traz linha row relaciona, conteúdo array campo
    
    echo "Id: $id <br>"; // campo como variável
    echo "Nome: $nome <br>";
    echo "E-mail: $email <br>";
    echo "Senha: $senha <br>";
    echo "Telefone: $telefone <br>";
    echo "Complemento: $complemento <br>";
    echo "Nível de acesso: $nivel_acesso_id <br>";
    echo "Cep: $cep_id <br>";
    echo "Cadastrado: ".date('d/m/y H:i:s', strtotime($created))."<br>"; 
    echo "Modificado: ";
    if(!empty($modified)){ 
        echo date('d/m/y H:i:s', strtotime($modified))."<br><br>";  
    }
    echo "<br><br><hr>"; 
}