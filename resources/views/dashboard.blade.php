<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(Auth::user()->role == 'manager')
                    <p>Welcome, Project Manager! Use the menu <strong>Projects</strong> or <strong>Tasks</strong> to get started.</p>
                    <a href="{{ route('projects.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">View Projects</a>
                    <a href="{{ route('tasks.index') }}" class="bg-green-500 text-white px-4 py-2 rounded mt-2 inline-block">View Tasks</a>
                @else
                    <p>Welcome, Team Member! Check your assigned tasks using the <strong>My Tasks</strong> menu.</p>
                    <a href="{{ route('tasks.myTasks') }}" class="bg-green-500 text-white px-4 py-2 rounded mt-2 inline-block">View My Tasks</a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
