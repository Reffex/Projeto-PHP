<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if (isset($_GET['clear']) && $_GET['clear'] === "clear") {
    unset($_SESSION['tasks']);
    header('Location: index.php');
    exit;
}
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
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: #EF5350;'>" . htmlspecialchars($_SESSION['message']) . "</p>";
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <div class="separator"></div>
    <div class="list-tasks">
        <?php
        if (!empty($_SESSION['tasks'])) {
            echo "<ul>";
            foreach ($_SESSION['tasks'] as $key => $task) {
                echo "<li>
                        <a href='details.php?key=$key'>" . htmlspecialchars($task['task_name']) . "</a>
                        <button type='button' class='btn-clear' onclick='deletar($key)'>Remover</button>
                      </li>";
            }
            echo "</ul>";
        }
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
