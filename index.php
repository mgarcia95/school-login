<?php
include "funciones.php";
if(isset($_REQUEST['entrar']))
{
    $conex=conectar();
    if($conex!=0)
    {
    if($_REQUEST['perfil']=="alumno")
    {
        
        $consulta=mysqli_query($conex,"SELECT * from alumnos where DNI=$_REQUEST[dni]");        
        if($consulta!=false) //para cuando se deja el campo en blanco que no de error mysqli_num_rows
        {
            if(mysqli_num_rows($consulta)>0 && mysqli_errno($conex)==0)
            {
              session_start();
                $fila=mysqli_fetch_array($consulta);
                $_SESSION['dni']=$fila['DNI'];
                $_SESSION['nombre']=$fila['Nombre'];
                $_SESSION['apell']=$fila['Apellidos'];
                $_SESSION['perfil']="alumno";                
                header("Location:menu.php");
            }
        
            else echo "Alumno no encontrado";
        }
    }
    else
    {        
        $consulta=mysqli_query($conex,"SELECT * from profesor where DNI=$_REQUEST[dni] and Clave='$_REQUEST[pass]'");
        if(@mysqli_num_rows($consulta)>0) //para cuando se deja el campo en blanco que no de error mysqli_num_rows
        {
            session_start();
            $fila=mysqli_fetch_array($consulta);
            $_SESSION['dni']=$fila['DNI'];
            $_SESSION['nombre']=$fila['Nombre'];
            $_SESSION['apell']=$fila['Apellidos'];
            $_SESSION['dep']=$fila['Departamento'];
            $_SESSION['perfil']="profesor";            
            header("Location:menu.php");
        }
        else echo "Profesor no encontrado";        
    }
    mysqli_close($conex);
    }
}

?>
<h1>Formulario de acceso</h1>
<form action="" method="POST">
DNI: <input type="text" name="dni" /><br />
Contraseña: <input type="text" name="pass" /><br />
Perfil: <select name="perfil">
<option value="alumno">Alumno</option>
<option value="profesor">Profesor</option>
</select><br />
<input type="submit" name="entrar" value="Entrar" />
</form>