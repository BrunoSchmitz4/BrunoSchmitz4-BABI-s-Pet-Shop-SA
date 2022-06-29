<?php

session_start();

include_once '../adm/config/conexao.php';

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../lib/vendor/autoload.php';
$mail = new PHPMailer(true);

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); // Faz um filtro dos itens de input e define que é um filtro padrão
//var_dump($dados);

if (!empty($dados['bt_rec_senha'])){
    $query_email = "SELECT id, nome, email FROM usuarios WHERE email=:email LIMIT 1";
    $result_email = $conn->prepare($query_email);
    $result_email->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_email->execute();
    
    if (($result_email) AND ($result_email->rowCount() != 0)){
        $row_email = $result_email->fetch(PDO::FETCH_ASSOC);
        $chave_rec_senha = password_hash($row_email['id'], PASSWORD_DEFAULT);
        //echo "Chave $chave_rec_senha <br>";

        $query_up_email = "UPDATE usuarios SET recuperar_senha =:recuperar_senha WHERE id=:id LIMIT 1";
        $result_up_email = $conn->prepare($query_up_email);
        $result_up_email->bindParam(':recuperar_senha', $chave_rec_senha, PDO::PARAM_STR);
        $result_up_email->bindParam(':id', $row_email['id'], PDO::PARAM_INT);

        if($result_up_email->execute()){ //verifica o update
           $link =  "<a href= 'http://localhost/BrunoSchmitz4-BABI-s-Pet-Shop-SA-main(5.0)\Projeto SA PETSHOP BABI/PetShop5/pags/atualizar_senha.php?chave=$chave_rec_senha'>clique aqui</a>";
           $link_text = "http://localhost/BrunoSchmitz4-BABI-s-Pet-Shop-SA-main(5.0)\Projeto SA PETSHOP BABI/PetShop5/pags/atualizar_senha.php?chave=$chave_rec_senha";
            
            try{
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                $mail->CharSet = 'UTF-8';                     
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.mailtrap.io';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = '4d23df036d22ba'; // Mailtrap -> My Inbox -> SMTP Settings -> FuelPHP                    
                $mail->Password   = 'c6836bc336e4c4';                               
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
                $mail->Port       = 2525;
                
                //Recipients
                $mail->setFrom('atendimento@babispetshop.com', 'Atendimento');
                $mail->addAddress($row_email['email'], $row_email['nome']);     //Add a recipient
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperar Senha';
                $mail->Body    = "<h2>Lembrete de Senha</h2><br>" . 'Olá ' . $row_email['nome'] .", foi solicitada a recuperação de sua senha no site Babi's Petshop.<br><br>Por favor, " . $link . " para criar uma nova senha. <br><br>" .  "<h5>Caso não tenha solicitado sua senha, apenas ignore esse e-mail.</5>";
                $mail->AltBody = 'Prezado(a) ' . $row_email['nome'] . "\n\nVocê solicitou alteração de senha." . "\n\nPara continuar o processo de sua recuperação de senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link_text  . "\n\n\nCaso não tenha solicitado sua senha, apenas ignore essa mensagem.";

                
                $mail->send();
                $_SESSION['msg'] = "<p style='color: white'>Enviado e-mail com instruções para recuperar a senha. Acesse seu e-mail para recuperar a senha!</p>";
                header("Location:../index.php");

            } catch (Exception $e) {
                echo "Erro: E-mail não enviado. Mailer Error: {$mail->ErrorInfo}";
            }
            
        }else{
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Tente Novamente!</p>";
        }
    }else{
        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: E-mail não encontrado!</p>";
    }
}
