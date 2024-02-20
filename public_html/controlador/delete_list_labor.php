<?php
include 'conexion.php';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM mano_obra WHERE id = :id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        $message = "Item borrado exitosamente";
        header("Location: ../vista/list_labor.php?message=$message");
    }else{
        $message = "El item no se pudo borrar exitosamente";
        header("Location: ../vista/list_labor.php?message=$message");
    }
}
$con = null;
