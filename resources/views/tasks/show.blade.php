<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Task Details</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">✓</div>
            <div class="logo-text">TaskFlow</div>
        </div>

        <div class="nav-title">Workspace</div>

        <nav class="nav">

            <a href="{{ route('tasks.index') }}" class="active">
                <span class="nav-icon">▦</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('tasks.create') }}">
                <span class="nav-icon">＋</span>
                <span>Add Task</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <div class="form-container">

            <div class="page-heading">
                <h1>Task Details</h1>
                <p>View the information for this task.</p>
            </div>

            <div class="detail-card">

                <h2 class="detail-title">
                    {{ $task->task_name }}
                </h2>

                <div class="detail-description">
                    {{ $task->description ?: 'No description provided.' }}
                </div>

                <div class="detail-grid">

                    <div class="detail-item">

                        <div class="detail-label">
                            Status
                        </div>

                        <div class="detail-value">

                            @if($task->status === 'Completed')

                                <span class="status status-completed">
                                    <span class="status-dot"></span>
                                    Completed
                                </span>

                            @else

                                <span class="status status-pending">
                                    <span class="status-dot"></span>
                                    Pending
                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="detail-item">

                        <div class="detail-label">
                            Due Date
                        </div>

                        <div class="detail-value">

                            {{ $task->due_date
                                ? $task->due_date->format('F d, Y')
                                : 'No due date'
                            }}

                        </div>

                    </div>

                </div>

                <div class="form-actions">

                    <a href="{{ route('tasks.index') }}"
                       class="btn btn-secondary">
                        ← Back
                    </a>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="btn btn-primary">
                        Edit Task
                    </a>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>