<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12 lg:px-10">
        <div class="pl-16">
            <a href="javascript:history.go(-1)" class="back-arrow font-semibold text-lg">&larr; Back</a>
        </div>
    </div>

    <div class="py-3">
        <div class="relative overflow-x-auto lg:px-10">
            <div class="row  flex justify-start m-3 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Delete Time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->name }}
                                </th>
                                <td class="px-6 py-4">{{ $category->description }}</td>
                                <td class="px-6 py-4">{{ $category->deleted_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-9 p-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
</x-app-layout>
