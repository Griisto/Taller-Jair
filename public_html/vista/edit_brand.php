<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/edit_brand.css">
<?php
$idMarca = $_GET['id_brand'];
$sqlSelectItems = "SELECT id,marca FROM marcas_vehiculo WHERE id = :id";
$querySelectItems = $con->prepare($sqlSelectItems);
$querySelectItems->bindParam(':id', $idMarca);
$querySelectItems->execute();
$itemsEdit = $querySelectItems->fetch(PDO::FETCH_ASSOC)
?>
<div id="container-form-edit">
    <a href="brands.php"><button><i class="fi fi-rr-arrow-small-left"></i></button></a>
    <h1>Editar marca</h1>
    <form action="../controlador/edit_brand.php" method="post">
        <input type="hidden" name="id" value="<?= $itemsEdit['id'] ?>">
        <input type="text" name="marca" placeholder="Ingrese el nombre de la marca" value="<?= $itemsEdit['marca'] ?>">
        <button>Actualizar</button>
    </form>
</div>


<?php include 'includes/footer.php' ?>