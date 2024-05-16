<?php 

function conectarDb(): mysqli {
    $db = new mysqli('localhost', 'root', '', 'sayafit');

    if ($db->connect_error) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "errno de depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }

    return $db;
}
