<?php require_once 'includes/header.php';?>
<?php require_once 'includes/lateral.php';?>

<body>
<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las Entradas</h1>

    <?php

    $entradas = conseguirEntradas($db); //guardo en una variable la llamada a la funcion
    if(!empty($entradas)):
        while ($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                    <p>
                        <?=$entrada['descripcion']?>
                    </p>
                </a>
            </article>

        <?php
        endwhile;
    endif;
    ?>


</div>                          <!-- Fin Principal -->

<!-- FOOTER -->
<?php require_once 'includes/footer.php';?>

</body>
