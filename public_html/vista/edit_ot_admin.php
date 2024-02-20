<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/register_edit_ot.css">
<?php
if (!empty($_GET['id_ot'])) {
    $id_ot = $_GET['id_ot'];
    $sql = "SELECT * FROM ordenes_trabajo_pm WHERE id = :id_ot";
    $query = $con->prepare($sql);
    $query->bindParam(':id_ot', $id_ot);
    $query->execute();
    $OT = $query->fetch(PDO::FETCH_ASSOC);

    $cantidad_repuestos = explode(",", $OT['cantidad_repuestos']);

    $sqlSpares = "SELECT rp.id,rp.nombre FROM repuestos rp 
    JOIN repuestos_ot_pm rtp ON rp.id = rtp.fk_repuesto 
    JOIN ordenes_trabajo_pm otp ON rtp.fk_ot = otp.id 
    WHERE otp.id=:idOt";
    $querySpares = $con->prepare($sqlSpares);
    $querySpares->bindParam(':idOt', $id_ot);
    $querySpares->execute();
    $rowspares = $querySpares->fetchAll(PDO::FETCH_ASSOC);

    $sql_handlabor = "SELECT mo.id,mo.trabajo,mv.marca
    FROM mano_obra mo 
    JOIN ot_mo_pm ON mo.id = ot_mo_pm.fk_mo
    JOIN ordenes_trabajo_pm otp ON ot_mo_pm.fk_ot = otp.id 
    JOIN marcas_vehiculo mv ON mo.vehiculo = mv.id
    WHERE otp.id = :id_ot";
    $query_handlabor = $con->prepare($sql_handlabor);
    $query_handlabor->bindParam(':id_ot', $id_ot);
    $query_handlabor->execute();
    $list_handlabor = $query_handlabor->fetchAll(PDO::FETCH_ASSOC);
}
try {
    $query_mano_obra = "SELECT id,nombre
    FROM repuestos";
    $stmtSpares = $con->prepare($query_mano_obra);
    $stmtSpares->execute();

    $array_Spares = $stmtSpares->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($array_Spares)) {
        $amoSpares = htmlspecialchars(json_encode($array_Spares), ENT_QUOTES, 'UTF-8');
    }
} catch (\Throwable $th) {
    echo "Error: " . $th;
}

try {
    $query_mano_obra = "SELECT * FROM mano_obra mo JOIN marcas_vehiculo mv ON mo.vehiculo = mv.id";
    $stmt = $con->prepare($query_mano_obra);
    $stmt->execute();

    $array_mano_obra = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($array_mano_obra)) {
        $amo = htmlspecialchars(json_encode($array_mano_obra), ENT_QUOTES, 'UTF-8');
    } else {
        echo "No se pudo";
    }
} catch (\Throwable $th) {
    echo "Error: " . $th;
}
?>



<form action="../controlador/edit_ot_admin.php" method="post" id="form" class="form" enctype="multipart/form-data">
    <div class="info-ot">
        <div class="div-input">
            <label for="cliente">Nombre de cliente</label>
            <input type="text" class="input" name="cliente" placeholder="Cliente" value="<?= $OT['cliente'] ?>">
        </div>
        <div class="div-input">
            <label for="plaque">Placa del vehiculo</label>
            <input type="text" class="input" name="plaque" placeholder="Placa del vehiculo" value="<?= $OT['placa_vehiculo'] ?>">
        </div>
        <div class="div-input">
            <label for="date_into">Fecha de entrada</label>
            <input type="date" class="input" name="date_into" placeholder="dia de entrada" value="<?= $OT['fecha_ingreso'] ?>">
        </div>
        <div class="div-input">
            <label for="hour_into">Hora de entrada</label>
            <input type="time" class="input" name="hour_into" placeholder="hora de entrada" value="<?= $OT['hora_ingreso'] ?>">
        </div>
        <div class="div-input">
            <label for="date_exit">Fecha de salida</label>
            <input type="date" class="input" name="date_exit" placeholder="dia de salida" value="<?= $OT['fecha_salida'] ?>">
        </div>
        <div class="div-input">
            <label for="hour_exit">Hora de salida</label>
            <input type="time" class="input" name="hour_exit" placeholder="hora de salida" value="<?= $OT['hora_salida'] ?>">
        </div>
        <div class="div-input">
            <label for="phone">Telefono de usuario</label>
            <input type="numb" class="input" name="phone" placeholder="telefono cliente" value="<?= $OT['telefono'] ?>">
        </div>
        <div class="div-input">
            <label for="img_antes">Imagen del vehiculo</label>
            <input type="file" name="img" class="input-img">
        </div>
    </div>
    <!--Inputs ocultos-->
    <input type="hidden" name="id_usuario" value="<?= $OT['id_usuario'] ?>">
    <input type="hidden" name="path" value="<?= $OT['imagen'] ?>">
    <input type="hidden" name="id_ot" value="<?= $id_ot ?>">

    <div class="contenedor-lista">
        <div class="contenedor-lista-inputs">
            <div class="lista-spares">
                <div class="encabezado">
                    <button type="button" onclick="agregarNuevoInput(<?= $amoSpares ?>)" class="btn-listas agregar">Nuevo Repuesto</button>
                    <button type="button" onclick="borrarNuevoInput()" class="btn-listas eliminar">Eliminar</button>
                </div>
                <div id="contenedorrepuestos" class="contenedor-repuestos">
                    <?php $i = 0 ?>
                    <?php foreach ($rowspares as $spares) : ?>
                        <select name="Newspare[]" class="input-repuesto" id="Nuevorepuesto">
                            <option value="<?= $spares['id'] ?>"><?= $spares['nombre'] ?></option>
                        </select>
                        <input type="number" name="Newquantity[]" class="input-precio" id="NuevaCantidad" value="<?= $cantidad_repuestos[$i] ?>" placeholder="Cantidad"><br id="br-repuesto">
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="lista-handlabor">
                <div class="encabezado">
                    <button type="button" class="btn-listas agregar" onclick="agregarManoDeObra(<?= $amo ?>)">Mano de obra nueva</button>
                    <button type="button" class="btn-listas eliminar" onclick="borrarManoDeObra()">Eliminar</button>
                </div>
                <?php if (!empty($array_mano_obra)) : ?>
                    <?php foreach ($list_handlabor as $handlabor) : ?>
                        <select name="Manodeobra[]" id="Manodeobra" class="select-Manodeobra">
                            <option value="<?= $handlabor['id'] ?>"><?= $handlabor['trabajo'] ?> Marca: <?= $handlabor['marca'] ?></option>
                        </select><br id="br">
                    <?php endforeach ?>
                    <div id="contenedor-manodeobra" class="contenedor-manodeobra">
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn-submit">Enviar orden de trabajo</button>
    </div>
</form>





<?php include 'includes/footer.php' ?>