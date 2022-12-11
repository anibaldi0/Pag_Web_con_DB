<!-- Este index.php es el doc principal o bienvenida que se va a mostrar una vez Inscripto o Logueado.
Se generó un ?php ? inicial con su header, body y footer, y se dividió en dos.
Todo el contenido del header se coloco en cabecera.php dentro de templates
y todo el footer se coloco en pie.php dentro de templates  -->

<!-- este archivo se divide en 3 parte para que no haya que hacer un header y un footer
para cada archivo de la carpeta secciones, por lo que solo se hace una cabecera.php y un pie.php
en templates, y que se repitan o se llamen desde cada archivo de la carpeta secciones -->

<?php include('../templates/cabecera.php'); ?>

    Contenido del Index.php (inicio de la app)

<?php include('../templates/pie.php'); ?>