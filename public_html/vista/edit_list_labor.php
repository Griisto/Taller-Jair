<?php include 'includes/nav.php' ?>
<?php include 'include/notification.php' ?>
<link rel="stylesheet" href="../assets/css/edit_list_labor.css">
<?php
$id_labor = $_GET['id_labor'];

$sqlSelectBrand = "SELECT * FROM marcas_vehiculo";
$queryBrand = $con->prepare($sqlSelectBrand);
$queryBrand->execute();
$resultsBrand = $queryBrand->fetchAll(PDO::FETCH_ASSOC);


$sqlSelectItems = "SELECT *,(SELECT marca FROM marcas_vehiculo WHERE mo.vehiculo = id)AS marca FROM mano_obra mo WHERE id = :id ";
$querySelectItems = $con->prepare($sqlSelectItems);
$querySelectItems->bindParam(':id', $id_labor);
$querySelectItems->execute();
$itemsEdit = $querySelectItems->fetch(PDO::FETCH_ASSOC)
?>
<div id="container-form-item-edit">
    <a href="list_labor.php"><button><i class="fi fi-rr-arrow-small-left"></i></button></a>
    <form action="../controlador/edit_list_labor.php" method="post">
        <h1>Editar item</h1>
        <input type="hidden" name="id" id="input-id">
        <input type="text" name="work-edit" placeholder="trabajo" value="<?= $itemsEdit['trabajo'] ?>">
        <input type="number" name="price-edit" placeholder="precio" value="<?= $itemsEdit['precio_trabajo'] ?>">
        <!--Input donde muestra la marca del vehiculo-->
        <select name="brand-edit">
            <option value="<?= $itemsEdit['id'] ?>" selected><?= $itemsEdit['marca'] ?></option>
            <?php foreach ($resultsBrand as $brands) : ?>
                <option value="<?= $brands['id'] ?>"><?= $brands['marca'] ?></option>
            <?php endforeach; ?>
        </select>
        <button>Actualizar</button>
    </form>
</div>



<?php include 'includes/footer.php' ?>