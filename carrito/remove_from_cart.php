<?php

require_once('../reg.php');
session_start();

switch($_POST['btnAction']){
  case 'Eliminar':
    if($_POST['id']){
      $producto_id = ($_POST['id']);

      foreach($_SESSION['cart'] as $index => $item){
        if($item['producto_id']== $producto_id){
          unset($_SESSION['cart'][$index]);
          $_SESSION['cart']=array_values($_SESSION["cart"]);
          header('location: carrito.php');
        }
      }
    }
    else{
      echo 'ID incorrecto';
    }
    break;
}
