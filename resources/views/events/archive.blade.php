<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>
    <div class="py-12 lg:px-10">
        <div class="pl-16">
            <a href="javascript:history.go(-1)" class="back-arrow font-semibold text-lg">&larr; Back</a>
        </div>
    </div>

    <div class="py-12">
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
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                type
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
                                    {{ $event->status }}
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
