<?php

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if (isset($_GET['task_name'])) {
    $task_name = filter_input(INPUT_GET, 'task_name', FILTER_SANITIZE_STRING);
    if ($task_name != "") {
        $_SESSION['tasks'][] = htmlspecialchars($task_name);
    } else {
        $_SESSION['message'] = "O campo não pode ficar vazio!";
    }
}

if (isset($_GET['clear']) && $_GET['clear'] === "clear") {
    unset($_SESSION['tasks']);
}

if (isset($_GET['key']) && is_numeric($_GET['key'])) {
    $key = intval($_GET['key']);
    if (isset($_SESSION['tasks'][$key])) {
        array_splice($_SESSION['tasks'], $key, 1);
    }
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
        <form action="" method="get">
            <label for="task_name">Tarefa:</label>
            <input type="text" name="task_name" placeholder="Nome da Tarefa">
            <button type="submit">Cadastrar</button>
        </form>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: #EF5350';>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <div class="separetor"></div>
    <div class="list-tasks">
        <?php
        if (isset($_SESSION['tasks'])) {
            echo "<ul>";
            foreach ($_SESSION['tasks'] as $key => $task) {
                echo "<li>
                        <span>" . htmlspecialchars($task) . "</span>
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
            window.location = `?key=${key}`;
        }
    }
</script>

</body>
</html>
