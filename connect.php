<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao se conectar: Erro " . $e->getMessage();
}
?>
