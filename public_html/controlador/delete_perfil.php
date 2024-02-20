<?php
#Se verifica que a la url esten los datos del id del usuario y la ruta de su foto de perfil
if (!empty($_GET['id_usuario']) && !empty($_GET['path'])) {

    #Incluye la conexion
    include_once 'conexion.php';

    #Se extrae el id del usuario y se almacena en una variable
    $id = $_GET['id_usuario'];

    #Se extrae la ruta de la foto de perfil del usuario
    $path = $_GET['path'];

    if ($path == "../foto usuarios/default_avatar.jpg") {
    } else {
        unlink($path);
    }
    $sql = "DELETE FROM usuarios WHERE id= :id";
    $delete = $con->prepare($sql);
    $delete->bindParam(':id', $id);
    if ($delete->execute()) {
        header('Location: signout.php');
    }
}
$con = null;
