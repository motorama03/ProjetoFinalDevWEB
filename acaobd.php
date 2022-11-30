<?php
// adicionar arquivos da foto!!!
    include "conf.inc.php";
    
    $acao =  isset($_GET['acao'])?$_GET['acao']:"";

    if ($acao == 'excluir'){ // exclui um registro do banco de dados
        try{
            $id =  isset($_GET['id'])?$_GET['id']:0;  // se for exclusão o ID vem via GET
            
            // cria a conexão com o banco de dados 
            $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
            $query = 'DELETE FROM agenda WHERE id = :id';
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id',$id);
            // executar a consulta
            if ($stmt->execute())
                header('location: CadastrosPg.php');
            else
                echo 'Erro ao excluir dados';
        }catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
            print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
            die();
        }
    }
    
    else{
        if(isset($_POST['nome'])&&(isset($_POST['email']))){
            $id = isset($_POST['id'])?$_POST['id']:0;
            $nome = isset($_POST['nome'])?$_POST['nome']:"";
            $sobrenome = isset($_POST['sobrenome'])?$_POST['sobrenome']:"";
            $email = isset($_POST['email'])?$_POST['email']:"";
            $senha = isset($_POST['senha'])?$_POST['senha']:"";
            $cidade = isset($_POST['cidade'])?$_POST['cidade']:"";
            $pastempo = isset($_POST['pastempo'])?$_POST['pastempo']:"";

            try{
                $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);//cria conexão com banco de dados

                // Monta a consulta
                if($id > 0)
                    $query = "UPDATE agenda SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha, cidade = :cidade, pastempo = :pastempo 
                    WHERE id = :id";
                
                else
                $query = 'INSERT INTO agenda(nome, sobrenome, email, senha, cidade, pastempo) VALUES (:nome, :sobrenome, :email, :senha, :cidade, :pastempo)';

                $stmt = $conexao->prepare($query);
                if($id != 0)
                $stmt->bindValue(':id', $id);

                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':sobrenome', $sobrenome);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':senha', $senha);
                $stmt->bindValue(':cidade', $cidade);
                $stmt->bindValue(':pastempo', $pastempo);

                $stmt->execute();
                header('location: CadastrosPg.php');

                

            }catch(PDOException $e){
                print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
                die();
            }
        }
    }

?>