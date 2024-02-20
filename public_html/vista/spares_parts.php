<?php include 'includes/nav.php'?>
<?php include 'includes/notification.php'?>
<link rel="stylesheet" href="../assets/css/spares_parts.css">
<?php 
//Bloque para mostrar los trabajos
$sqlSelectItems = "SELECT id,nombre,precio FROM repuestos";
$querySelectItems = $con->prepare($sqlSelectItems);
$querySelectItems->execute();
$resultsItems = $querySelectItems->fetchAll(PDO::FETCH_ASSOC);
//Fin de lista


?>

<div id="container-form-item">
    <button onclick="hiddenFormSparePart()" class="button-form"><i class="fi fi-rr-arrow-small-left"></i></button>
    <form action="../controlador/register_spare_part.php" method="post">
        <h1>Crear item nuevo</h1>
        <input type="text" name="repuesto" placeholder="Repuesto">
        <input type="number" name="precio" placeholder="precio unitario">
        <button class="btn-form">Crear</button>
    </form>
</div>

<div class="container-table">
    <button onclick="showFormSpare()">Ingresar repuesto</button>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Repuesto</th>
                <th>Precio Unitario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultsItems as $Repuesto) : $idSpare = $Repuesto['id'] ?>
                <tr>
                    <td><?= $Repuesto['id'] ?></td>
                    <td><?= $Repuesto['nombre'] ?></td>
                    <td><?= $Repuesto['precio'] ?></td>
                    <td>
                        <button class="editar" onclick="showFormSpareEdit()">Editar</button>
                        <a href="../controlador/delete_spare.php?id=<?= $Repuesto['id'] ?>"><button class="borrar">Borrar</button></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
            <?php
                $sqlSelectItems = "SELECT * FROM repuestos WHERE id = :id ";
                $querySelectItems = $con->prepare($sqlSelectItems);
                $querySelectItems->bindParam(':id', $idSpare);
                $querySelectItems->execute();
                $itemsEdit = $querySelectItems->fetch(PDO::FETCH_ASSOC)
                ?>
<div id="container-form-item-edit">
    <button onclick="hiddenFormSparePartEdit()" class="button-form"><i class="fi fi-rr-arrow-small-left"></i></button>
    <form action="../controlador/edit_spare_part.php" method="post">
        <h1>Editar item</h1>
        <input type="hidden" name="id" value="<?= $itemsEdit['id'] ?>">
        <input type="text" name="repuesto-edit" placeholder="trabajo" value="<?= $itemsEdit['nombre'] ?>">
        <input type="number" name="precio-edit" placeholder="precio" value="<?= $itemsEdit['precio'] ?>">
        <button class="btn-form">Actualizar</button>
    </form>
</div>









<?php include 'includes/footer.php'?>