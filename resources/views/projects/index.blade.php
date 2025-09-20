{{-- resources/views/projects/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Projects
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('projects.create') }}" 
               class="mb-4 inline-block bg-green-300 text-black px-4 py-2 rounded font-semibold">
                + Create Project
            </a>

            <div class="bg-white shadow rounded p-4">
                <ul class="space-y-4">
                    @forelse($projects as $project)
                        <li class="border p-4 rounded flex justify-between items-center">
                            <div>
                                <strong>{{ $project->name }}</strong>
                                <p class="text-sm text-gray-600">{{ $project->description }}</p>
                            </div>
                            <div class="flex space-x-2">
                                {{-- Edit icon (updated) --}}
                                <a href="{{ route('projects.edit', $project->id) }}" 
                                   class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M16.5 4.5a2.121 2.121 0 013 3L7 20H4v-3L16.5 4.5z" />
                                    </svg>
                                </a>

                                {{-- Delete icon (updated) --}}
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500">No projects available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
