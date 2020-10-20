<?php //Conectando ao banco de dados com PDO
$db_name='prova'; // nome do banco
$db_host='localhost'; // local do banco hospedado
$db_user='root'; //nome do login do banco 
$db_pass=''; //senha do login do banco
    try{
            $db_connect='mysql:dbname='.$db_name.';host='.$db_host;  

            $pdo = new PDO($db_connect, $db_user,$db_pass); //definições iniciais do banco de dados
        }   
        catch(PDOException $erro)   
            {
                echo "Falhou: ".$erro->getMessage();
            }
?>