<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/signin.css">
  <title>Taller Jair - Iniciar Sesión</title>
</head>



<body>
  <div class="container">
    <div class="login-container">
      <?php if (isset($_GET['message']) && !empty($_GET['message'])) : ?>
        <div class="message">
          <?= $_GET['message']; ?>
        </div>
      <?php endif; ?>
      <form action="https://jcelectricoscalle.fun/controlador/signin.php" method="post">
        <h1>Iniciar Sesión</h1>

        <div class="input-group">
          <label for="username"><img src="../assets/img/unnamed 2.png" alt=""></label>
          <input type="text" id="username" name="username" placeholder="Usuario">
        </div>

        <div class="input-group">
          <label for="password"><img src="../assets/img/unnamed.png" alt=""></label>
          <input type="password" id="password" name="password" placeholder="Contraseña">
        </div>

        <div class="forgot-password">
          <a href="#">Olvidé mi contraseña</a>
        </div>

        <button class="login-button" type="submit">Iniciar Sesión</button>

        <div class="footer">
          <p>
            <a href="#">Soporte</a> —
            <a href="#">Términos de Uso</a> —
            <a href="#">Política de Privacidad</a> -
            <a href="signup.php">Registrarse</a>
          </p>
        </div>

      </form>
    </div>

    <div class="logo-container">
      <img src="../assets/img/6f587074b64b42792fc072219e6d1db9.jpg" alt="Taller Jair">
    </div>
  </div>

</body>

</html>