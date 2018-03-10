<?php
include "funciones.php";
session_start();
echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apell']."<br>";
$conex=conectar();
$consulta=mysqli_query($conex,"SELECT Codigo,Descripcion from asignatura a,profesor p where a.Dni_prof=p.DNI and p.DNI=$_SESSION[dni]");
mysqli_close($conex);
if(isset($_REQUEST['buscar']))
{
    $_SESSION['asig_prof']=$_REQUEST['asig'];
    $conex=conectar();
    $consulta2=mysqli_query($conex,"SELECT distinct DNI,Nombre,Apellidos from alumnos a,calificacion c where a.DNI=c.Dni_alumno and Cod_asig=$_REQUEST[asig]");
    echo mysqli_error($conex);
    ?>
    <form action="" method="POST">
        Alumno: <select name="alum">
        <?php
        while($fila=mysqli_fetch_array($consulta2))
         echo "<option value=$fila[DNI]>".$fila['Nombre']." ".$fila['Apellidos']."</option>";
         ?>
        </select><br />
        Evaluacion: <select name="evaluacion">
            <option value="1EVAL">1 EVAL</option>
            <option value="2EVAL">2 EVAL</option>
            <option value="3EVAL">3 EVAL</option>
            </select><br />
        NOTA: <input type="text" name="not" /><br />
        Comentarios: <input type="text" name="com"/><br />        
    <input type="submit" name="guardar" value="Guardar"/>
    </form>
<?php
}
if(isset($_REQUEST['guardar']))
{
    if(!preg_match('/\d/',$_REQUEST['not']) || ($_REQUEST['not']<0 || $_REQUEST['not']>10)) 
        echo "<br>Nota incorrecta<br>";
    if(!strlen($_REQUEST['com'])>0)
        echo "<br>El nombre no puede estar vacio<br>";
    else
    {
        $conex=conectar();
        $inser=mysqli_query($conex,"UPDATE calificacion SET Nota=$_REQUEST[not],Comentarios='$_REQUEST[com]' where Dni_alumno=$_REQUEST[alum] and Evaluacion='$_REQUEST[evaluacion]' and Cod_asig=$_SESSION[asig_prof]");
        echo "Registro guardado correctamente";
    }        
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
