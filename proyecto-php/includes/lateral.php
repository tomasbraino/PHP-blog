<?php require_once 'includes/helpers.php';?>  <!-- incluyo helpers para utilizar las funciones dentro de el (estilo interfaz)-->

<!-- BARRA LATERAL -->

<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda"/>
            <input type="submit" value="Buscar">
        </form>
    </div>


    <?php if(isset($_SESSION['usuario'])): ?>
    <div id = "usuario-logeado" class = "bloque">
        <h3>Bienvenido,<?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
        <!-- botones -->
        <a href="crear-entradas.php" class="boton boton-naranja">Crear entradas</a>
        <a href="mis-datos.php" class="boton boton-verde">Mis Datos</a>
        <a href="crear-categoria.php" class="boton ">Crear categoria</a>
        <a href="cerrar.php" class="boton boton-rojo">Cerrar Sesion</a>

    </div>
    <?php endif; ?>


    <?php if(isset($_SESSION['error_login'])): ?>
        <div class = "alerta alerta-error">
            <?= ($_SESSION['error_login']); ?>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
    <div id="login" class="bloque">
        <h3>Identificate</h3>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="text" name="email"/>

            <label for="password">Password</label>
            <input type="password" name="password"/>

            <input type="submit" value="Entrar">
        </form>
    </div>

    <div id="register" class="bloque">

        <h3>Registrate</h3>

        <!-- Mostrar errores -->
        <?php if(isset($_SESSION['completado'])): ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado']?>
                </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div class="alerta alerta-error">
                    <?=$_SESSION['errores']['general']?>
                </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre')  : '' ;?>
                <!-- si existe el array $_SESSION que guarda el contenido de errores mostrar los errores captados en el campo 'nombre'-->

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido')  : '' ;?>

            <label for="email">Email</label>
            <input type="text" name="email"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email')  : '' ;?>

            <label for="password">Password</label>
            <input type="password" name="password"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password')  : '' ;?>

            <input type="submit" name="submit" value="Registrar">
        </form>
        <?php borrarErrores(); ?>
    </div>
    <?php endif; ?>
</aside>

