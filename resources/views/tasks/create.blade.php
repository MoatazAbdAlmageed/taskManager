<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tasks.store') }}" method="post" class="space-y-4">
                        @csrf
                        <div class="flex flex-col">
                            <label for="title" class="text-sm font-medium mb-2 pt-2">Title:</label>
                            <input type="text" id="title" name="title" required
                                   class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="description" class="text-sm font-medium mb-2 pt-2">Description:</label>
                            <textarea required id="description" name="description" rows="4" cols="50"
                                      class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                        </div>


                        <div class="flex flex-col">
                            <label for="assigned_to" class="text-sm font-medium mb-2">Assigned By:</label>
                            <select required id="assigned_by" name="assigned_by_id"
                                    class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">Select Admin</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col">
                            <label for="assigned_to" class="text-sm font-medium mb-2">Assigned To:</label>
                            <select required id="assigned_to" name="assigned_to_id"
                                    class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class=" relative inline-flex items-center px-4 py-2 text-sm  font-medium text-gray-100 bg-white border border-gray-300 cursor-default leading-5 rounded-md  dark:bg-gray-800 dark:border-gray-600">
                                Create Task
                            </button>


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
