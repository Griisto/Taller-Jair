<?php
require 'conexion.php';
//Bloque para insertar formulario de insertar repuesto
if (!empty($_POST['repuesto']) && !empty($_POST['precio'])) {
    $form = [
        'repuesto' => $_POST['repuesto'],
        'precio' => $_POST['precio'],
    ];
    $sqlNewItem = "INSERT INTO repuestos(nombre,precio) VALUES (?,?)";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(1, $form['repuesto']);
    $query_item->bindParam(2, $form['precio']);

    if ($query_item->execute()) {
        $message = "Item guardado exitosamente";
        header("Location: ../vista/spares_parts.php?message=$message");
    }
}
//Fin bloque
$con = null;










?>