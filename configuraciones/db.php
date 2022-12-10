db.php

<!-- aca se coloca la coneccion a la DB -->

<?php

  class DB {
    public static $instancia = null; #se crea una instancia para la coneccion
    public static function crearInstancia () { #se crea un metodo para la instancia
      if (!isset (self::$instancia)) { #se pregunta si la instancia tiene algo
        #se crea la coneccion a la DB
        $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instancia = new PDO('mysql:host=localhost;dbname=aplicacion', 'root', '', $opciones);
        echo "conectado...";
      }
      return self::$instancia;
    }

  }

?>