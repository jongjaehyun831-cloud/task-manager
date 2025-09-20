<x-app-layout>
  <x-slot name="header">
    <!-- Header dijamin hitam walau ada class bawaan layout -->
    <h2 class="font-semibold text-xl !text-black leading-tight">
        Create Task
    </h2>
  </x-slot>

  <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 rounded-xl shadow-md">
        <form method="POST" action="{{ route('tasks.store') }}">
          @csrf

          <!-- Title -->
          <div class="mb-4">
            <label class="block font-medium mb-1 !text-black">Title</label>
            <input type="text" name="title" required
              class="border border-gray-300 rounded-lg w-full px-3 py-2" placeholder="Task title">
            @error('title')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
          </div>

          <!-- Project -->
          <div class="mb-4">
            <label class="block font-medium mb-1 !text-black">Project</label>
            <select name="project_id" required class="border rounded-lg w-full px-3 py-2">
              <option value="">-- Select project --</option>
              @foreach(\App\Models\Project::all() as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
              @endforeach
            </select>
            @error('project_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
          </div>

          <!-- Assigned To -->
          <div class="mb-4">
            <label class="block font-medium mb-1 !text-black">Assign to</label>
            <select name="assigned_to" class="border rounded-lg w-full px-3 py-2">
              <option value="">-- (unassigned) --</option>
              @foreach(\App\Models\User::where('role','member')->get() as $member)
                <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
              @endforeach
            </select>
            @error('assigned_to')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
          </div>

          <!-- Due Date -->
          <div class="mb-4">
            <label class="block font-medium mb-1 !text-black">Due date</label>
            <input type="date" name="due_date" class="border rounded-lg px-3 py-2 w-full">
          </div>

          <!-- Description -->
          <div class="mb-4">
            <label class="block font-medium mb-1 !text-black">Description</label>
            <textarea name="description" rows="4" class="border rounded-lg w-full px-3 py-2"></textarea>
          </div>

          <!-- Buttons -->
          <div class="flex items-center gap-3">
            <button type="submit"
              class="inline-flex items-center gap-2 px-5 py-2 rounded-lg font-semibold shadow"
              style="background-color:#2563eb;color:white;">
              <!-- disk icon -->
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7l-4-4zM12 19a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm1-10H7V5h6v4z"/></svg>
              Create Task
            </button>

            <a href="{{ route('tasks.index') }}"
              class="bg-gray-200 px-4 py-2 rounded-lg !text-black">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
