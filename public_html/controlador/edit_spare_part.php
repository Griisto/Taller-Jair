<?php
include 'conexion.php';
//Bloque para editar la lista de trabajo
if (!empty($_POST['repuesto-edit']) && !empty($_POST['precio-edit'])) {
    $form = [
        'id' => $_POST['id'],
        'repuesto' => $_POST['repuesto-edit'],
        'precio' => $_POST['precio-edit'],
    ];
    $sqlNewItem = "UPDATE repuestos SET nombre=:nombre,precio=:precio WHERE id = :id ";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(':nombre', $form['repuesto']);
    $query_item->bindParam(':precio', $form['precio']);
    $query_item->bindParam(':id', $form['id']);
    if ($query_item->execute()) {
        $message = "Item actualizado exitosamente";
        header("Location: ../vista/spares_parts.php?message=$message");
    }
}
$con = null;
//Fin bloque
?>