<?php
require 'conexion.php';
//Bloque para insertar formulario de insertar marca
if (!empty($_POST['marca'])) {
    $marca = ucfirst($_POST['marca']);
    $sqlNewItem = "INSERT INTO marcas_vehiculo(marca) VALUES (?)";
    $query_item = $con->prepare($sqlNewItem);
    $query_item->bindParam(1, $marca);
    if ($query_item->execute()) {
        $message = "Marca registrada exitosamente";
        header("Location: ../vista/brands.php?message=$message");
    }
}else{
    echo "vacio";
}
//Fin bloque
$con = null;




?>