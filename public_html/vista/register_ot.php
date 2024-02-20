<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/register_edit_ot.css">
<?php
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
    $query_mano_obra = "SELECT mo.id, mo.trabajo, mv.marca
    FROM mano_obra mo
    JOIN marcas_vehiculo mv ON mo.vehiculo = mv.id";
    $stmt = $con->prepare($query_mano_obra);
    $stmt->execute();

    $array_mano_obra = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($array_mano_obra)) {
        $amo = htmlspecialchars(json_encode($array_mano_obra), ENT_QUOTES, 'UTF-8');
    }
} catch (\Throwable $th) {
    echo "Error: " . $th;
}
?>
<form action="../controlador/register_ot.php" method="post" id="form" class="form" enctype="multipart/form-data">
    <div class="info-ot">
        <div class="div-input">
            <label for="cliente">Nombre del cliente</label>
            <input type="text" class="input" name="cliente" placeholder="Cliente">
        </div>
        <div class="div-input">
            <label for="placa">Placa del vehiculo</label>
            <input type="text" class="input" name="plaque" placeholder="Placa del vehiculo">
        </div>
        <div class="div-input">
            <label for="date_into">Fecha de entrada</label>
            <input type="date" class="input" name="date_into" placeholder="dia de entrada">
        </div>
        <div class="div-input">
            <label for="hour_into">Hora de entrada</label>
            <input type="time" class="input" name="hour_into" placeholder="hora de entrada">
        </div>
        <div class="div-input">
            <label for="date_exit">Fecha de salida</label>
            <input type="date" class="input" name="date_exit" placeholder="dia de salida">
        </div>
        <div class="div-input">
            <label for="hour_exit">Hora de salida</label>
            <input type="time" class="input" name="hour_exit" placeholder="hora de salida">
        </div>
        <div class="div-input">
            <label for="phone">Telefono de operador</label>
            <input type="numb" class="input" name="phone" placeholder="telefono">
        </div>
        <div class="div-input">
            <div class="files">
                <label for="img_antes">Imagen del vehiculo</label>
                <input type="file" name="img" class="input-img">
            </div>
        </div>
        <input type="hidden" name="id_usuario" value="<?= $id ?>">
    </div>
    <div class="contenedor-lista">
        <div class="contenedor-lista-inputs">
            <div class="lista-spares">
                <div class="encabezado">
                    <button type="button" onclick="agregarNuevoInput(<?= $amoSpares ?>)" class="btn-listas agregar">Nuevo Repuesto</button>
                    <button type="button" onclick="borrarNuevoInput()" class="btn-listas eliminar">Eliminar</button>
                </div>
                <div id="contenedorrepuestos" class="contenedor-repuestos"></div>
            </div>
            <div class="lista-handlabor">
                <div class="encabezado">
                    <button type="button" class="btn-listas agregar" onclick="agregarManoDeObra(<?= $amo ?>)">Mano de obra nueva</button>
                    <button type="button" class="btn-listas eliminar" onclick="borrarManoDeObra()">Eliminar</button>
                </div>
                <div id="contenedor-manodeobra" class="contenedor-manodeobra"></div>
            </div>
        </div>
        <button type="submit" class="btn-submit">Enviar orden de trabajo</button>
    </div>
</form>


<?php include 'includes/footer.php' ?>