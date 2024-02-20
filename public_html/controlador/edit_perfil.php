<?php

if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['telefono']) && !empty($_FILES['foto_perfil']) && !empty($_POST['path_perfil']) && !empty($_POST['id_usuario'])) {
    include_once 'conexion.php';
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $constraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'];
    $id = $_POST['id_usuario'];

    $path = $_POST['path_perfil'];

    $numero_aleatorio = rand(1, 10000);

    if (empty($_FILES['foto_perfil']) && empty($_FILES['foto_perfil']['tmp_name'])) {
        $img_path = $path;
    } else {
        #IMG
        $img = $_FILES['foto_perfil']['tmp_name'];
        $img_name = $_FILES['foto_perfil']['name'];
        $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $img_path = "../foto usuarios/" . $numero_aleatorio . "" . $nombre . "." . $img_extension;
        if ($img_extension == "jpg" or $img_extension == "jpeg" or $img_extension == "png") {
            unlink($path);
            move_uploaded_file($img, $img_path);
        } else {
            $message = "Please upload a image format jpg, jpeg or png";
            header("Location: ../vista/edit_perfil.php?message=$message");
        }
    }
    $sql = "UPDATE usuarios SET nombre=?,correo=?,contrasena=?,telefono=?,foto_de_perfil=? WHERE id =?";
    $queryupdate = $con->prepare($sql);
    $queryupdate->bindParam(1, $nombre);
    $queryupdate->bindParam(2, $correo);
    $queryupdate->bindParam(3, $contraseña);
    $queryupdate->bindParam(4, $telefono);
    $queryupdate->bindParam(5, $img_path);
    $queryupdate->bindParam(6, $id);
    if ($queryupdate->execute()) {
        $message = "Datos del usuario actualizados exitosamente";
        header("Location: ../vista/perfil_user.php?message=$message");
    }
} else {
    $message = "Por favor llene todo el formulario";
    header("Location: ../vista/edit_perfil.php?message=$message");
}
$con = null;