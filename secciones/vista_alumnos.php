<!-- en estre archivo se van a mostrar los alumnos o nuevos usuarios ingresados, 
y va a estar ligado o unido al archivo alumnos.php que es el que recibe
los alumnos ingresados y los manda a la BD.php-->

<?php include('../templates/cabecera.php');?> <!-- con esta linea se linkea a cabecera.php -->
<?php include('../secciones/alumnos.php');?> <!-- con esta linea se linkea a vista_alumnos.php -->

  <div class="row">
    <div class="col-5">
      <form action="" method="post">
        <br>
        <div class="card">
          <div class="card-header">
            Alumnos
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input type="text"
                class="form-control" name="id" value="<?php echo $id;?>" id="id" aria-describedby="helpId" placeholder="id">
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"
                class="form-control" name="nombre" value="<?php echo $nombre;?>" id="nombre" aria-describedby="helpId" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text"
                class="form-control" name="apellido" value="<?php echo $apellido;?>" id="apellido" aria-describedby="helpId" placeholder="Apellido">
            </div>

            <div class="mb-3"> <!-- form desplegable con seleccion multiple -->
              <label for="" class="form-label">Cursos del Alumno</label>
              <!-- <select> que muestra todos los cursos disponibles -->
              <select multiple class="form-select" name="cursos[]" id="listaCursos">
                

                <?php foreach ($cursos as $curso) { ?> <!-- foreach que muestra los cursos dentro del form desplegable -->
                  <option
                    <?php //se pregunta si $arregloCursos tiene algo, si lo tiene, se busca en id de curso y se imprime 'selected'
                      if (!empty($arregloCursos)):
                        if (in_array($curso['id'], $arregloCursos)):
                          echo 'selected';
                        endif;
                      endif;
                    ?>
                  value="<?php echo $curso['id'];?>"><?php echo $curso['id'];?> - <?php echo $curso['nombre_curso'];?>
                  </option>
                <?php } ?>

              </select>
            </div>
            
            <div class="btn-group" role="group" aria-label="">
              <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button> <!-- con btn-success cambia a color verde -->
              <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button> <!-- con btn-warning cambia a color amarillo -->
              <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button> <!-- con btn-danger cambia a color rojo -->
            </div>
          </div>
          <div class="card-footer text-muted">
            Footer
          </div>
        </div>
      </form>
    </div>
    <div class="col-7">
      <br>
      <div class="table-responsive">
        <table class="table table-primary">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($alumnos as $alumno): ?>
              <tr>
                <td><?php echo $alumno['id']; ?></td>
                <td>
                  <?php echo $alumno['nombre']; ?> <?php echo $alumno['apellido']; ?> <br/>
                  <?php foreach ($alumno["cursos"] as $curso) { ?>  <!-- foreach que permite mostrar los cursos al lado del alumno -->
                      - <a href="certificado.php?id_curso=<?php echo $curso['id']; ?>&id_alumno=<?php echo $alumno['id']; ?>"><?php echo $curso['nombre_curso']; ?> <br/> <!-- etiqueta <a> para mostrar los cursos en forma de link -->
                  <?php } ?>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="hidden" name="id" id="" value="<?php echo $alumno['id'];?>"> <!-- se agrega un label que se oculta con hidden, para que almacene el id del alumno seleccionado-->
                    <input type="submit" value="Seleccionar" name='accion' class='btn btn-info'> <!-- se agrega un boton del tipo submit para enviar lo seleccionado al card de alumnos-->
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
  <!-- codigo externo (www.tom-select.js.org) para seleccionar los cursos e ir almacenandolos en un label, para mostrar lo seleccionado de forma mas clara -->
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
  <!-- script que enlaza el id de listaCursos con el label externo -->
  <script>
    new TomSelect('#listaCursos'); 
  </script>

<?php include('../templates/pie.php'); ?>