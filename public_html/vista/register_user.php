<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/register_user.css">


<?php if (isset($_GET['message']) && !empty($_GET['message'])) : ?>
  <div>
    <?= $_GET['message']; ?>
  </div>
<?php endif; ?>
<form action="../controlador/register_user.php" method="post" enctype="multipart/form-data" id="registrationForm" class="mb-4">
  <div class="container mt-5">
    <div id="imageContainer" class="mb-4"></div>
    <label for="profilePic" class="fileLabel d-flex align-items-center">
      <span id="plusSymbol" class="me-2">+</span>
      <input name="foto_perfil" type="file" id="profilePic" accept="image/*" class="form-control">
    </label>
    <button id="deleteButton" class="btn btn-danger d-block mx-auto mb-4">Eliminar Imagen</button>


    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" id="nombre" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo Electrónico:</label>
      <input type="email" id="correo" name="correo" class="form-control">
    </div>

    <div class="mb-3">
      <label for="contrasena" class="form-label">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena" class="form-control">
    </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Teléfono:</label>
      <input type="tel" id="telefono" name="telefono" class="form-control">
    </div>

    <input type="hidden" name="perfil" value="t">

    <button type="submit" class="btn btn-primary">Registrar</button>
</form>


<?php include 'includes/footer.php' ?>