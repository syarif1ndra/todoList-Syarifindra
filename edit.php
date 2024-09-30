<?php
session_start();

if (!isset($_GET['id']) || !isset($_SESSION['tasks'][$_GET['id']])) {
    header('Location: index.php');
    exit();
}

$taskId = $_GET['id'];
$task = $_SESSION['tasks'][$taskId];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task'];
    $taskPriority = $_POST['priority'];

    $_SESSION['tasks'][$taskId] = [
        'name' => $taskName,
        'priority' => $taskPriority
    ];

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Edit Task</h1>

        <form action="edit.php?id=<?= $taskId ?>" method="post" class="task-form">
            <div class="mb-3">
                <label for="task" class="form-label">Task</label>
                <input type="text" id="task" name="task" class="form-control" value="<?= htmlspecialchars($task['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select id="priority" name="priority" class="form-select" required>
                    <option value="Low" <?= $task['priority'] == 'Low' ? 'selected' : '' ?>>Low</option>
                    <option value="Medium" <?= $task['priority'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="High" <?= $task['priority'] == 'High' ? 'selected' : '' ?>>High</option>
                </select>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Update Task</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Back to Task List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
