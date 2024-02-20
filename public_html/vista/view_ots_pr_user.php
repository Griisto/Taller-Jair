<?php include 'includes/nav.php' ?>
<link rel="stylesheet" href="../assets/css/view_ots_pr_user.css">
<?php
$sql = "SELECT *,
(SELECT foto_de_perfil FROM usuarios WHERE otp.id_usuario = id) AS foto_usuario 
FROM ordenes_trabajo_pm otp WHERE id_usuario = :id";
$query = $con->prepare($sql);
$query->bindParam(':id',$id);
$query->execute();
$dates_ot = $query->fetchAll(PDO::FETCH_ASSOC)
?>
<section class="info-perfil">
    <p>En esta seccion podras ver las ordenes de trabajo guardadas pero solo podras verlas, si notas alguna inconsistencia comunicate con tu superior.</p>
</section>
<section class="ot-permanent">
    <h1>Tus ordenes de trabajo</h1>
    <div class="buscador">
        <!--Seccion para buscar ordenes de trabajo en especifico-->
    </div>
    <?php foreach ($dates_ot as $ot) : ?>
        <div class="ot-worker">
            <div class="container-photo-user">
                <img src="<?= $ot['imagen'] ?>" alt="Foto de trabajador">
            </div>
            <div class="info-ot">
                <h1>Informacion:</h1>
                <p><?= $ot['placa_vehiculo'] ?></p>
                <p><?= $ot['cliente'] ?></p>
            </div>
            <div class="btn-actions">
                <a href="view_ot_pr_for_user.php?id_ot=<?= $ot['id'] ?>" class="url"><button><i class="fi fi-rr-eye">Ver mas</i></button></a>
            </div>
        </div>
    <?php endforeach ?>
</section>
</div>
<?php include 'includes/footer.php' ?>