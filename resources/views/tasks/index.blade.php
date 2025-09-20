<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl !text-black leading-tight">
            Tasks
        </h2>
    </x-slot>

    <div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(Auth::user()->role=='manager')
                <a href="{{ route('tasks.create') }}"
                   class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-600 transition">
                    + Create Task
                </a>
            @endif

            <ul class="space-y-4">
                @forelse($tasks as $task)
                    <li class="border p-4 rounded flex justify-between items-center bg-white shadow-sm">
                        <div>
                            <strong>{{ $task->title }}</strong> 
                            (Project: {{ $task->project->name ?? 'No Project' }}) - 
                            Status: {{ ucfirst($task->status) }}
                        </div>

                        <div class="flex items-center space-x-2">
                            @if(Auth::user()->role=='manager')
                                <!-- Edit Icon -->
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.5 4.5a2.121 2.121 0 013 3L7 20H4v-3L16.5 4.5z" />
                                    </svg>
                                </a>
                                <!-- Delete Icon -->
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                        </svg>
                                    </button>
                                </form>
                            @elseif(Auth::user()->role=='member' && $task->assigned_to==Auth::id())
                                <!-- Status Update Dropdown -->
                                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 bg-gray-100 hover:bg-gray-200 cursor-pointer">
                                        <option value="not started" {{ $task->status=='not started'?'selected':'' }}>not Started</option>
                                        <option value="in progress" {{ $task->status=='in progress'?'selected':'' }}>in Progress</option>
                                        <option value="completed" {{ $task->status=='completed'?'selected':'' }}>completed</option>
                                    </select>
                                </form>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="text-gray-500">No tasks available.</li>
                @endforelse
            </ul>

        </div>
    </div>
</x-app-layout>
