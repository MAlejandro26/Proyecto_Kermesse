<?php
$usuario=$_POST['usuario'];
$contraseña=$_POST["pass"];
session_start();
$_SESSION['usuario']=$usuario;


$conexion=mysqli_connect("localhost","root","","dbkermesse_grupo4");

$consulta="SELECT*FROM tbl_usuario where usuario ='$usuario' and pwd ='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
  echo "<script> alert('Bienvenido $usuario'); window.location='index.php' </script>";

}else{
    ?>
    <?php
    echo "<script> alert('Usuario no existe'); window.location='404.html' </script>";

  ?>
  
  <h1 class="btn btn-google btn-user btn-block">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
