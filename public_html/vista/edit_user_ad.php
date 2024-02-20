<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<?php
if (!empty($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $sql = "SELECT * FROM usuarios WHERE id = :id_user";
    $query = $con->prepare($sql);
    $query->bindParam(':id_user', $id_user);
    if ($query->execute()) {
        $ot = $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<form action="../controlador/edit_perfil.php" method="post" enctype="multipart/form-data" id="registrationForm" class="mb-4">
    <div class="container mt-5">
        <div id="imageContainer" class="mb-4"></div>
        <label for="profilePic" class="fileLabel d-flex align-items-center">
            <span id="plusSymbol" class="me-2">+</span>
            <input name="foto_perfil" type="file" id="profilePic" accept="image/*" class="form-control">
        </label>
        <button id="deleteButton" class="btn btn-danger d-block mx-auto mb-4">Eliminar Imagen</button>


        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $ot['nombre'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?= $ot['correo'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?= $ot['telefono'] ?>" class="form-control">
        </div>

        <input type="hidden" name="path_perfil" value="<?= $ot['foto_de_perfil'] ?>">
        <input type="hidden" name="id_usuario" value="<?= $id ?>">

        <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<?php include 'includes/footer.php'?>