<?php include 'includes/nav.php' ?>
<?php include 'includes/notification.php' ?>
<link rel="stylesheet" href="../assets/css/view_users.css">
<?php
$sql = "SELECT * FROM usuarios WHERE id != :id";
$query = $con->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();
$list_users = $query->fetchAll(PDO::FETCH_ASSOC);

//Bloque de busqueda de usuario
if (!empty($_POST)) {
    $search = ucfirst(strtolower( @$_POST['search']));
    $perfil = @$_POST['perfil'];
    $estado = @$_POST['estado'];
    $sql_search = "SELECT * FROM usuarios WHERE nombre = ? OR correo = ? OR telefono = ? OR perfil = ? OR estado = ?";
    $query = $con->prepare($sql_search);
    $query->bindParam(1,$search);
    $query->bindParam(2,$search);
    $query->bindParam(3,$search);
    $query->bindParam(4,$perfil);
    $query->bindParam(5,$estado);
    $query->execute();
    $list_users = $query->fetchAll(PDO::FETCH_ASSOC);
}
//Fin de bloque
?>
<section class="workers">
    <div class="search">
        <form method="post">
            <input class="input-search" type="text" placeholder="Buscar por nombre, correo o telefono" name="search">
            <select class="input-search" name="perfil" id="">
                <option value="a">Administradores</option>
                <option value="u">Usuarios</option>
            </select>
            <select class="input-search" name="estado" id="">
                <option value="0">Bloqueados</option>
                <option value="1">Activos</option>
            </select>
            <input id="submit-search" type="submit" value="Search">
        </form>
    </div>
    <div id="header-actions">
        <a href="../vista/register_user.php"><button>New user</button></a>
        <a href="view_users.php"><button>Limpiar</button></a>
    </div>
    <div class="users">
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Perfil</th>
                    <th>Estado</th>
                    <th>Cambiar estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_users as $date_user) : ?>
                    <tr>
                        <td><?= $date_user['nombre'] ?></td>
                        <td><?= $date_user['correo'] ?></td>
                        <td><?= $date_user['telefono'] ?></td>
                        <?php if($date_user['perfil'] == 'a'): ?>
                            <td>Administrador</td>
                        <?php elseif($date_user['perfil'] == 's'):?>
                            <td>Secretaria</td>
                        <?php else:?>
                            <td>Tecnico</td>
                        <?php endif?>
                        <?php if ($date_user['estado'] == 1) :  ?>
                            <td>Activo</td>
                            <td><a href="../controlador/bloqueo.php?id_usuario=<?= $date_user['id'] ?>"><button>Bloquear</button></a></td>
                        <?php else : ?>
                            <td>Bloqueado</td>
                            <td><a href="../controlador/desbloqueo.php?id_usuario=<?= $date_user['id'] ?>"><button>Desbloquear</button></a></td>
                        <?php endif ?>
                        <td><a href="edit_user_ad.php?id_user=<?= $date_user['id'] ?> "><button>Editar</button></a>
                            <a href="../controlador/delete_user.php?id_usuario=<?= $date_user['id']  ?>&path=<?= $date_user['foto_de_perfil'] ?>"><button class="borrar">Borrar</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include 'includes/footer.php'?>