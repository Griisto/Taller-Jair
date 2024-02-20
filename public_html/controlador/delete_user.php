<?php
#Se verifica que a la url esten los datos del id del usuario y la ruta de su foto de perfil
if (!empty($_GET['id_usuario']) && !empty($_GET['path'])) {

    #Incluye la conexion
    include_once 'conexion.php';

    #Se extrae el id del usuario y se almacena en una variable
    $id = $_GET['id_usuario'];

    #Se extrae la ruta de la foto de perfil del usuario
    $path = $_GET['path'];
    if ($path != "../foto usuarios/default_avatar.jpg") {
        unlink($path);
    }
    $sql = "DELETE FROM usuarios WHERE id= :id";
    $query = $con->prepare($sql);
    $query->bindParam(':id', $id);
    if ($query->execute()) {
        $message = "Usuario borrado exitosamente";
        header("Location: ../vista/view_users.php?message=$message");
    }else{
        $message = "El usuario seleccionado no se pudo borrar exitosamente";
        header("Location: ../vista/view_users.php?message=$message");
    }
}
$con = null;
