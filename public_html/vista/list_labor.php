<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/list_labor.css">
<?php

//Bloque para seleccionar las marcas
$sqlSelectBrand = "SELECT * FROM marcas_vehiculo";
$queryBrand = $con->prepare($sqlSelectBrand);
$queryBrand->execute();
$resultsBrand = $queryBrand->fetchAll(PDO::FETCH_ASSOC);
//Fin de bloque



//Bloque para mostrar los trabajos
$sqlSelectItems = "SELECT id,trabajo,precio_trabajo,
    (SELECT marca FROM marcas_vehiculo WHERE mo.vehiculo = id)AS marca 
    FROM mano_obra mo";
$querySelectItems = $con->prepare($sqlSelectItems);
$querySelectItems->execute();
$resultsItems = $querySelectItems->fetchAll(PDO::FETCH_ASSOC);
//Fin de lista



?>
<section class="list-labor">
    <div id="container-form-item">
        <button onclick="hiddenForm()"><i class="fi fi-rr-arrow-small-left"></i></button>
        <form action="../controlador/register_list_labor.php" method="post">
            <h1>Crear item nuevo</h1>
            <input type="text" name="work" placeholder="trabajo">
            <input type="number" name="price" placeholder="precio">
            <!--Input donde muestra la marca del vehiculo-->
            <select name="brand">
                <?php foreach ($resultsBrand as $brands) : ?>
                    <option value="<?= $brands['id'] ?>"><?= $brands['marca'] ?></option>
                <?php endforeach; ?>
            </select>
            <button>Crear</button>
        </form>
    </div>
    <div class="container-table">
        <table>
            <thead>
                <div class="btn-list">
                    <button onclick="showForm()">Crear nuevo item</button>
                </div>
                <tr>
                    <th>Item</th>
                    <th>Trabajo</th>
                    <th>Precio</th>
                    <th>Marca vehiculo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultsItems as $items) :  ?>
                    <tr>
                        <td><?= $items['id'] ?></td>
                        <td><?= $items['trabajo'] ?></td>
                        <td><?= number_format($items['precio_trabajo'],2,",",".") ?></td>
                        <td><?= $items['marca'] ?></td>
                        <td><a href="edit_list_labor.php?id_labor=<?= $items['id'] ?>"><i class="fi fi-rr-pencil"></i></a></td>
                        <td><a href="../controlador/delete_list_labor.php?id=<?= $items['id'] ?> "><i class="fi fi-rr-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        
    </div>
</section>
</div>

<?php include 'includes/footer.php' ?>