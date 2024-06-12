<?php
include 'obj/bd.php';
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
if(login($usuario,$pass)){
    header('Location:menu.php');
}else{
    header('Location:error.php');
}


?>