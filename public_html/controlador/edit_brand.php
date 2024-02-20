<?php
include 'conexion.php';
//Bloque para editar la lista de trabajo
if (!empty($_POST['marca'])) {
    $marca = ucfirst($_POST['marca']);
    $id = $_POST['id'];
    $sqlNewItem = "UPDATE marcas_vehiculo SET marca=? WHERE id = ? ";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(1, $marca);
    $query_item->bindParam(2, $id);
    if ($query_item->execute()) {
        $message = "Item actualizado exitosamente";
        header("Location: ../vista/brands.php?message=$message");
    }
}
$con = null;
//Fin bloque
?>