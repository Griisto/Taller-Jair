<?php
include_once 'conexion.php'; #Se incluye la conexion de la bd

#Se hace el condicional donde llegue todos los datos del formulario
if (!empty($_GET['id_ot']) && !empty($_GET['rute1'])) {
    #Se extraen los datos de la url del boton y se almacenan en diferentes variables
    $id_ot = $_GET['id_ot']; #Id de la orden de trabajo
    $rute1 = $_GET['rute1']; #Ruta de la imagen del vehiculo antes de arreglarse

    if ($rute1 != "../img/default_image_before.jpg") {
        unlink($rute1);
    }
    $sql = "DELETE FROM ordenes_trabajo WHERE id = :id_ot";
    $query = $con->prepare($sql);
    $query->bindParam(':id_ot', $id_ot);
    if ($query->execute()) {
        $message = "La orden de trabajo se borro exitosamente";
        header("Location: ../vista/perfil_user.php?message=$message");
    }else{
        $message = "La orden de trabajo no se borro exitosamente";
        header("Location: ../vista/perfil_user.php?message=$message");
    }
}
$con = null;
