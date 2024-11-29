<?php

require __DIR__ . '/connect.php';

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if (isset($_GET['clear']) && $_GET['clear'] === "clear") {
    $stmt = $conn->prepare("DELETE FROM tasks");
    if ($stmt->execute()) {
        $_SESSION['success'] = "Todas as tarefas foram removidas.";
    } else {
        $_SESSION['error'] = "Ocorreu um erro ao tentar remover as tarefas.";
    }

    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Gerenciador de Tarefas</title>
</head>
<body>

<div class="container">
    <?php
        if (isset($_SESSION['success'])) {
    ?>
        <div class="alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php
        unset($_SESSION['success']);
        }
    ?>
    <?php
        if (isset($_SESSION['error'])) {
    ?>
        <div class="alert-error"><?php echo $_SESSION['error']; ?></div>
    <?php
        unset($_SESSION['error']);
        }
    ?>
    <div class="header">
        <h1>DoMore</h1>
    </div>
    <div class="form">
        <form action="task.php" method="post">
            <input type="hidden" name="insert" value="insert">
            <label for="task_name">Tarefa:</label>
            <input type="text" name="task_name" placeholder="Nome da Tarefa" required>
            <label for="task_description">Descrição:</label>
            <input type="text" name="task_description" placeholder="Descrição da Tarefa">
            <label for="task_date">Data:</label>
            <input type="date" name="task_date">
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <div class="separator"></div>
    <div class="list-tasks">
        <?php
            echo "<ul>";
            foreach ($stmt->fetchAll() as $task) {
                echo "<li>
                        <a href='details.php?key=" . $task['id'] . "'>" . htmlspecialchars($task['task_name']) . "</a>
                        <button type='button' class='btn-clear' onclick='deletar(" . $task['id'] . ")'>Remover</button>
                      </li>";
            }
            echo "</ul>";
        ?>
        <form action="" method="get">
            <input type="hidden" name="clear" value="clear">
            <button type="submit" class="btn-clear">Limpar Tarefas</button>
        </form>
    </div>
    <div class="footer">
        <p>Desenvolvido por @Renan, Germano e Arthur</p>
    </div>
</div>

<script>
    function deletar(key) {
        if (confirm('Confirmar remoção?')) {
            window.location = `task.php?key=${key}`;
        }
    }
</script>

</body>
</html>
