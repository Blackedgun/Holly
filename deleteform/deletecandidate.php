<?php

include '../reg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id = $_POST["delete"];

    
$sql = "DELETE FROM postulantes WHERE post_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('El registro se ha eliminado correctamente');
        window.location = '../user/postulados.php';
        </script>";
    } 

  else{
    echo "<script>
    alert('Los datos no se pudieron eliminar');
    window.location = 'inventario.php';
    </script>". mysqli_error($conn);
   }
}

?>