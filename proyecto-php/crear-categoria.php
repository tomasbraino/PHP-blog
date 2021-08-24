<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/header.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="principal">
    <h1>Crear Categorias</h1>
    <p>
        Añade nuevas categorias al blog para que los usuarios puedan usarlas
        al crear sus entradas.
    </p>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria: </label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar">
    </form>

</div>                          <!-- Fin Principal -->

<!-- FOOTER -->
<?php require_once 'includes/footer.php';?>

</body>
