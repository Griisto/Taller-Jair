<?php
include 'conexion.php';
if (isset($_GET['id_ot'])) {
    $id = $_GET['id_ot'];
    $sql = "SELECT * FROM ordenes_trabajo WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $datos = [
                'cliente' => $result['cliente'],
                'placa_vehiculo' => $result['placa_vehiculo'],
                'fecha_ingreso' => $result['fecha_ingreso'],
                'hora_ingreso' => $result['hora_ingreso'],
                'fecha_salida' => $result['fecha_salida'],
                'hora_salida' => $result['hora_salida'],
                'telefono' => $result['telefono'],
                'cantidad_repuestos' => $result['cantidad_repuestos'],
                'imagen' => $result['imagen'],
                'id_usuario' => $result['id_usuario']
            ];
            $sql2 = "INSERT INTO ordenes_trabajo_pm (cliente, placa_vehiculo, fecha_ingreso, hora_ingreso, fecha_salida, hora_salida, telefono,cantidad_repuestos, imagen, id_usuario) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt2 = $con->prepare($sql2);
            $stmt2->bindParam(1, $datos['cliente']);
            $stmt2->bindParam(2, $datos['placa_vehiculo']);
            $stmt2->bindParam(3, $datos['fecha_ingreso']);
            $stmt2->bindParam(4, $datos['hora_ingreso']);
            $stmt2->bindParam(5, $datos['fecha_salida']);
            $stmt2->bindParam(6, $datos['hora_salida']);
            $stmt2->bindParam(7, $datos['telefono']);
            $stmt2->bindParam(8, $datos['cantidad_repuestos']);
            $stmt2->bindParam(9, $datos['imagen']);
            $stmt2->bindParam(10, $datos['id_usuario']);
            if ($stmt2->execute()) {
                $fk_ot = $con->lastInsertId();
                $sql3 = "SELECT fk_ot,fk_mo FROM ot_mo WHERE fk_ot = :id ";
                $stmt3 = $con->prepare($sql3);
                $stmt3->bindParam(':id', $id);
                $stmt3->execute();
                $ot_mo = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ot_mo as $ot) {
                    $sql4 = "INSERT INTO ot_mo_pm (fk_ot,fk_mo)VALUES(:fk_ot,:fk_mo)";
                    $stmt4 = $con->prepare($sql4);
                    $stmt4->bindParam(':fk_ot', $fk_ot);
                    $stmt4->bindParam(':fk_mo', $ot['fk_mo']);
                    $stmt4->execute();
                }
                $sql5 = "SELECT fk_ot,fk_repuesto FROM repuestos_ot WHERE fk_ot = :id";
                $stmt5 = $con->prepare($sql5);
                $stmt5->bindParam(':id', $id);
                $stmt5->execute();
                $repuestos_ot = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                foreach ($repuestos_ot as $rp_ot) {
                    $sql6 = "INSERT INTO repuestos_ot_pm (fk_ot,fk_repuesto)VALUES(:fk_ot,:fk_repuestos)";
                    $stmt6 = $con->prepare($sql6);
                    $stmt6->bindParam(':fk_ot', $fk_ot);
                    $stmt6->bindParam(':fk_repuestos', $rp_ot['fk_repuesto']);
                    $stmt6->execute();
                }
                $sql7 = "DELETE FROM ordenes_trabajo WHERE id = :id";
                $stmt7 = $con->prepare($sql7);
                $stmt7->bindParam(':id', $id);
                if ($stmt7->execute()) {
                    $message = "Orden de trabajo aceptada exitosamente";
                    header("Location:../vista/perfil_admin.php?message=$message");
                }
            } else {
                $message = "Error al insertar en la tabla ordenes_trabajo_permanente";
                header("Location:../vista/perfil_admin.php?message=$message");
            }
        } else {
            $message = "No se encontraron datos para el ID proporcionado";
            header("Location:../vista/perfil_admin.php?message=$message");
        }
    } else {
        $message = "Error en la consulta de selección";
        header("Location:../vista/perfil_admin.php?message=$message");
    }
} else {
    $message = "Error al pasar el identificador de la orden de trabajo";
    header("Location:../vista/perfil_admin.php?message=$message");
}
$con = null;
