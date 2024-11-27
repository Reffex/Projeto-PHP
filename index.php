<?php

    session_start();

    if ( !isset($_SESSION['tasks']) ) {
        $_SESSION['tasks'] = array();
    }
    
       if ( isset( $_GET['task_name'] ) ) {
        if ( $_GET['task_name'] != "") {
            array_push($_SESSION['tasks'], $_GET['task_name']);
            unset($_GET['task_name']);
        }
        else{
            $_SESSION['message'] = "O campo nome da tarefa não pode ser vazio!";
        }
    }

    if ( isset($_GET['clear']) ) {
        unset($_SESSION['tasks']);
    }

    if ( isset($_GET['key']) ) {
        array_splice( $_SESSION['tasks'], $_GET['key'], 1 );
        unset($_GET['key']);
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Gerenciador de Tarefas</title>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Gerenciador de Tarefas</h1>
    </div>
    <div class="form">
        <form action="" method="get">
            <label for="task_name">Tarefa:</label>
            <input type="text" name="task_name" placeholder="Nome da Tarefa">
            <button type="submit">Cadastrar</button>
        </form>
        <?php
            if ( isset( $_SESSION['message'] ) ) {
                echo "<p style='color: #EF5350';>" . $_SESSION['message'] . "</p>";
                unset( $_SESSION['message'] );
            }
        ?>
    </div>
    <div class="separetor">
    </div>
    <div class="list-tasks">
        <?php
            if ( isset($_SESSION['tasks']) ){
                echo "<ul>";

                            foreach ( $_SESSION['tasks'] as $key => $task ) {
                    echo "<li>
                            <span>$task</span>
                            <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                            <script>
                                fuction deletar$key(){
                                    if ( confirm('Confirmar remoção?') ) {
                                        window.location = 'http://localhost/UNIPÊ/Projeto-PHP/?key=$key';
                                    }
                                    return false;
                                }    
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
        <p>Desenvolvido por @renan, germano e artur</p>
    </div>
</div>
    
</body>
</html>
