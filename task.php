<?php

require __DIR__ . '/connect.php';

session_start();

if (isset($_POST['task_name'])) {
    $task_name = trim($_POST['task_name']);
    $task_description = trim($_POST['task_description'] ?? '');
    $task_date = $_POST['task_date'] ?? '';

    if ($task_name !== "") {

        $stmt = $conn->prepare('INSERT INTO tasks (task_name, task_description, task_date)
                                VALUES (:name, :description, :date)');
        $stmt->bindParam('name', $_POST['task_name']);
        $stmt->bindParam('description', $_POST['task_description']);
        $stmt->bindParam('date', $_POST['task_date']);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Tarefa cadastrada com sucesso.";
            header('Location: index.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Por favor, preencha todos os campos obrigatórios.";
        header('Location: index.php');
        exit;
    }
}

if (isset($_GET['key'])) {
    $stmt = $conn->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->bindParam(':id', $_GET['key']);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tarefa removida com sucesso.";
        header('Location: index.php');
        exit;
    }
} else {
    $_SESSION['error'] = "Erro ao tentar remover a tarefa.";
    header('Location: index.php');
    exit;
}
?>
