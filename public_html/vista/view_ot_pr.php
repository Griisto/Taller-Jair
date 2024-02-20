<?php include 'includes/nav.php' ?>
<link rel="stylesheet" href="../assets/css/view_ot_pr.css">
<?php
$sql = "SELECT *,
(SELECT foto_de_perfil FROM usuarios WHERE otp.id_usuario = id) AS foto_usuario
FROM ordenes_trabajo_pm otp";
$query = $con->prepare($sql);
$query->execute();
$dates_ot = $query->fetchAll(PDO::FETCH_ASSOC)
?>
<section class="info-perfil">
    <p>En esta seccion podras ver las ordenes de trabajo guardadas y ya cotizadas, solo tu podras verlas, borrarlas y editar estas ordenes de trabajo.</p>
</section>
<section class="ot-permanent">
    <h1>Work orders</h1>
    <div class="buscador">
        <!--Seccion para buscar ordenes de trabajo en especifico-->
    </div>
    <?php foreach ($dates_ot as $ot) : ?>
        <div class="ot-worker">
            <div class="container-photo-user">
                <img src="<?= $ot['foto_usuario'] ?>" alt="Foto de trabajador">
            </div>
            <div class="info-ot">
                <h1>Informacion:</h1>
                <p><?= $ot['placa_vehiculo'] ?></p>
                <p><?= $ot['cliente'] ?></p>
            </div>
            <div class="btn-actions">
                <a href="view_ot_pr_admin.php?id_ot=<?= $ot['id'] ?>" class="url"><button><i class="fi fi-rr-eye">Ver más</i></button></a>
                <a href="edit_ot_admin.php?id_ot=<?= $ot['id'] ?>" class="url"><button><i class="fi fi-rr-file-edit">Editar</i></button></a>
                <a href="../controlador/delete_ot_pm.php?id_ot=<?= $ot['id'] ?>&rute1=<?= $ot['imagen'] ?>" class="url"><button><i class="fi fi-rr-trash">Borrar</i></button></a>
            </div>
        </div>
    <?php endforeach ?>
</section>
</div>
<?php include 'includes/footer.php' ?>