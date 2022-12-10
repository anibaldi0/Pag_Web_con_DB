<?php
  #instruccion que nos permite insertar info a la DB.php
  # INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'Sitio Web con PHP'); 
  
  include_once '../configuraciones/db.php';
  $conexionDB=DB::crearInstancia(); #metodo con el cual se llama a la db

  $id=isset($_POST['id'])?$_POST['id']:'';
  $nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
  $accion=isset($_POST['accion'])?$_POST['accion']:''; #validacion

  print_r($_POST);

  if ($accion!=''){ #si $accion no esta vacio....se crea la verificacion switch para saber que boton preciona el usuario
    switch($accion){ #switch que evalua lo que presiona el usuario, por eso se crea un case para cada accion
      
      case 'agregar':
        $sql="INSERT INTO cursos (id, nombre_curso) VALUES (NULL,:nombre_curso)"; #consulta que debe hacer la accion al oprimir el boton...en VALUE se usa :nombre_curso en vez de $nombre_curso
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':nombre_curso',$nombre_curso); #se pasa un parametro
        $consulta->execute(); #se ejecuta la consulta de INSERT
        echo $sql;
      break;

      case 'editar':
        $sql = "UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->bindParam(':nombre_curso',$nombre_curso);
        $consulta->execute();
        echo $sql;
      break;

      case 'borrar':
        $sql = "DELETE FROM cursos WHERE id=:id";
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        echo $sql;
      break;

      case "Seleccionar": #query que envia los cursos y id seleccionados con el boton Seleccionar al label dentro del div card de cursos
        $sql="SELECT * FROM cursos WHERE id=:id";
        $consulta=$conexionDB->prepare($sql);
        $consulta->bindParam(':id',$id);
        $consulta->execute();
        $curso=$consulta->fetch(PDO::FETCH_ASSOC);
        $nombre_curso=$curso['nombre_curso'];
        print_r($curso);
      break;

    }
  }

  #print_r($_POST); #instruccion que imprime los envios de los botones agregar, editar y borrar

  $consulta=$conexionDB->prepare("SELECT * FROM cursos");
  $consulta->execute();
  $listaCursos=$consulta->fetchAll(); #fetchAll nos retorna todos los datos y los almacena en $listaCursos
   

?>