<?php
require 'conexion.php';
//Bloque para insertar formulario de insertar trabajo
if (!empty($_POST['work']) && !empty($_POST['price']) && !empty($_POST['brand'])) {
    $form = [
        'trabajo' => $_POST['work'],
        'precio' => $_POST['price'],
        'marca' => $_POST['brand']
    ];
    $sqlNewItem = "INSERT INTO mano_obra(trabajo,precio_trabajo,vehiculo) VALUES (?,?,?)";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(1, $form['trabajo']);
    $query_item->bindParam(2, $form['precio']);
    $query_item->bindParam(3, $form['marca']);

    if ($query_item->execute()) {
        $message = "Item guardado exitosamente";
        header("Location: ../vista/list_labor.php?message=$message");
    }
}
//Fin bloque
$con = null;