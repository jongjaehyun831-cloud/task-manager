{{-- resources/views/projects/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('projects.update', $project->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Project Name</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $project->name) }}"
                           class="border rounded w-full px-2 py-1">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Description</label>
                    <textarea name="description" 
                              class="border rounded w-full px-2 py-1">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-300 text-black px-4 py-2 rounded font-semibold">
                        💾 Save Changes
                    </button>
                    <a href="{{ route('projects.index') }}" 
                       class="bg-gray-300 text-black px-4 py-2 rounded font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
