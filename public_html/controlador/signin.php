<?php
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    require_once 'conexion.php';
    $usuario = ucfirst(strtolower($_POST['username']));
    $contrasena = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE nombre = :user OR correo = :correo ";
    $query = $con->prepare($sql);
    $query->bindParam(':user', $usuario);
    $query->bindParam(':correo', $usuario);
    $query->execute();
    $rows = $query->fetch(PDO::FETCH_ASSOC);
    if ($rows > 0 && password_verify($contrasena, $rows['contrasena'])) {
        session_start();
        $_SESSION['id'] = $rows['id'];
        if($rows['estado'] == 1){
            if ($rows['perfil'] == 'a') {
                header("Location: https://" . $_SERVER['HTTP_HOST'] ."/vista/perfil_admin.php");
            } else {
                header("Location: https://" . $_SERVER['HTTP_HOST'] ."/vista/perfil_user.php");
            }
        }else {
            $message = "El usuario ha sido bloqueado, para mas informacion contacte con el administrador al administrador";
            header("Location: https://" . $_SERVER['HTTP_HOST'] ." ../vista/signin.php?message=$message");
        }
    } else {
        $message = "El usuario o la contraseña no coinciden en caso de problemas solicite al administrador cambiar su usuario o contraseña";
        header("Location: https://" . $_SERVER['HTTP_HOST'] ." ../vista/signin.php?message=$message");
    }
} else {
    $message = "Por favor llene todo el formulario";
    header("Location: https://" . $_SERVER['HTTP_HOST'] ." ../vista/signin.php?message=$message");
}
$con = null;