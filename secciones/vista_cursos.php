<!-- esta es la interface que se muestra al usuario (igual que vista_alumnos.php) para que ingrese el curso elegido.
En este archivo se coloca el formulario para elegir un curso y luego mandar los datos del curso a cursos.php
para que dicho archivo mande los datos a la DB.php -->

<?php include('../templates/cabecera.php');?>
<!-- se incluye el archivo cursos.php que hace el llamado a la db -->
<?php include('../secciones/cursos.php'); ?>

<div class="row">
  <div class="col-12">
    <div class="row">
      
      
      <div class="col-5"> <!-- El ancho de la pantalla es de 12 columnas, por lo que se hizo este div de 5 columnas
        para que el label no ocupe toda la pantalla, y se completó el ancho con el
        div de 7 columnas de abajo -->
        <br>
        <form action="" method="post">
        
          <!-- se agrega un div card header para crear un recuadro que
          contenga a los 2 labels mb-3 -->
          <div class="card">
            <div class="card-header">Cursos</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input type="text"
                  class="form-control"
                  name="id"
                  id="id"
                  value="<?php echo $id; ?>"
                  aria-describedby="helpId" placeholder="ID">
              </div>
              <div class="mb-3">
                <label for="nombre_curso" class="form-label">Nombre</label>
                <input type="text"
                  class="form-control"
                  name="nombre_curso"
                  id="nombre_curso"
                  value="<?php echo $nombre_curso; ?>"
                  aria-describedby="helpId" placeholder="Nombre del curso">
              </div>
              <!-- agregado de botones de edicion -->
              <div class="btn-group" role="group" aria-label="Button group name">
                <button type="submit" name="accion" value="agregar">Agregar</button>
                <button type="submit" name="accion" value="editar">Editar</button>
                <button type="submit" name="accion" value="borrar">Borrar</button>
              </div>
              
            </div>
            
          </div>
        
        </form>
        
      </div>
      
      <div class="col-7">
        <!-- esta tabla ocupa el resto de la pantalla, al lado de la card de cursos -->
        <br>
        <div class="table-responsive">
          <table class="table table-primary"> <!-- si borro table-primary de la class, el color de fondo de la tabla se borra -->
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listaCursos as $curso) { ?>
                <tr>
                  <td> <?php echo $curso['id']; ?></td>
                  <td> <?php echo $curso['nombre_curso']; ?></td>
                  <td>
                    <form action="" method="post">
                      <!-- el type del input se pone en hidden para que no aparezca el label mostrando el id del curso, y quede mejor presentado (el label esta, pero oculto)-->
                      <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>" />
                      <!-- el type del input se pone como submit para que al recibir el input en el label al precionar el boton se haga un envio -->
                      <input type="submit" value="Seleccionar" name="accion" class="btn btn-info" >
                    </form>
                  </td>
                </tr>
              <?php } ?>
              
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>
</div>

<?php include('../templates/pie.php'); ?>