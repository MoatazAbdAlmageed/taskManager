<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($tasks))
                        <table class="table table-auto w-full">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Assigned By</th>
                                @if(auth()->user()->is_admin)
                                    <th>Assigned To</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->assignedBy->name }}</td>
                                    @if(auth()->user()->is_admin)
                                        <td>{{ $task->assignedUser->name }}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $tasks->links() }}

                    @else
                        <p>No tasks found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
