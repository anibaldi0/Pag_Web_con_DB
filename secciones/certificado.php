<?php
  //agregado de librerias descargada desde www.fpdf.org(v1.84zip) a la carpeta librerias para la confeccion de certificados pdf

  //code copiado de la pag www.fpdf.org en tutorial1 (minimal example)
  require ('../librerias/fpdf/fpdf.php');

  // $pdf = new FPDF();
  // $pdf->AddPage();
  // $pdf->SetFont('Arial','B', 16);
  // $pdf->Cell(60,60,'Hola');
  // $pdf->Output();

  //agregado de texto al certificado
  function agregarTexto($pdf,$texto,$x,$y,$align='L',$fuente,$size=10,$r=0,$g=0,$b=0) {
    $pdf->SetFont($fuente,"",$size);
    $pdf->SetXY($x,$y);
    $pdf->SetTextColor($r,$g,$b);
    $pdf->Cell(0,10,$texto,0,0,$align);
  }
  //agregado de la imagen del certificado
  function agregarImagen($pdf,$imagen,$x,$y) {
    $pdf->Image($imagen,$x,$y,0);
  }

    //creacion del certificado en PDF
  $pdf = new FPDF("L","mm",array(254,194));
  $pdf->AddPage();
  $pdf->SetFont("Arial","B",16);
  agregarImagen($pdf,"../src/cert-log1.jpg",0,0);
  agregarTexto($pdf,"Anibal",60,70,"L","Helvetica",30,0,84,115);
  agregarTexto($pdf,'Sitio Web con PHP',-250,115,'L','Helvetica',20,0,84,115);
  agregarTexto($pdf,'10/12/2022',-350,155,'L','Helvetica',11,0,84,115);
  $pdf->Output();

  // se crea una consulta (la misma que en vista_alumnos) para recuperar los datos y ponerlos dentro del certificado
  include_once '../configuraciones/db.php';
  $conexionDB=DB::crearInstancia();


  
  //agregado de texto al certificado
  // function agregarTexto($pdf,$texto,$x,$y,$align='L',$fuente,$size=10,$r=0,$g=0,$b=0) {
  //   $pdf->SetFont($fuente,$align,$size);
  //   $pdf->SetXY($x,$y);
  //   $pdf->SetTextColor($r,$g,$b);
  //   $pdf->Cell(0,10,$texto,0,0,$align);
  // }
  //agregado de la imagen del certificado
  // function agregarImagen($pdf,$imagen,$x,$y) {
  //   $pdf->Image($imagen,$x,$y,0);
  // }

  //print_r($_GET);
  $idcurso=isset($_GET['id_curso'])?$_GET['id_curso']:'';
  $idalumno=isset($_GET['id_alumno'])?$_GET['id_alumno']:'';
  
  $sql="SELECT alumnos.nombre, alumnos.apellido, cursos.nombre_curso FROM alumnos, cursos WHERE alumnos.id=:id_alumno AND cursos.id=:id_curso";
  $consulta=$conexionDB->prepare($sql);
  $consulta->bindParam(':id_alumno',$idalumno);
  $consulta->bindParam(':id_curso',$idcurso);
  $consulta->execute();
  $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
  //print_r($alumno);

  //creacion del certificado en PDF
  //$pdf = new FPDF("L","mm",array(254,194));
  //$pdf->AddPage();
  //$pdf->SetFont("Arial","B",16);
  // agregarImagen($pdf, '../src/cert-log1.jpg', 0, 0);
  // agregarTexto($pdf, 'Anibal', 60, 70, 'C', 'Helvetica', 30, 0, 84, 115);
  // agregarTexto($pdf, 'Sitio Web con PHP', -250, 115, 'C', 'Helvetica', 20, 0, 84, 115);
  // agregarTexto($pdf, '10/12/2022', -350, 155, 'C', 'Helvetica', 11, 0, 84, 115);
  //$pdf->Output();

?>