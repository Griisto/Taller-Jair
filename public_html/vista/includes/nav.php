<?php
session_start();
require_once '../controlador/conexion.php';
$url = $_SERVER['REQUEST_URI'];
if (!empty($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $stmt = $con->prepare("SELECT * FROM usuarios WHERE id = :id");
  $stmt->execute(['id' => $id]);
  $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  if ($url != "https://" . $_SERVER['HTTP_HOST'] . "/index.php") {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . "/index.php");
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Taller Jair</title>
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/notificacion.css">
</head>

<body class="nav-page">
  <header class="navbar">
    <div class="navbar-brand">JC electricos calle</div>
    <button class="hamburger" id="hamburger">☰</button>
    <nav class="navbar-links desktop" id="navbarLinks">
      <?php if (!empty($id)) : ?>
        <?php foreach ($dates as $dates2) : ?>
          <?php if ($dates2['perfil'] == 't') : ?>
            <a href="perfil_user.php" class="nav-link">Perfil</a>
            <a href="register_ot.php" class="nav-link">Registrar orden de trabajo</a>
            <a href="view_ots_pr_user.php" class="nav-link">Ver mis ordenes de trabajo</a>
          <?php elseif ($dates2['perfil'] == 'a') : ?>
            <a href="perfil_admin.php" class="nav-link">Perfil admin</a>
            <a href="view_ot_pr.php" class="nav-link">Ordenes de trabajo</a>
            <a href="view_users.php" class="nav-link">Usuarios</a>
            <a href="list_labor.php" class="nav-link">Mano de obra</a>
            <a href="spares_parts.php" class="nav-link">Repuestos</a>
            <a href="brands.php" class="nav-link">Marcas</a>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </nav>
    <div class="navbar-buttons desktop">
      <?php if (!empty($id)) : ?>
        <a href="../controlador/signout.php" class="btn">Cerrar sesion</a>
      <?php else : ?>
        <a href="signin.php" class="btn">Iniciar sesion</a>
      <?php endif; ?>
    </div>
    <div id="dropdownMenu" class="dropdown-menu mobile">
      <nav class="dropdown-links mobile" id="navbarLinks">
        <a href="index.php" class="nav-link">Inicio</a>
        <?php if (!empty($id) && !empty($dates)) : ?>
          <?php foreach ($dates as $dates2) : ?>
            <?php if (isset($dates2['perfil']) && $dates2['perfil'] == 't') : ?>
              <a href="perfil_user.php" class="nav-link">Perfil</a>
              <a href="register_ot.php" class="nav-link">Registrar orden de trabajo</a>
              <a href="view_ots_pr_user.php" class="nav-link">Ver mis ordenes de trabajo</a>
            <?php elseif ($dates2['perfil'] == 'a') : ?>
              <a href="perfil_admin.php" class="nav-link">Perfil admin</a>
              <a href="view_ot_pr.php" class="nav-link">Ordenes de trabajo</a>
              <a href="view_users.php" class="nav-link">Usuarios</a>
              <a href="list_labor.php" class="nav-link">Mano de Obra</a>
              <a href="spares_parts.php" class="nav-link">Repuestos</a>
              <a href="brands.php" class="nav-link">Marcas</a>
            <?php endif; ?>
            <a href="edit_perfil.php" class="nav-link">Editar Perfil</a>
            <a class="nav-link"><button onclick="showMessageDelete()">Borrar perfil</button></a>
          <?php endforeach; ?>
        <?php endif; ?>
      </nav>
      <?php if (!empty($id)) : ?>
        <?php foreach ($dates as $ds) : ?>
          <div class="foto-perfil">
            <img src="<?= $ds['foto_de_perfil'] ?>" alt="">
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="dropdown-buttons mobile">
        <?php if (!empty($id)) : ?>
          <a href="../controlador/signout.php" class="btn">Cerrar sesion</a>
        <?php else : ?>
          <a href="signin.php" class="btn">Iniciar sesion</a>
        <?php endif; ?>
      </div>
    </div>
  </header>
  <?php if (!empty($id) && $url != "/taller%20jair/vista/index.php") : ?>
    <section class="body">
      <?php foreach ($dates as $dates3) : ?>
        <section class="perfil">
          <div class="img-user">
            <img src="<?= $dates3['foto_de_perfil'] ?>" alt="<?= $dates3['foto_de_perfil'] ?>">
          </div>
          <div class="section-btn">
            <?php if ($dates3['perfil'] == 'a') : ?>
              <a href="perfil_admin.php"><button>Perfil</button></a>
              <a href="list_labor.php"><button>Mano de obra</button></a>
              <a href="view_users.php"><button>Usuarios</button></a>
              <a href="spares_parts.php"><button>Repuestos</button></a>
              <a href="brands.php"><button>Marcas</button></a>
            <?php elseif ($dates3['perfil'] == 't') : ?>
              <a href="perfil_user.php"><button>Perfil</button></a>
              <a href="register_ot.php?id_usuario=<?= $id ?>"><button>Registrar orden de trabajo</button></a>
            <?php endif; ?>
            <a href="edit_perfil.php?id_usuario=<?= $id ?>"><button>Editar perfil</button></a>
            <a><button onclick="showMessageDelete()">Borrar perfil</button></a>
          </div>
        </section>
      <?php endforeach ?>
    <?php endif ?>
    <div class="container-content">
      <div id="message-delete" class="message-delete">
        <h1>Borrar cuenta</h1>
        <p>¿Estas seguro de querer borrar permanentemente tu cuenta?, Recuerda que si lo haces podrias perder toda tu informacion y ordenes de trabajo</p>
        <button class="btn-actions-message cancelar" onclick="hiddenMessageDelete()">Cancelar</button>
        <a href="../controlador/delete_perfil.php?id_usuario=<?= $id ?>&path=<?= $dates3['foto_de_perfil'] ?>"><button class="btn-actions-message borrar">Borrar cuenta</button></a>
      </div>