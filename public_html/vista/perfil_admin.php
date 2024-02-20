<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/perfil_admin.css">
<?php
$sql2 = "SELECT * FROM ordenes_trabajo";
$OT = $con->prepare($sql2);
$OT->execute();
$work_order = $OT->fetchAll(PDO::FETCH_ASSOC);
?>




<section class="info-perfil">
    <h1>Bienvenido <?= $dates3['nombre'] ?></h1>
    <p>Aqui podras ver las ordenes de trabajo recibidas por parte de los trabajadores, para guardarlas presione el boton de aceptar.</p>
</section>
<section class="works-orders">
    <h1>Ordenes de trabajo en procesamiento</h1>
    <?php foreach ($work_order as $OT_info) : ?>
        <div class="work-order">
            <h2><?= $OT_info['placa_vehiculo']; ?></h2>
            <p><?= $OT_info['fecha_ingreso']; ?></p>
            <a href="view_ot_admin.php?id_ot=<?= $OT_info['id'] ?>"><button>Ver más</button></a>
            <a href="edit_ot.php?id_ot=<?= $OT_info['id'] ?>"><button>Editar</button></a>
            <a href="../controlador/accept.php?id_ot=<?= $OT_info['id'] ?>"><button>aceptar</button></a>
        </div>
    <?php endforeach; ?>
</section>
<?php include 'includes/footer.php'?>