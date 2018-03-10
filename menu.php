<?php
session_start();
echo "Hola ".$_SESSION['nombre']." ".$_SESSION['apell'];

if($_SESSION['perfil']=="alumno")
{
?>
  <h1>MENU</h1><br />
  <a href="ver_notas.php">Ver mis notas</a><br />
  <a href="boletin.php">Imprimir boletin</a><br />
  <a href="cerrar_sesion.php">Salir</a><br />

<?php
}
else
{
 ?>
  <h1>MENU</h1><br />
  <a href="insertar_notas.php">Insertar notas</a><br />
  <a href="listado.php">Listado de alumnos</a><br />
  <a href="cerrar_sesion.php">Salir</a><br />

<?php
}
?>
