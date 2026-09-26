<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Add Task</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">✓</div>
            <div class="logo-text">Personal Task Manager</div>
        </div>

        <div class="nav-title">Task Manager</div>

        <nav class="nav">

            <a href="{{ route('tasks.index') }}">
                <span class="nav-icon">▦</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('tasks.create') }}" class="active">
                <span class="nav-icon">＋</span>
                <span>Add Task</span>
            </a>

        </nav>

    </aside>

    <main class="main">

        <div class="form-container">

            <div class="page-heading">
                <h1>Create New Task</h1>
                <p>Add a task to your personal workspace.</p>
            </div>

            <div class="form-card">

                <form action="{{ route('tasks.store') }}" method="POST">

                    @csrf

                    <div class="form-group">

                        <label for="task_name">Task Name</label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            class="form-control"
                            placeholder="e.g. Buy groceries"
                            value="{{ old('task_name') }}"
                            required
                        >

                        @error('task_name')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="description">Description</label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control"
                            placeholder="Add some details about this task..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-row">

                        <div class="form-group">

                            <label for="status">Status</label>

                            <select
                                id="status"
                                name="status"
                                class="form-control"
                                required
                            >

                                <option value="Pending"
                                    {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Completed"
                                    {{ old('status') == 'Completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="due_date">Due Date</label>

                            <input
                                type="date"
                                id="due_date"
                                name="due_date"
                                class="form-control"
                                value="{{ old('due_date') }}"
                            >

                            @error('due_date')
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="form-actions">

                        <a href="{{ route('tasks.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            ✓ Save Task
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

</body>
</html>