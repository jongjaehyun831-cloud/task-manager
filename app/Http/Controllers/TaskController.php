<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // nanti bisa aktifkan role middleware jika mau
        // $this->middleware('role:manager')->except(['myTasks', 'ajaxUpdateStatus']);
        // $this->middleware('role:member')->only(['myTasks', 'ajaxUpdateStatus']);
    }

    // Manager: list semua tasks
    public function index()
    {
        $tasks = Task::with('project')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        // normalisasi status ke lowercase
        $data['status'] = strtolower($data['status'] ?? 'not started');

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        // normalisasi status ke lowercase
        $data['status'] = strtolower($data['status'] ?? 'not started');

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    // Member: lihat tugas sendiri
    public function myTasks()
    {
        $tasks = Task::where('assigned_to', auth()->id())->get();
        return view('tasks.my-tasks', compact('tasks'));
    }

    // Member: update status via AJAX
    public function ajaxUpdateStatus(Request $request, Task $task)
    {
        if ($task->assigned_to != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'status' => 'required|in:not started,in progress,completed',
        ]);

        // simpan status selalu lowercase
        $task->update([
            'status' => strtolower($data['status'])
        ]);

        return response()->json(['success' => true]);
    }
}
