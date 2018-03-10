<?php
include "funciones.php";

session_start();
echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apell'];

$conex = conectar();
$consulta = mysqli_query($conex,"SELECT distinct Codigo,Descripcion from asignatura a,calificacion c where a.Codigo=c.Cod_asig and c.Dni_alumno=$_SESSION[dni]");
mysqli_close($conex);
?>

<h1>Mis Notas</h1><br />
<form action="" method="POST">
  Asignatura:
  <select name="asig">
    <?php
      while($fila=mysqli_fetch_array($consulta))
      echo "<option value=$fila[Codigo]>".$fila['Descripcion']."</option>";
    ?>
  </select><br />
  <input type="submit" name="buscar" value="Buscar"/>
</form>

<?php
  if (isset($_REQUEST['buscar']))
{
    $conex=conectar();
    $consulta=mysqli_query($conex,"SELECT Evaluacion,Nota from calificacion where Dni_alumno=$_SESSION[dni] and Cod_asig=$_REQUEST[asig]");
    if(mysqli_num_rows($consulta)>0)
    {
       echo "EVAL NOTA"."<br>";
       while($fila=mysqli_fetch_array($consulta))
       {
        echo $fila['Evaluacion']." ".$fila['Nota']."<br>";
        $suma+=$fila['Nota'];
        $cont++;
       }
       $media=$suma/$cont;
       echo "La media es $media";

    }
}
