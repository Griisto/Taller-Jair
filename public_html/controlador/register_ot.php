<?php

function Bucle($array)
{
    $array_final = array();
    for ($i = 0; $i < count($array); $i++) {
        $array_final[] = $array[$i];
    }
    return $array_final;
}




if (!empty($_POST)) {
    if (!empty($_POST['cliente']) && !empty($_POST['plaque']) && !empty($_POST['date_into']) && !empty($_POST['hour_into']) && !empty($_POST['date_exit']) && !empty($_POST['hour_exit']) && !empty($_POST['phone']) && !empty($_POST['id_usuario'])) {
        include_once 'conexion.php';
        $datesForm = [
            'cliente' => $_POST['cliente'],
            'plaque' => strtoupper($_POST['plaque']),
            'date_into' => $_POST['date_into'],
            'hour_into' => $_POST['hour_into'],
            'date_exit' => $_POST['date_exit'],
            'hour_exit' => $_POST['hour_exit'],
            'phone' => $_POST['phone'],
            'user' => $_POST['id_usuario'],

        ];
        $Labor = $_POST['Manodeobra'];
        $Newspare = $_POST['Newspare'];
        $Newquantity = $_POST['Newquantity'];



        if ($_FILES['img']['size'] > 0) {
            $img = $_FILES['img']['tmp_name'];
            $img_nombre = $_FILES['img']['name'];
            $img_extension = strtolower(pathinfo($img_nombre, PATHINFO_EXTENSION));
            $path_img = "../img/{$datesForm['user']}" . "_" . $datesForm['plaque'] . "." . $img_extension;

            if (in_array($img_extension_antes, ['jpg', 'jpeg', 'png'])) {
                move_uploaded_file($img, $path_img);

            }
        } else {
            $path_img = "../img/default_image_before.jpg";
        }

        if (!empty($Newquantity)) {
            $list_quantity = Bucle($Newquantity);
            $quantity = implode(",", $list_quantity);
        } else {
            $quantity = "";
        }
        $Spares = Bucle($Newspare);
        $handlabor = Bucle($Labor);

        $sql = "INSERT INTO ordenes_trabajo(cliente,placa_vehiculo,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,telefono,cantidad_repuestos,imagen,id_usuario) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $query = $con->prepare($sql);

        $query->bindParam(1, $datesForm['cliente']);
        $query->bindParam(2, $datesForm['plaque']);
        $query->bindParam(3, $datesForm['date_into']);
        $query->bindParam(4, $datesForm['hour_into']);
        $query->bindParam(5, $datesForm['date_exit']);
        $query->bindParam(6, $datesForm['hour_exit']);
        $query->bindParam(7, $datesForm['phone']);
        $query->bindParam(8, $quantity);
        $query->bindParam(9, $path_img);
        $query->bindParam(10, $datesForm['user']);
        if ($query->execute()){
            $idOt = $con->lastInsertId();
            for ($i = 0; $i < count($handlabor); $i++) {
                $idManoObra = $handlabor[$i];
                $querylistlabor = "INSERT INTO ot_mo(fk_ot,fk_mo)VALUES(:idOt,:idManoObra)";
                $queryrelational = $con->prepare($querylistlabor);
                $queryrelational->bindParam(':idOt', $idOt);
                $queryrelational->bindParam(':idManoObra', $idManoObra);
                $queryrelational->execute();
            }
            for($i=0;$i<count($Spares);$i++){
                $idSpare = $Spares[$i];
                $querylistSpares = "INSERT INTO repuestos_ot(fk_ot,fk_repuesto)VALUES(:idOtSpare,:idSpare)";
                $queryrelationalSpares = $con->prepare($querylistSpares);
                $queryrelationalSpares->bindParam(':idOtSpare', $idOt);
                $queryrelationalSpares->bindParam(':idSpare', $idSpare);
                $queryrelationalSpares->execute();
            }

            $message = "Orden de trabajo guardado exitosamente";
            header("Location: ../vista/perfil_user.php?message=$message");
        } else {
            $message = "Error interno al guardar la orden de trabajo";
            header("Location: ../vista/perfil_user.php?message=$message");
        }
    } else {
        $message = "Todos los datos no fueron recibidos, mire bien los nombres mamahuevo";
        header("Location: ../vista/perfil_user.php?message=$message");
    }
} else {
    $message = "Por favor llene todo el formulario";
    header("Location: ../vista/perfil_user.php?message=$message");
}
$con = null;
