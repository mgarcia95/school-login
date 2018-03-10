<?php
include "funciones.php";
session_start();
echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apell']."<br>";
$conex=conectar();
$consulta=mysqli_query($conex,"SELECT Codigo,Descripcion from asignatura a,profesor p where a.Dni_prof=p.DNI and p.DNI=$_SESSION[dni]");
mysqli_close($conex);
if(isset($_REQUEST['buscar']))
{
    
    $conex=conectar();
    $consulta2=mysqli_query($conex,"SELECT DNI,Nombre,Apellidos,Evaluacion,Nota,Comentarios from alumnos a,calificacion c where a.DNI=c.Dni_alumno and c.Cod_asig=$_REQUEST[asig]");
    if(mysqli_num_rows($consulta2)>0)
    {
        while($fila=mysqli_fetch_array($consulta2))
        {
            echo "DNI: ".$fila['DNI']."<br>";
            echo "Nombre: ".$fila['Nombre']."<br>";
            echo "Apellidos: ".$fila['Apellidos']."<br>";
            echo "Evaluacion: ".$fila['Evaluacion']."<br>";
            echo "Nota: ".$fila['Nota']."<br>";
            echo "Comentarios: ".$fila['Comentarios']."<br>";
            echo "================"."<br>";
        }
    }
    mysqli_close($conex);
}
?>
<h1>Listado de alumnos</h1><br />
<form action="" method="POST">
Asignatura: <select name="asig">
<?php
while($fila=mysqli_fetch_array($consulta))
    echo "<option value=$fila[Codigo]>".$fila['Descripcion']."</option>";
?>
</select><br />
<input type="submit" name="buscar" value="Buscar alumnos"/>
</form>