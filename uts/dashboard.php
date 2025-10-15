<?php
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }

    if ($email !== "atmint123@gmail.com" && $password !== 'admin123#') {
        $errors[] = "Email atau password anda salah!";
    }
} else {
    $errors[] = "Cannot Access Dashboard!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Dashboard</title>
    <script src="jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="styleBoard.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <a href="./template.html">
                    <img src="img/logo-v3-clickup-dark.svg" width="150" height="42" />
                </a>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="menu-item active">📋 All Tasks</a></li>
                <li><a href="#" class="menu-item">📅 Today</a></li>
                <li><a href="#" class="menu-item">📆 This Week</a></li>
                <li><a href="#" class="menu-item">✓ Done</a></li>
                <li><a href="#" class="menu-item">⭐ Important</a></li>
            </ul>
            <hr style="border: none; border-top: 1px solid rgba(255, 255, 255, 0.2); margin: 40px 0;">
            <ul class="sidebar-menu">
                <li><a href="#" class="menu-item">⚙️ Settings</a></li>
                <li><a href="/uts/" class="menu-item">🚪 Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <?php
            if (!empty($errors)) {
            ?>
            <div class="error-card">
                <h2>
                    🚫<?php echo $errors[0] ?>
                </h2>
                <p>
                    You may enter this page without doing login first.
                </p>
                <a href="/uts/login.php" class="button">Back to Login</a>
            </div>            
            <?php
            } else{
            ?>
            <div class="header">
                <h1>My To Do List</h1>
                <div class="header-info">
                    <div class="user-avatar">JD</div>
                </div>
            </div>

            <!-- Task Stats -->
            <div class="task-stats">
                <div class="stat-card">
                    <div class="stat-label">Total Task</div>
                    <div class="stat-number" id="total-tasks">0</div>
                </div>
            </div>

            <!-- Add Task Section -->
            <div class="add-task-section">
                <form class="add-task-form" id="add-task-form">
                    <input
                        type="text"
                        id="task-input"
                        placeholder="Create new task..."
                        required>
                    <button type="submit">Add +</button>
                </form>
            </div>

            <!-- Task List -->
            <div class="task-list-section">
                <h2>Task List</h2>
                <table class="task-list">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Choose</th>
                            <th>Task</th>
                            <th style="width: 150px;">Date</th>
                        </tr>
                    </thead>
                    <tbody id="task-list">
                        <tr class="empty-state">
                            <td colspan="3">
                                <p>📝 There is no task right now. Create a new task!</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="action-buttons">
                    <button class="delete-row">🗑️ Delete Selected</button>
                </div>
            </div>
            <?php } ?>
        </main>
    </div>

    <script>
        // Sample Data
        let tasks = [{
                id: 1,
                title: 'HTML & CSS Tutorial',
                date: '2025-10-14'
            },
            {
                id: 2,
                title: 'Dashboard Website Tutorial',
                date: '2025-10-13'
            },
            {
                id: 3,
                title: 'Review JavaScript basics',
                date: '2025-10-15'
            },
            {
                id: 4,
                title: 'Advance Javascript',
                date: '2025-10-16'
            }
        ];

        let nextId = 5;

        // Initialize
        $(document).ready(function() {
            renderTasks();
            updateStats();

            // Menambah baris (Add Task)
            $('#add-task-form').on('submit', function(e) {
                e.preventDefault();
                var taskTitle = $('#task-input').val();

                if (taskTitle.trim()) {
                    var formattedDate = new Date().toLocaleDateString("sv");
                    var markup = "<tr class='task-row'><td><input type='checkbox' name='record'></td><td>" +
                        taskTitle + "</td><td>" + formattedDate + "</td></tr>";
                    $("#task-list").append(markup);

                    $('#task-input').val('');

                    tasks.push({
                        id: nextId++,
                        title: taskTitle,
                        date: formattedDate
                    });

                    updateStats();
                }
            });

            $(".delete-row").click(function() {
                $("#task-list").find('input[name="record"]').each(function() {
                    if ($(this).is(":checked")) {
                        var rowText = $(this).parents("tr").find("td:eq(1)").text();

                        tasks = tasks.filter(task => task.title !== rowText);
                        $(this).parents("tr").remove();
                    }
                });

                updateStats();
                renderTasks();
            });

            $('.menu-item').on('click', function(e) {
                $('.menu-item').removeClass('active');
                $(this).addClass('active');
            });
        });

        function renderTasks() {
            const taskList = $('#task-list');

            if (tasks.length === 0) {
                taskList.html('<tr class="empty-state"><td colspan="3"><p>📝 There is no task right now. Create a new task!</p></td></tr>');
                return;
            }

            let html = '';
            tasks.forEach(task => {
                html += `
                    <tr class="task-row">
                        <td><input type="checkbox" name="record"></td>
                        <td>${task.title}</td>
                        <td>${task.date}</td>
                    </tr>
                `;
            });

            taskList.html(html);
        }

        function updateStats() {
            const total = tasks.length;
            $('#total-tasks').text(total);
        }
    </script>
</body>

</html>