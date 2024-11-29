<?php
session_start();

if (!isset($_GET['key']) || !isset($_SESSION['tasks'][$_GET['key']])) {
    die('Tarefa não encontrada.');
}

$data = $_SESSION['tasks'][$_GET['key']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Detalhes da Tarefa</title>
</head>
<body>

<div class="details-container">
    <div class="header">
        <h1><?php echo htmlspecialchars($data['task_name']); ?></h1>
    </div>
    <div class="row">
        <div class="details">
            <dl>
                <dt>Descrição da Tarefa:</dt>
                <dd><?php echo htmlspecialchars($data['task_description']); ?></dd>
                <dt>Data da Tarefa:</dt>
                <dd><?php echo htmlspecialchars($data['task_date']); ?></dd>
            </dl>
        </div>
        <div class="footer">
            <p>Desenvolvido por @Renan, Germano e Arthur</p>
        </div>
    </div>
</div>
    
</body>
</html>
