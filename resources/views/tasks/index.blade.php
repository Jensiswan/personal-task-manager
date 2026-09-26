<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Dashboard</title>
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

        <div class="sidebar-bottom">
            <div class="user-card">
                <div class="avatar">J</div>
                <div>
                    <div class="user-name">My Workspace</div>
                    <div class="user-role">Personal Tasks</div>
                </div>
            </div>
        </div>

    </aside>

    <main class="main">

        @if(session('success'))
            <div class="alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="topbar">
            <div class="greeting">
                <h1>Good day 👋</h1>
                <p>Here's what's happening with your tasks today.</p>
            </div>

            <div class="date-display">
                {{ now()->format('F d, Y') }}
            </div>
        </div>

        @php
            $total = $tasks->count();
            $pending = $tasks->where('status', 'Pending')->count();
            $completed = $tasks->where('status', 'Completed')->count();
        @endphp

        <div class="stats">

            <div class="stat-card">
                <div>
                    <div class="stat-label">TOTAL TASKS</div>
                    <div class="stat-number">{{ $total }}</div>
                </div>

                <div class="stat-icon stat-purple">▦</div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-label">PENDING</div>
                    <div class="stat-number">{{ $pending }}</div>
                </div>

                <div class="stat-icon stat-yellow">◷</div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-label">COMPLETED</div>
                    <div class="stat-number">{{ $completed }}</div>
                </div>

                <div class="stat-icon stat-green">✓</div>
            </div>

        </div>

        <section class="task-section">

            <div class="section-header">
                <div>
                    <div class="section-title">Your Tasks</div>
                    <div class="section-subtitle">
                        Manage and track your personal tasks.
                    </div>
                </div>

                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    ＋ Add Task
                </a>
            </div>

            @if($tasks->count())

                <table class="task-table">

                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>
                                <div class="task-name">
                                    {{ $task->task_name }}
                                </div>

                                @if($task->description)
                                    <div class="task-description">
                                        {{ $task->description }}
                                    </div>
                                @endif
                            </td>

                            <td>

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

                            </td>

                            <td>
                                <span class="due-date">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No date' }}
                                </span>
                            </td>

                            <td>

                                <div class="actions">

                                    <a href="{{ route('tasks.show', $task) }}"
                                       class="btn btn-secondary btn-small">
                                        View
                                    </a>

                                    <a href="{{ route('tasks.edit', $task) }}"
                                       class="btn btn-secondary btn-small">
                                        Edit
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}"
                                            method="POST"
                                           class="delete-form"
                                            data-task="{{ $task->task_name }}">

                                              @csrf
                                             @method('DELETE')

                                    <button type="button"
                                    class="btn btn-danger btn-small delete-btn">
                                      Delete
                                    </button>

                                </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">

                    <div class="empty-icon">✓</div>

                    <h3>No tasks yet</h3>

                    <p>Create your first task and start organizing your day.</p>

                    <a href="{{ route('tasks.create') }}"
                       class="btn btn-primary">
                        ＋ Create Your First Task
                    </a>

                </div>

            @endif

        </section>

    </main>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {

        button.addEventListener('click', function () {

            const form = this.closest('.delete-form');
            const taskName = form.dataset.task;

            Swal.fire({
                title: 'Delete this task?',
                text: `"${taskName}" will be permanently deleted.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    confirmButton: 'swal-delete-button',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });
</script>

</body>
</html>