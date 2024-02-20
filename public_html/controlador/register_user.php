<?php
if ($_POST != null) {
    if (!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['telefono']) && !empty($_POST['perfil'])) {
        include_once 'conexion.php';
        $nombre = ucfirst(strtolower($_POST['nombre']));
        $correo = $_POST['correo'];
        $constraseña = $_POST['contrasena'];
        $estado = True;
        $telefono = $_POST['telefono'];
        $perfil = $_POST['perfil'];

        $numero_aleatorio = rand(1, 10000);

        $img_path = "../foto usuarios/default_avatar.jpg";

        if (!empty($_FILES['foto_perfil']) && !empty($_FILES['foto_perfil']['tmp_name'])) {
            #IMG
            $img = $_FILES['foto_perfil']['tmp_name'];
            $img_name = $_FILES['foto_perfil']['name'];
            $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
            $img_path = "../foto usuarios/" . $numero_aleatorio . "" . $nombre . "." . $img_extension;
            if (in_array($img_extension, ["jpg", "jpeg", "png"])) {
                move_uploaded_file($img, $img_path);
            } else {
                $message = "Please up a file with extension jpg,jpeg or png";
                header("Location: ../vista/signup.php?message=$message");
            }
        }
        $sql = "INSERT INTO usuarios(nombre,correo,contrasena,estado,telefono,perfil,foto_de_perfil) VALUES (?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $password = password_hash($constraseña, PASSWORD_BCRYPT);
        $stmt->bindParam(3, $password);
        $stmt->bindParam(4, $estado);
        $stmt->bindParam(5, $telefono);
        $stmt->bindParam(6, $perfil);
        $stmt->bindParam(7, $img_path);
        if ($stmt->execute()) {
            $message = "Usuario registrado exitosamente";
            header("Location: ../vista/view_users.php?message=$message");
        }
    } else {
        $message = "Por favor llene todo el formulario";
        header("Location: ../vista/view_users.php?message=$message");
    }
}
$con = null;
