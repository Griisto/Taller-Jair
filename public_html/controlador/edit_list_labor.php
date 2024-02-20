<?php
include 'conexion.php';
//Bloque para editar la lista de trabajo
if (!empty($_POST['work-edit']) && !empty($_POST['price-edit']) && !empty($_POST['brand-edit'])) {
    $form = [
        'id' => $_POST['id'],
        'trabajo' => $_POST['work-edit'],
        'precio' => $_POST['price-edit'],
        'marca' => $_POST['brand-edit']
    ];
    $sqlNewItem = "UPDATE mano_obra SET trabajo=?,precio_trabajo=?,vehiculo=? WHERE id = ? ";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(1, $form['trabajo']);
    $query_item->bindParam(2, $form['precio']);
    $query_item->bindParam(3, $form['marca']);
    $query_item->bindParam(4, $form['id']);
    if ($query_item->execute()) {
        $message = "Item actualizado exitosamente";
        header("Location: ../vista/list_labor.php?message=$message");
    }
}
$con = null;
//Fin bloque
?>