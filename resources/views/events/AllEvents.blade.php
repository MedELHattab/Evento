<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Events') }}
        </h2>
    </x-slot>

    <div class="py-12">

        @if (session('success'))
            <div id="alert-3"
                class=" lg:m-10 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif




        <div class="relative overflow-x-auto lg:px-10">

            @if ($events->count() > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Seats
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $event->id }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $event->name }}
                                </th>
                                <td class="px-6 py-4">
                                    @foreach ($users as $user)
                                        @if ($user->id === $event->created_by)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->location }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->seats }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->price }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($categories as $category)
                                        @if ($category->id === $event->category_id)
                                            {{ $category->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->type }}
                                </td>
                                <td class="px-6 py-4">
                                    <form id="statusForm_{{ $event->id }}" action="{{ route('events.changeStatus', $event->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="pending" {{ old('status', $event->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ old('status', $event->status) === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="refused" {{ old('status', $event->status) === 'refused' ? 'selected' : '' }}>Refused</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white my-2 px-4 py-2 rounded-lg">Update Status</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-9 p-3">
                    {{ $events->links() }}
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center mt-4">No events found.</p>
            @endif
        </div>
    </div>
</x-app-layout>

