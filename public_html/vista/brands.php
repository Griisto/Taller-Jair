<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/brands.css">
<?php
$sqlSelectItems = "SELECT id,marca FROM marcas_vehiculo";
$querySelectItems = $con->prepare($sqlSelectItems);
$querySelectItems->execute();
$resultsItems = $querySelectItems->fetchAll(PDO::FETCH_ASSOC);



?>

<div id="container-item-form">
    <button onclick="hiddenFormBrand()"><i class="fi fi-rr-arrow-small-left"></i></button>
    <h1>Guardar nueva marca</h1>
    <form action="../controlador/register_brand.php" method="post">
        <input type="text" name="marca" placeholder="Ingrese el nombre de la marca">
        <button>Guardar</button>
    </form>
</div>
<div class="container-table">
    <button onclick="showFormBrand()">Ingresar marca</button>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Marca</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultsItems as $marca) : $idMarca = $marca['id'] ?>
                <tr>
                    <td><?= $marca['id'] ?></td>
                    <td><?= $marca['marca'] ?></td>
                    <td>
                        <a href="edit_brand.php?id_brand=<?= $marca['id'] ?>"><button class="editar">Editar</button></a>
                        <a href="../controlador/delete_brand.php?id=<?= $marca['id'] ?>"><button class="borrar">Borrar</button></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
   <?php include 'includes/footer.php' ?>