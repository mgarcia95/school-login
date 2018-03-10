<?php
include "funciones.php";
session_start();
echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apell'];

if(isset($_REQUEST['imprimir']))
{
  $conex=conectar();
  if($conex!=0)
    {
        imprimir_boletin($conex);
        echo "Fichero creado correctamente";
        mysqli_close($conex);
    }
  else
  {
        echo "ERROR DE CONEXIÓN CON LA BD";
  }
    
}
?>
<form action="" method="POST">
EVALUACION: <select name="evaluacion">
<option value="1EVAL">1 EVAL</option>
<option value="2EVAL">2 EVAL</option>
<option value="3EVAL">3 EVAL</option>
</select><br />
<input type="submit" name="imprimir" value="Imprimir" />
</form>