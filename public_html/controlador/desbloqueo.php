<?php 
if(!empty($_GET['id_usuario'])){
    include "conexion.php";
    $id = $_GET['id_usuario'];
    $estado = True;
    $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(1,$estado);
    $stmt->bindParam(2,$id);
    if($stmt->execute()){
        $message = "Usuario desbloqueado exitosamente";
        header("Location: ../vista/view_users.php?message=$message");
    }
}
$con = null;


?>