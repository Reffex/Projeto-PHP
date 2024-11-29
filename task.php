<?php
session_start();

if (isset($_POST['task_name'])) {
    $task_name = trim($_POST['task_name']);
    $task_description = trim($_POST['task_description'] ?? '');
    $task_date = $_POST['task_date'] ?? '';

    if ($task_name !== "") {
        $data = [
            'task_name' => htmlspecialchars($task_name),
            'task_description' => htmlspecialchars($task_description),
            'task_date' => htmlspecialchars($task_date)
        ];
        $_SESSION['tasks'][] = $data;
        header('Location: index.php');
    } else {
        $_SESSION['message'] = "O campo não pode ficar vazio!";
        header('Location: index.php');
    }
    exit;
}

if (isset($_GET['key'])) {
    $key = intval($_GET['key']);
    if (isset($_SESSION['tasks'][$key])) {
        array_splice($_SESSION['tasks'], $key, 1);
    }
    header('Location: index.php');
    exit;
}
?>
