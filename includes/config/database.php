<?php
function conectarDb(): PDO
{
    $dsn = 'mysql:host=localhost;dbname=sayafit';
    $usuario = 'root';
    $contraseña = '';

    try {
        $db = new PDO($dsn, $usuario, $contraseña);
        // Establecer el modo de error de PDO a excepciones
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // En caso de error en la conexión, mostrar mensaje y salir
        echo 'Error: No se pudo conectar a MySQL.';
        echo 'Error: ' . $e->getMessage();
        exit;
    }

    return $db;
}
?>




