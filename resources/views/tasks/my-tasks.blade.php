<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-gray-800 px-4 py-2 rounded">
            My Tasks
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg rounded-lg overflow-x-auto border border-gray-300">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-300 border-b border-gray-400">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm md:text-base font-bold text-gray-800 uppercase tracking-wider border-r border-gray-300">Title</th>
                            <th class="px-6 py-3 text-left text-sm md:text-base font-bold text-gray-800 uppercase tracking-wider border-r border-gray-300">Status</th>
                            <th class="px-6 py-3 text-left text-sm md:text-base font-bold text-gray-800 uppercase tracking-wider border-r border-gray-300">Due Date</th>
                            <th class="px-6 py-3 text-left text-sm md:text-base font-bold text-gray-800 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tasks as $task)
                        @php
                            $status = strtolower(trim($task->status ?? 'not started')); // lowercase internal
                            $statusDisplay = ucwords($status); // tampilkan kapital per kata
                            $statusClass = [
                                'not started' => 'bg-gray-200 text-gray-800',
                                'in progress' => 'bg-blue-200 text-blue-800',
                                'completed'   => 'bg-green-200 text-green-800',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm md:text-base text-gray-900 border-r border-gray-300">{{ $task->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-48 border-r border-gray-300">
                                <span id="badge-{{ $task->id }}" class="inline-block px-2 py-1 rounded-full text-xs md:text-sm font-semibold {{ $statusClass[$status] }}">
                                    {{ $statusDisplay }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap w-36 text-sm md:text-base text-gray-700 border-r border-gray-300">
                                {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap w-72 flex items-center gap-2">
                                <select id="status-{{ $task->id }}" class="border rounded px-3 py-1 w-48 text-sm md:text-base">
                                    <option value="not started" @selected($status=='not started')>Not Started</option>
                                    <option value="in progress" @selected($status=='in progress')>In Progress</option>
                                    <option value="completed" @selected($status=='completed')>Completed</option>
                                </select>
                                <button onclick="updateStatus({{ $task->id }})" class="bg-black text-white px-3 py-1 rounded hover:bg-gray-800">
                                    ✅
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- AJAX Script -->
    <script>
        function updateStatus(taskId) {
            const select = document.getElementById('status-' + taskId);
            const status = select.value.toLowerCase(); // pakai lowercase supaya cocok validasi di backend

            fetch(`/tasks/${taskId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    const badge = document.getElementById('badge-' + taskId);
                    const displayStatus = status.split(' ').map(s => s.charAt(0).toUpperCase() + s.slice(1)).join(' ');
                    badge.textContent = displayStatus;

                    const colorMap = {
                        'not started': 'bg-gray-200 text-gray-800',
                        'in progress': 'bg-blue-200 text-blue-800',
                        'completed': 'bg-green-200 text-green-800'
                    };
                    badge.className = `inline-block px-2 py-1 rounded-full text-xs md:text-sm font-semibold ${colorMap[status]}`;
                } else {
                    alert(data.message || 'Failed to update status');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error updating status');
            });
        }
    </script>
</x-app-layout>
