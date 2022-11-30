<?
    include"conf.inc.php";

    try{
        $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
            print("<br>Erro ao conectar</br>".$e->getMessage());
    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }catch(Exception $e){
        print("Erro genêrico...<br>".$e->getMessage()());
        die();
    }

?>