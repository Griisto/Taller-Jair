<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/perfil_user.css">
<?php
$sql2 = "SELECT * FROM ordenes_trabajo WHERE id_usuario = :id";
$OT = $con->prepare($sql2);
$OT->bindParam(':id', $id);
$OT->execute();
?>
<section class="works-orders">
    <div class="titulo">
        <h1>Works orders</h1>
    </div>
    <?php while ($OT_info = $OT->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="ot">
            <div class="img-ot">
                <img src="<?= $OT_info['imagen']; ?>" alt="imagen_vehiculo_antes" id="img-ot">
            </div>
            <div class="info-ot">
                <h2>Orden de Trabajo: #<?= $OT_info['id'] ?></h2>
                <h2><?= $OT_info['cliente'] ?></h2>
                <h2><?= $OT_info['placa_vehiculo']; ?></h2>
                <p><?= $OT_info['fecha_ingreso']; ?></p>
                <p><?= $OT_info['fecha_salida']; ?></p>
            </div>
            <div class="btn-ot">
                <a href="view_ot.php?id_ot=<?= $OT_info['id'] ?>" class="btn-ancla"><button><i class="fi fi-rr-eye">See more</i></button></a>
                <a href="edit_ot.php?id_ot=<?= $OT_info['id'] ?>" class="btn-ancla"><button><i class="fi fi-rr-file-edit">Edit</i></button></a>
                <a href="../controlador/delete_ot.php?id_ot=<?= $OT_info['id'] ?>&rute1=<?= $OT_info['imagen'] ?>" class="btn-ancla"><button><i class="fi fi-rr-trash">Delete</i></button></a>
            </div>
        </div>
    <?php endwhile; ?>

</section>
</div>
<?php include 'includes/footer.php' ?>