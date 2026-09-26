<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Edit Task</title>
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

            <a href="{{ route('tasks.index') }}">
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
                <h1>Edit Task</h1>
                <p>Update the details of your task.</p>
            </div>

            <div class="form-card">

                <form action="{{ route('tasks.update', $task) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">

                        <label for="task_name">Task Name</label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            class="form-control"
                            value="{{ old('task_name', $task->task_name) }}"
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
                        >{{ old('description', $task->description) }}</textarea>

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
                                    {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Completed"
                                    {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>
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
                                value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                            >

                        </div>

                    </div>

                    <div class="form-actions">

                        <a href="{{ route('tasks.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            ✓ Update Task
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

</body>
</html>