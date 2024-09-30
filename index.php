<?php
session_start();

// Initialize tasks if not already set
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $taskId = $_GET['delete'];
    unset($_SESSION['tasks'][$taskId]);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List-SyarifIndra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .task-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .task-list {
            margin-top: 30px;
        }
        .table {
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">To do List with PHP Session</h1>

        <div class="task-form">
            <form action="add.php" method="post" class="mb-3">
                <div class="mb-3">
                    <label for="task" class="form-label"><h5>Task</h5></label>
                    <input type="text" id="task" name="task" class="form-control" placeholder="Enter task" required>
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label"><h5>Priority Task</h5></label>
                    <select id="priority" name="priority" class="form-select" required>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom">Add Task</button>
            </form>
        </div>

        <div class="task-list">
            <h3>Your Tasks</h3>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['tasks'])): ?>
                        <?php foreach ($_SESSION['tasks'] as $id => $task): ?>
                            <tr>
                                <td><?= htmlspecialchars($task['name']) ?></td>
                                <td><?= htmlspecialchars($task['priority']) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?delete=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No tasks yet. Add some tasks!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
