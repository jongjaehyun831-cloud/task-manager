<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Project
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    {{-- Project Name --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Project Name</label>
                        <input type="text" name="name"
                            class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                            placeholder="Enter project name" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Description</label>
                        <textarea name="description"
                            class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                            rows="4" placeholder="Write a short description..."></textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-lg font-semibold shadow transition hover:scale-[1.02]"
                            style="background-color: #2563eb; color: white;">
                            <!-- save icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7l-4-4zM12 19a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm1-10H7V5h6v4z" />
                            </svg>
                            Save Project
                        </button>

                        <a href="{{ route('projects.index') }}"
                            class="inline-flex items-center gap-2 bg-gray-200 text-gray-800 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
                            <!-- cancel icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
