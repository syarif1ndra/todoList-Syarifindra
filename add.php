<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task'];
    $taskPriority = $_POST['priority'];

    $_SESSION['tasks'][] = [
        'name' => $taskName,
        'priority' => $taskPriority
    ];
    
    header('Location: index.php');
    exit();
}
