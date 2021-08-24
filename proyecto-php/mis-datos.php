<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/header.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">

    <h1>Mis Datos</h1>

        <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?=$_SESSION['errores']['general']?>
            </div>
        <?php endif; ?>

<form action="actualizar-usuario.php" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']; ?>"/>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre')  : '' ;?>
    <!-- si existe el array $_SESSION que guarda el contenido de errores mostrar los errores captados en el campo 'nombre'-->

    <label for="apellido">Apellidos</label>
    <input type="text" name="apellido" value="<?=$_SESSION['usuario']['apellidos']; ?>"/>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido')  : '' ;?>

    <label for="email">Email</label>
    <input type="text" name="email" value="<?=$_SESSION['usuario']['email']; ?>"/>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email')  : '' ;?>

    <input type="submit" name="submit" value="Actualizar">
</form>
    <?php borrarErrores(); ?>

</div>

<?php require_once 'includes/footer.php';?>

