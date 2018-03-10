<?php
function conectar()
{
    $conex=mysqli_connect("localhost","antonio","antonio","mydb");
    if(mysqli_connect_errno()!=0)
        $conex=0;
    return $conex;  
}

function imprimir_boletin($conex)
{
    $nomfich=$_SESSION['dni']."-".$_REQUEST['evaluacion'].".txt";
    $f=fopen($nomfich,"w+");
    $consulta=mysqli_query($conex,"SELECT Descripcion,Curso,Nota from asignatura a,calificacion c where a.Codigo=c.Cod_asig and c.Dni_alumno=$_SESSION[dni] and c.Evaluacion='$_REQUEST[evaluacion]'");
    echo mysqli_error($conex);
    if(mysqli_num_rows($consulta)>0)
    {
        while($fila=mysqli_fetch_array($consulta))
        {
            fwrite($f,$fila['Descripcion'].";".$fila['Curso'].";".$fila['Nota']."\r\n");
        }
        fclose($f);
    }
}
?>