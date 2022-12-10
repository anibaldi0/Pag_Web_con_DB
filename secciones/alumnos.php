<?php

  #INSERT INTO `alumnos` (`id`, `nombre`, `apellido`) VALUES (NULL, 'Ani', 'Cae');
  include_once '../configuraciones/db.php';
  $conexionDB=DB::crearInstancia();

  #validacion de la info de llegada
  $id=isset($_POST['id'])?$_POST['id']:''; #validacion de id
  $nombre=isset($_POST['nombre'])?$_POST['nombre']:''; #validacion de nombre
  $apellido=isset($_POST['apellido'])?$_POST['apellido']:''; #validacion de apellido
  
  $cursos=isset($_POST['cursos'])?$_POST['cursos']:''; #validacion de cursos
  $accion=isset($_POST['accion'])?$_POST['accion']:''; #validacion de accion

  print_r($_POST);

  if ($accion != "") { #si se hizo una accion y es diferente de vacia entonces se valida un switch
    switch ($accion) {
      case 'agregar':
        $sql="INSERT INTO alumnos (id, nombre, apellido) VALUES (NULL, :nombre, :apellido)";
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->execute();

        $idAlumno=$conexionDB->lastInsertId(); #id que se recupera cuando se inserte el nuevo registro

        foreach ($cursos as $curso) {
          $sql="INSERT INTO alumnos_cursos (id, id_alumno, id_curso) VALUES (NULL, :id_alumno, :id_curso)";
          $consulta=$conexionDB->prepare($sql);
          $consulta->bindParam(':id_alumno', $idAlumno);
          $consulta->bindParam(':id_curso', $curso);
          $consulta->execute();

        }

      break;

      case 'Seleccionar':
        echo "Presionaste Seleccionar";
        
        $sql='SELECT * FROM alumnos WHERE id=:id';
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $alumnos=$consulta->fetch(PDO::FETCH_ASSOC);

        $nombre=$alumnos['nombre'];
        $apellido=$alumnos['apellido'];

        // se crea la consulta que relaciona alumnos con cursos en alumnos_cursos //
        $sql='SELECT cursos.id FROM alumnos_cursos INNER JOIN cursos ON cursos.id=alumnos_cursos.id_curso WHERE alumnos_cursos.id_alumno=:id_alumno';
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id_alumno', $id);
        $consulta->execute();
        $cursosAlumno=$consulta->fetchAll(PDO::FETCH_ASSOC);

        print_r($cursosAlumno);

        foreach($cursosAlumno as $curso) {
          $arregloCursos[]=$curso['id'];
        }
      break;

      case 'borrar'; //con esta accion borrar se borra el alumno seleccionado, su id y la relacion alumnos_cursos
        $sql="DELETE FROM alumnos WHERE id=:id";
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
      break;

      case 'editar': //en este case solo se actualizan los datos de alumnos y cursos...no se actualiza la relacion alumnos_cursos
        $sql='UPDATE alumnos SET nombre=:nombre, apellido=:apellido WHERE id=:id';
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

      if (isset($cursos)) {

        $sql='DELETE FROM alumnos_cursos WHERE id_alumno=:id_alumno';
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id_alumno', $id);
        $consulta->execute();

        foreach ($cursos as $curso) {

          $sql='INSERT INTO alumnos_cursos (id, id_alumno, id_curso) VALUES (NULL, :id_alumno, :id_curso)';
          $consulta=$conexionDB->prepare($sql);
          $consulta->bindParam(':id_alumno', $id);
          $consulta->bindParam(':id_curso', $curso);
          $consulta->execute();
        }
      }
      $arregloCursos=$cursos;
        
      


    }
  }

  $sql="SELECT * FROM alumnos";
  $listaAlumnos=$conexionDB->query($sql);
  $alumnos=$listaAlumnos->fetchAll();

  foreach ( $alumnos as $clave => $alumno) {

    $sql="SELECT * FROM cursos WHERE  id IN ( SELECT id_curso FROM alumnos_cursos WHERE id_alumno=:id_alumno)";
    $consulta=$conexionDB->prepare($sql); #se ejecuta la instruccion sql
    $consulta->bindParam(':id_alumno', $alumno['id']); #se recupera el id de alumno y lo pasamos como parametro
    $consulta->execute(); #se ejecuta la instruccion 
    $cursosAlumno=$consulta->fetchAll(); # se obtienen todos los registros de ese id de ese alumno y se lee alumno x alumno
    $alumnos[$clave]['cursos']=$cursosAlumno; # se almacenan en un arreglo

  }

  $sql="SELECT * FROM cursos";
  $listaCursos=$conexionDB->query($sql);
  $cursos=$listaCursos->fetchAll();

  

?>