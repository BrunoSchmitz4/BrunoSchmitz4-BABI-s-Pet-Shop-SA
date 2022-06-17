<?php

$host = "localhost"; // simula servidor / site web endereço ip
$user = "root"; // responsável cria conexão, tabelas
$pass = ""; // senha vazia
$dbname = "pet_shop3"; // base
$port = 3306;

# Confirma se as conexões em geral estão funcionando
#echo "<h1 style= 'color:green' >Conectado! </h1><br>";

try{ // tratamento excessões, coleta erro
    // pdo conjunto biblioteca, forma conector vários bancos diferentes, propriedades
    $conn = new PDO("mysql:host=$host; porta=$port; dbname=".$dbname,$user,$pass); // concatena banco senha
    // conexão instância biblioteca
    //echo "<p style= 'color:green' >Conectado! </p><br>";
} catch (Exception $erro) { // validação variável procura onde erro está armazena
    echo "<p style= 'color:red' >Não foi possível conectar. Erro gerado </p><br>".$erro->getMessage();
    // estiliza mensagem
}