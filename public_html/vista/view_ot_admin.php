<?php include 'includes/nav.php' ?>
<link rel="stylesheet" href="../assets/css/view_ot.css">
<?php
if (!empty($_GET['id_ot'])) {
    $id_ot = $_GET['id_ot'];
    $sql = "SELECT *,
        (SELECT foto_de_perfil FROM usuarios WHERE ot.id_usuario = id) AS foto_usuario 
        FROM ordenes_trabajo ot WHERE id = :id_ot";
    $query = $con->prepare($sql);
    $query->bindParam(':id_ot', $id_ot);
    $query->execute();
    $info_ot = $query->fetch(PDO::FETCH_ASSOC);

    $sqlSparesParts = "SELECT rp.id,rp.nombre,rp.precio FROM repuestos rp 
    JOIN repuestos_ot rt ON rp.id = rt.fk_repuesto WHERE rt.fk_ot = :idOt";
    $querySpares = $con->prepare($sqlSparesParts);
    $querySpares->bindParam(':idOt', $id_ot);
    $querySpares->execute();
    $itemSpares = $querySpares->fetchAll(PDO::FETCH_ASSOC);

    $sqlHandLabor = "SELECT mo.trabajo,mo.precio_trabajo FROM mano_obra mo
    JOIN ot_mo ON mo.id = ot_mo.fk_mo WHERE ot_mo.fk_ot = :idOt";
    $queryHandLabor = $con->prepare($sqlHandLabor);
    $queryHandLabor->bindParam(':idOt', $id_ot);
    $queryHandLabor->execute();
    $ItemsHandLabor = $queryHandLabor->fetchAll(PDO::FETCH_ASSOC);
}
?>
<?php
$lista_cantidad = explode(',', $info_ot['cantidad_repuestos']);
?>
<section class="ot">
    <div class="container-father">
        <div class="info">
            <div class="container-info photo">
                <h1>Trabajador: </h1>
                <img src="<?= $info_ot['foto_usuario'] ?>" alt="">
            </div>
            <div class="container-info info-vehicle">
                <h1>Informacion del vehiculo y el cliente:</h1>
                <p><?= $info_ot['cliente'] ?></p>
                <p><?= $info_ot['placa_vehiculo'] ?></p>
            </div>
            <div class="container-info info-customer">
                <h1>Infomacion de operador</h1>
                <p><?= $info_ot['telefono'] ?></p>
            </div>
            <div class="container-info info-date-into">
                <h1>Fecha y hora de salida: </h1>
                <p><?= $info_ot['fecha_ingreso'] ?></p>
                <p><?= $info_ot['hora_ingreso'] ?></p>
            </div>
            <div class="container-info info-date-exit">
                <h1>Fecha y hora de salida:</h1>
                <p><?= $info_ot['fecha_salida'] ?></p>
                <p><?= $info_ot['hora_salida'] ?></p>
            </div>
            <div class="container-info info-mecanica">
                <h1>Repuestos:</h1>
                <div class="container-lists">
                    <div class="lista-repuestos">
                        <?php foreach ($itemSpares as $items) : ?>
                            <p><?= $items['nombre'] ?></p>
                        <?php endforeach ?>
                        <p>Total</p>
                    </div>
                    <div class="lista-cantidad-repuestos">
                        <?php for ($i = 0; $i < count($lista_cantidad); $i++) : ?>
                            <p>x<?= $lista_cantidad[$i] ?></p>
                        <?php endfor ?>
                    </div>
                    <div class="lista-precios-repuestos">
                        <?php $i = 0 ?>
                        <?php foreach ($itemSpares as $precios) : ?>
                            <?php $precio_final = $lista_cantidad[$i] * $precios['precio'] ?>
                            <p>$<?= number_format($precio_final, 2, ",", ".") ?></p>
                            <?php @$precio_total += $precio_final ?>
                            <?php $i++ ?>
                        <?php endforeach ?>
                        <hr>
                        <p>$<?= number_format($precio_total, 2, ",", ".") ?></p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="container-img">
            <div class="lista-mano-obra">
                <h1>Mano de obra:</h1>
                <div class="container-info-mano-obra">
                    <div class="trabajo">
                        <?php foreach ($ItemsHandLabor as $items) : ?>
                            <p><?= $items['trabajo'] ?></p>
                        <?php endforeach; ?>
                        <p>Total</p>
                    </div>
                    <div class="precio">
                        <?php foreach ($ItemsHandLabor as $items) : ?>
                            <p>$<?= number_format($items['precio_trabajo'], 2, ",", ".") ?></p>
                            <?php @$precio_trabajo += $items['precio_trabajo'] ?>
                        <?php endforeach; ?>
                        <hr>
                        <p>$<?= number_format($precio_trabajo, 2, ",", ".") ?></p>
                    </div>
                </div>
            </div>
            <div class="img">
                <h1>Imagen del vehiculo</h1>
                <img src="<?= $info_ot['imagen'] ?>" alt="img_antes">
            </div>

        </div>
    </div>
</section>
<?php include 'includes/footer.php' ?>