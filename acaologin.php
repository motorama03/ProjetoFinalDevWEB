<?
session_start();
$user = isset($_POST['user'])?$_POST['user']:"";
$password = isset($_POST['password'])?$_POST['password']:"";

if($user != "" && $password != ""){
    include "conexao.php";
    $query = "SELECT * FROM usuario
               WHERE email = :email AND senha = :senha";
}
    $stmt = $conexao->prepare($query);

    $stmt ->bindValue(':email', $user);
    $stmt->bindValue(':senha', $password);

    if($stmt->execute()){
        $usuario = $stmt->fetch();
        if($usuario){
            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            header('location: index.php');
        }
    }
    header('location: login.php');

?>
    