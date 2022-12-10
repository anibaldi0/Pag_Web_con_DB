<?php
  //agregado de librerias descargada desde www.fpdf.org(v1.84zip) a la carpeta librerias para la confeccion de certificados pdf

  //code copiado de la pag www.fpdf.org en tutorial1 (minimal example)
  require ('../librerias/fpdf/fpdf.php');
  
/*$pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,10,'Hello World!');
  $pdf->Output(); */

  // se crea una consulta (la misma que en vista_alumnos) para recuperar los datos y ponerlos dentro del certificado
  include_once '../configuraciones/db.php';
  $conexionDB=DB::crearInstancia();

  print_r($_GET);
  $idcurso=isset($_GET['id_curso'])?$_GET['id_curso']:'';
  $idalumno=isset($_GET['id_alumno'])?$_GET['id_alumno']:'';
  
  $sql="SELECT alumnos.nombre, alumnos.apellido, cursos.nombre_curso FROM alumnos, cursos WHERE alumnos.id=:id_alumno AND cursos.id=:id_curso";
  $consulta=$conexionDB->prepare($sql);
  $consulta->bindParam(':id_alumno', $idalumno);
  $consulta->bindParam(':id_curso', $idcurso);
  $consulta->execute();
  $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
  print_r($alumno);

?>