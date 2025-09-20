<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Task</h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 rounded-xl shadow-md">
        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
          @csrf
          @method('PUT')

          <div class="mb-4">
            <label class="block">Title</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" class="border rounded w-full px-3 py-2" required>
          </div>

          <div class="mb-4">
            <label class="block">Project</label>
            <select name="project_id" class="border rounded w-full px-3 py-2" required>
              @foreach(\App\Models\Project::all() as $project)
                <option value="{{ $project->id }}" {{ $project->id == $task->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-4">
            <label class="block">Assign to</label>
            <select name="assigned_to" class="border rounded w-full px-3 py-2">
              <option value="">-- unassigned --</option>
              @foreach(\App\Models\User::where('role','member')->get() as $member)
                <option value="{{ $member->id }}" {{ $member->id == $task->assigned_to ? 'selected' : '' }}>{{ $member->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-4">
            <label class="block">Due date</label>
            <input type="date" name="due_date" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}" class="border rounded w-full px-3 py-2">
          </div>

          <div class="mb-4">
            <label class="block">Status</label>
            <select name="status" class="border rounded w-full px-3 py-2">
              <option value="not started" {{ $task->status=='not started' ? 'selected' : '' }}>not started</option>
              <option value="in progress" {{ $task->status=='in progress' ? 'selected' : '' }}>in progress</option>
              <option value="completed" {{ $task->status=='completed' ? 'selected' : '' }}>completed</option>
            </select>
          </div>

          <div class="mb-4">
            <label class="block">Description</label>
            <textarea name="description" rows="4" class="border rounded w-full px-3 py-2">{{ old('description', $task->description) }}</textarea>
          </div>

          <div class="flex items-center gap-3">
            <button type="submit" class="px-5 py-2 rounded-lg font-semibold" style="background:#2563eb;color:white">Save Changes</button>
            <a href="{{ route('tasks.index') }}" class="bg-gray-200 px-4 py-2 rounded-lg">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
